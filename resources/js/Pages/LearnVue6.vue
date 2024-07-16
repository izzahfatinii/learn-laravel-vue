<script setup>
    import SecondaryButton from '@/Components/SecondaryButton.vue'
    import { usePage } from '@inertiajs/vue3'

    // const { str }  = defineProps(['str']) // kenapa kena ada { }
    defineProps(['str2'])
    // const str  = defineProps(['str'])

    const emit = defineEmits() // kenapa boleh takda parameter ? kalau nak tambah macam mana ?
    // const emit = defineEmits(['update:str'])

    const changeStrInChild = () => {
        // emit('update:str', "Updated 'str' from Child")
        emit('updatestr', 'Updated \'str\' from Child') // still works sebab 'update:str' and 'updatestr' just a name
    }
</script>

<template>
    <p>
        <!-- When str declare without {} (const str  = defineProps(['str'])) -->
        <!-- Value in child (defineProps): {{ str.str }}  -->

        <!-- When str declare with {} (const { str }  = defineProps(['str'])) or without any variable (defineProps(['str'])) -->
        Value in child (defineProps): {{ str2 }} <br>
        usePage().props.str: {{ usePage().props.str }} <br>
        $page.props.str in child: {{ $page.props.str }} <br>

        <!-- Need to define emit(defineEmits)  -->
        <SecondaryButton @click="changeStrInChild">Change 'str' in ChildComponent</SecondaryButton> 

        <!-- No need to define emit(defineEmits), can $emit directly use  -->
        <SecondaryButton @click="$emit('updatestr', 'Updated \'str\' from Child using $emit')">Change 'str' in ChildComponent</SecondaryButton> 
    </p>
</template>