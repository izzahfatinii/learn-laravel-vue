<template>
    <h1 class="font-bold text-2xl">Raw HTML</h1>
    <div>
        <p>Using text interpolation: {{ rawHtml }}</p>
        <p>Using v-html directive: <span v-html="rawHtml"></span></p> 
    </div><br>

    <h1 class="font-bold text-2xl">Attribute Bindings</h1>

    <div>
        <h1 class="font-bold text-xl">Shorthand</h1>
        <div :id="dynamicId">
        {{ dynamicId }}
        </div>
        <SecondaryButton @click="changeDynamicId">Change ID</SecondaryButton>
        <br>
    </div>

    <div>
        <h1 class="font-bold text-xl">Boolean Attributes</h1>
        <PrimaryButton :disabled="isButtonDisabled">Button</PrimaryButton>
        <p>{{ buttonText }}</p>

        <SecondaryButton @click="toggleButton">Toggle button disabled</SecondaryButton>
    </div><br>

    <!-- Dynamically Binding Multiple Attributes -->
    <div v-bind="objectOfAttrs">This is a div element</div>

    <div class="p-2 flex justify-between items-baseline border-b border-slate-700"></div><br>

    <div>
        <h1 class="font-bold text-2xl">Using JavaScript Expressions</h1>
        <p>Number plus one: {{ number + 1 }}</p>
        <p>Is it OK? {{ ok ? 'YES' : 'NO' }}</p>
        <SecondaryButton @click.prevent="toggleOk">toggle Ok</SecondaryButton>
        <p>Reversed message: {{ message.split('').reverse().join('') }}</p>
        <div :id="`list-${id}`">Dynamic ID: {{ `list-${id}` }}</div>
    </div><br>

    <div>
        <h1 class="font-bold text-2xl">Directives</h1>
        <SecondaryButton @click.prevent="toogleSeen">toogle Seen</SecondaryButton>
        <p v-if="seen">Now you see me</p>
    </div><br>

    <div>
        <h1 class="font-bold text-2xl">Arguments</h1>
        <a :href=url class="text-blue-500 underline hover:text-blue-700">Click me</a>
    </div><br>

    <div>
        <h1 class="font-bold text-2xl">Dynamic Arguments</h1>
        <div>
            <a :[attributeName]=url2 class="text-blue-500 underline hover:text-blue-700">Click me</a>
        </div>
        <div>
            <SecondaryButton @[eventName]="doSomething">Click me</SecondaryButton>
        </div>
    </div><br>
</template>
  
<script setup>
import { ref, computed } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

// Raw HTML
const rawHtml = '<span style="color: red">This should be red.</span>';

// Attribute Bindings
// Shorthand
const dynamicId = ref('defaultId');
const changeDynamicId = () => {
    dynamicId.value = 'newId';
};

// Boolean Attributes
const isButtonDisabled = ref(false);
const buttonText = computed(() => {
    return isButtonDisabled.value ? 'Button is disabled' : 'Button is enabled';
});

const toggleButton = () => {
    isButtonDisabled.value = !isButtonDisabled.value;
};

// Dynamically Binding Multiple Attributes
const objectOfAttrs = {
    id: 'container',
    class: 'bg-slate-300 wrapper'
};

// Using JavaScript Expressions
const number = 5
const ok = ref(true)
const message = 'Hello, Vue!'
const id = 123

const toggleOk = () =>  {
    ok.value = !ok.value
}

// Directives
const seen = ref(false)
const toogleSeen = () =>    {
    seen.value = !seen.value
}

// Arguments
const url = ref('learn-vue2')

// Dynamic Arguments
const attributeName = ref('href')
const url2 = ref('https://www.google.com')
const eventName = ref('click')
const eventHandling = ref('prevent')
const doSomething = () => {
    console.log('Button clicked!')
    alert('Button clicked!')
};
</script>