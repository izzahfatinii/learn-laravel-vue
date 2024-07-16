<template>
    <h1 class="font-bold text-2xl">Binding with Components</h1>

    <div class="container"> 
        <p class="foo bar">{{ message }}</p> <!-- it follows MyComponent class -->
        <span>This is a child component</span>
    </div>

    <p :class="$attrs.class">{{ message }}</p> <!-- it follows class that use the component, without :class="$attrs.class" cannot access style-->
    <span>This is a child component</span>
</template>
  
<script setup>
    // Import the necessary components or define props if needed
    import { ref } from 'vue';

    // Define props
    const props = defineProps({
        message: String,
    })

    // Define some local state or computed properties if needed
    const componentMessage = ref(props.message);
</script>
  
<style scoped>
    /* Define some styles for the component */
    .foo {
    font-weight: bold;
    }

    .bar {
    color: blue;
    }

    .bar2 {
    color: red;
    }

    .container {
    border: 1px solid gray;
    padding: 10px;
    }
</style>
  