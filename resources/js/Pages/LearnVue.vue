<script setup>
import { ref } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const try1 = ref('Hello from try1');
const updatetry1 = () => {
    try1.value = ('inside udatetry1');
    console.log(try1);
}
</script>

<template>
    <div>{{ try1 }}</div>
    <SecondaryButton @click.prevent="updatetry1">updatetry1</SecondaryButton><br>
    
    <h1 class="font-bold text-2xl">Modifier</h1>
    <PrimaryButton @click.prevent="console.log(try1)">.prevent</PrimaryButton><br>
    <SecondaryButton @click.once="console.log(try1)">.once</SecondaryButton><br>
    <input type = "text" @keyup.enter = "console.log(try1)" />
    <div class="root" @click="console.log('root')">root
        <div class="parent" @click.self="console.log('parent')">Parent
            <div class="child" @click="console.log('child')">Child</div>
        </div>
    </div>
    <div>Hello</div>
    <div class="class"></div>
</template>
 