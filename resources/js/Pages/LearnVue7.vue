<template>
    <div>
        <!-- <LearnVue6 :str="str" @update:str="updateStr"/> 'str' is passed as the 'str' prop -->
        <LearnVue6 :str2="str2" @updatestr="updateStr"/>
        <PrimaryButton @click="changeStr">Change 'str' in ParentComponent</PrimaryButton>
    </div><br>
    <div>
        usePage().props.str => {{ usePage().props.str }} <br>
        $page.props.str => {{ $page.props.str }}
    </div><br>
    <div>
        defineProps(['str']) => {{ str }}
    </div>
</template>
  
<script setup>
    import LearnVue6 from './LearnVue6.vue'
    import PrimaryButton from '@/Components/PrimaryButton.vue'
    import { ref } from 'vue'
    import { usePage } from '@inertiajs/vue3' // usePage() is what is in the session - refer HandleInertiaRequest

    const str2 = ref("Hello from Parent")
  
    const changeStr = () => {
        str2.value = "Updated 'str' from Parent"
    }

    const updateStr = (newStr) => {
        str2.value = newStr
    }

    // 2 ways of get the props from backend
    // const str3 = usePage().props.str // usePage() from inertia - only backend to frontend, between child to parent cannot
    defineProps(['str']) // defineProps from vue - can both backend to frontend, and between child to parent

    console.log(usePage().props)
</script>
  