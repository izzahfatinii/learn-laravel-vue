<template>
    <div>
        <h1>User List</h1>
        <ul>
            <li v-for="user in users" :key="user.id">
                {{ user.name }} - {{ user.email }}
            </li>
        </ul>
    </div>
</template>
  
<script setup>
    import { ref, onMounted } from 'vue';
    import axios from 'axios';
    
    const users = ref([]);
    const fetchUsers = () => {
        axios
        .get('https://book-app.test/api/users')
        .then((response) => {
            users.value = response.data.data;
        });
    };
    
    onMounted(fetchUsers);
</script>
  