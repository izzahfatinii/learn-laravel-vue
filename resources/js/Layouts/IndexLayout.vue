<script setup>
    import { ref } from "vue";
    import { Head, Link } from '@inertiajs/vue3';
    import SecondaryButton from '@/Components/SecondaryButton.vue';

    defineProps({
        title: String,
    });
</script>

<template>
    <Head :title="title" />

    <div class="p-14">
        <div class="p-2 flex justify-between items-baseline border-b border-slate-200">
            <h1 class="text-2xl font-bold">String Practice</h1>
            
            <SecondaryButton>
                <Link :href="route('dashboard')">Back</Link>
            </SecondaryButton>
        </div>
        <div class="p-2 inline-flex">
            <div class="z-200 w-64">
                <div class="h-fullover flow-y-auto bg-gray-50">
                    <ul>
                        <Link :href="route('s.substr')">
                            <li class="px-4 py-1 border-b bg-yellow-50 hover:bg-yellow-100">String</li>
                        </Link>
                        <Link :href="route('m.abs')">
                            <li class="px-4 py-1 border-b bg-slate-50 hover:bg-slate-100">Math</li>
                        </Link>
                        <Link :href="route('s.substr')">
                            <li class="px-4 py-1 border-b bg-yellow-50 hover:bg-yellow-100">BC Math</li>
                        </Link>
                    </ul>
                </div>
    
            </div>
            <div class="px-4">
                <slot/>
            </div>
        </div>
    </div>
</template>