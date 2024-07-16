<template>
    <div>
        <h1>Welcome to Laravel</h1>
        <p>Hello, {{ name }}!</p>

        <!-- <PrimaryButton> 
            <Link :href="route('missing.parameter')">Try go to missing.parameter</Link>
        </PrimaryButton> -->

        <br>
        <form @submit.prevent="submit()">
            <label for="first_name">First name:</label>
            <input id="first_name" v-model="form.first_name" /> <br>
            <label for="last_name">Last name:</label>
            <input id="last_name" v-model="form.last_name" /> <br>
            <label for="email">Email:</label>
            <input id="email" v-model="form.email" /> <br>
            <label for="file">File:</label>
            <input type="file" id="file" @change="handleFileChange"/> <br>

            <PrimaryButton type="submit">Submit</PrimaryButton> <br>
        </form>
    </div>
</template>

<script setup>
import { ref, defineProps, reactive } from 'vue';
import { Link, usePage, useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { router } from '@inertiajs/vue3'


defineProps({
    name: String,
});

const form = useForm({
    first_name: null,
    last_name: null,
    email: null,
    token: 'my-secret-token',
    bool: false,
    date: new Date,
    votes: 2,
    file: null,
})

const handleFileChange = (event) => {
    console.log(event.target.files[0])
    const selectedFile = event.target.files[0];
    form.file = selectedFile;
};

function submit()   {
    form.post(route('post_laravel'))
    // form.post('/example') // try invokecontroller
}
</script>
  