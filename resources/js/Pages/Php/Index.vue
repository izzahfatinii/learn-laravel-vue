<script setup>
    import { ref } from "vue";
    import { usePage, useForm } from '@inertiajs/vue3';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import CodeSection from '@/Components/CodeSection.vue'
    import IndexLayout from "@/Layouts/IndexLayout.vue";
    import TextInput from "@/Components/TextInput.vue";

    const str = ref(usePage().props.str);
    const form = useForm({
        testcode: "",
    });

    const areBracketsBalanced = (expr) =>{
        let stack = [];

        for(let i = 0; i < expr.length; i++)    {
            let x = expr[i];
    
            if (x == '(' || x == '[' || x == '{' )   {
                stack.push(x);
            }

            else    {
                let check;
                switch (x){
                case ')':
                    check = stack.pop();
                    break;
        
                case '}':
                    check = stack.pop();
                    break;
        
                case ']':
                    check = stack.pop();
                    break;
                }
            }
        }
    
        return (stack.length == 0);
    }

    const submit = () => {
        console.log(areBracketsBalanced(form.testcode));
        if (areBracketsBalanced(form.testcode)) {
            form.post(route('testcode'));
        }
    };


</script>

<template>
    <IndexLayout title="String"> 
        <div class="grid grid-cols-2 gap-3">
            <div class="p-6 bg-slate-200 rounded-lg">
                <h1 class="font-bold">
                    {{ $page.props.str.function }}
                </h1>
                <p class="py-2 text-sm font-medium text-slate-500">
                    {{ $page.props.str.details }}
                </p>
                Example: <br> 
                <CodeSection>
                    {{ $page.props.str.example }}
                </CodeSection>
                Code: <br>
                <CodeSection>
                    {{ $page.props.str.code }}
                </CodeSection>
                Output: <br> 
                <CodeSection>
                    {{ $page.props.str.output }}
                </CodeSection>
            </div>
            <form 
                class="flex flex-wrap gap-3"
                @submit.prevent="submit()"
            >
                <TextInput
                    id="testcode"
                    v-model="form.testcode"
                    type="text"
                    class="mt-1 flex w-full"
                />
                {{ $page.props.success }}
                <PrimaryButton type="submit" class="h-1/6" >Run</PrimaryButton>
            </form>
        </div>
    </IndexLayout>
</template>