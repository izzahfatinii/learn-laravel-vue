<template>
    <div>
      <MyComponent class="bar2" :message="componentMessage" />
    </div>
    <div>
        <div :style="{ color: activeColor, fontSize: fontSize + 'px' }">This is Binding Inline Styles</div>
        <div :style="{ 'font-size': fontSize + 'px' }">This is Binding Inline using kebab-cased CSS </div>
        <div :style="styleObject">This using object style</div>
        <div :style="[styleObject, styleObject2]">This using array object style</div>
        <div :style="{ display: ['-webkit-box', '-ms-flexbox', 'flex'] }">Example Multiple Values</div> <!-- Not understand the use -->
    </div>

    <a :href="route('s.substr')" :style="{ color: 'red' }">try difference</a> <br>
    <Link :href="route('s.substr')" style="color: purple;">Hi</Link>

</template>
  
<script setup>
    import { ref, reactive } from 'vue'
    import { Link } from '@inertiajs/vue3';
    // Binding Inline Styles​
    // Binding to Objects
    import MyComponent from '@/Components/MyComponent.vue'
    const componentMessage = 'Hello!'

    // Binding Inline Styles
    const activeColor = ref('red')
    const fontSize = ref(30)
    const styleObject = reactive({
        color: 'green',
    })
    const styleObject2 = reactive({
        fontSize: '40px'
    })
</script>
  