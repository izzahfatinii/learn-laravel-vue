<template>
<div>
    <h1 class="font-bold text-2xl">Reactivity (ref)</h1>

    <div>
        <h1 class="font-bold text-xl">Deep Reactivity</h1>
        
        <p>Nested count: {{ obj.nested.count }}</p>
        <ul>
            <li v-for="(item, index) in obj.arr" :key="index">{{ index }}: {{ item }}</li>
            <!-- <li v-for="item in obj.arr">{{ item }}</li> -->
            <!-- <li v-for="(item, index) in obj.arr">{{ index }}: {{ item }}</li> -->
        </ul>
        <SecondaryButton @click="mutateDeeply">Mutate Data</SecondaryButton>

        <div>
            baz index: {{ obj.arr.indexOf('baz') }} (-1 means not exist)
        </div>
    </div>

    <div>
        <h1 class="font-bold text-xl">DOM Update Timing</h1>
        <p>Count: {{ count2 }}</p>
        <SecondaryButton @click="increment">Increment</SecondaryButton>
    </div><br>

    <h1 class="font-bold text-2xl">Reactivity (reactive())</h1>
    <div>
        <SecondaryButton @click="state.count++">{{ state.count }}</SecondaryButton>

        <h1>Name: {{ shallowObj.name }}</h1>
        <h2>Age: {{ shallowObj.age }}</h2>
        <p>Address:</p>
        <ul>
        <li>Street: {{ shallowObj.address.street }}</li>
        <li>City: {{ shallowObj.address.city }}</li>
        </ul>
        <SecondaryButton @click="changeShallowObj()">Change shallowObj value</SecondaryButton>
    </div>
    <div>
        <h1 class="font-bold text-xl">Reactive Proxy vs. Original</h1>

        <CodeSection>
            const raw = {} // original <br>
            const proxy = reactive(raw)
        </CodeSection>
        <SecondaryButton @click="console.log(proxy === raw)">console.log(proxy === raw)</SecondaryButton><br>
        <SecondaryButton @click="console.log(proxy === proxy)">console.log(proxy === proxy)</SecondaryButton><br>
        <SecondaryButton @click="console.log(raw === raw)">console.log(raw === raw)</SecondaryButton><br>
        <SecondaryButton @click="console.log(reactive(raw) === proxy)">console.log(reactive(raw) === proxy)</SecondaryButton><br>
        <SecondaryButton @click="console.log(reactive(proxy) === proxy)">console.log(reactive(proxy) === proxy)</SecondaryButton><br>
        <SecondaryButton @click="console.log(reactive(proxy) === raw)">console.log(reactive(proxy) === raw)</SecondaryButton><br> 
        <SecondaryButton @click="console.log(reactive(raw) === raw)">console.log(reactive(raw) === raw)</SecondaryButton><br>
        <br>
        <p>This rule applies to nested objects as well. Due to deep reactivity, nested objects inside a reactive object are also proxies:</p>
        <CodeSection>
            const proxy2 = reactive({}) <br>
            const raw2 = {} <br>
            proxy2.nested = raw2
        </CodeSection>
        <SecondaryButton @click="console.log(proxy2.nested === raw2)">console.log(proxy2.nested === raw2)</SecondaryButton><br>
    </div><br>
    <div>
        <h1 class="font-bold text-xl">Additional Ref Unwrapping Details</h1>
        <SecondaryButton @click="notUseOtherCount">notUseOtherCount</SecondaryButton><br>
        <PrimaryButton @click="useOtherCount">useOtherCount</PrimaryButton><br>
    </div>
    <div>
        <h1 class="font-bold text-xl">Caveat in Arrays and Collections</h1>
        <SecondaryButton @click="results">results</SecondaryButton>
    </div><br>
    <div>
        <h1 class="font-bold text-xl">Caveat when Unwrapping in Templates</h1>
        {{ count3 + 1 }} <br> <!-- 2 -->
        {{ object.id + 1 }} <br> <!-- [object Object]1 -->
        {{ object.id.value }}
    </div>
</div>
<br><br><br>
</template>

<script setup>
import { ref } from 'vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { nextTick } from 'vue'
import { reactive } from 'vue'
import { shallowReactive } from 'vue'
import CodeSection from '@/Components/CodeSection.vue'

// ref - ref is typically used for simple values like numbers, strings, booleans, or DOM elements. It's designed for cases where you want to make a single value reactive. 
// Deep Reactivity
const obj = ref({
  nested: { count: 0 },
  arr: ['foo', 'bar']
});
const mutateDeeply = () => {
  obj.value.nested.count++ // Make sure has .value
  obj.value.arr.push('baz')
}

// DOM Update Timing
const count2 = ref(0);
const increment = async () => {
    await nextTick(); // Do not see any difference with this :(
    count2.value++;
}

// reactive() - generally recommended to use reactive for objects with nested properties or more complex data structures because it provides deep reactivity and results in more readable and maintainable code. 
const state = reactive({ count: 0 })
const shallowObj = shallowReactive({
  name: 'John',
  age: 30,
  address: {
    street: '123 Main St',
    city: 'Anytown',
  },
})

function changeShallowObj() {
    // Changes to top-level properties are reactive
    shallowObj.name = 'Jane'; // This will trigger reactivity

    // Changes to nested properties are not reactive
    shallowObj.address.street = '456 Elm St'; // This will NOT trigger reactivity
}

// Reactive Proxy vs. Original
const raw = {} // original
const proxy = reactive(raw)

const proxy2 = reactive({})
const raw2 = {}
proxy2.nested = raw2

// Additional Ref Unwrapping Details
// As Reactive Object Property
const count1 = ref(0)
const state1 = reactive({
  count1
})
state1.count1 = 1

function notUseOtherCount() {
    console.log(state1.count1) // 1
    console.log(count1.value) // 1
}

function useOtherCount()    {
    const otherCount = ref(2)
    state1.count1 = otherCount
    console.log(state1.count1) // 2
    console.log(count1.value) // 1
}

// Caveat in Arrays and Collections
const books = reactive([ref('Vue 3 Guide')])
const map = reactive(new Map([['count', ref(0)]]))

function results()  {
    console.log(books[0].value)// need .value here
    console.log(map.get('count').value)// need .value here
}

// Caveat when Unwrapping in Templates
const count3 = ref(0)
const object = { id: ref(1) }

count3.value = count3.value + 1

console.log(object)

</script>
