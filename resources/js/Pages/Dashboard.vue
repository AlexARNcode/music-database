<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import axios from 'axios';
import { onMounted } from 'vue';

let albums = [];

onMounted(() => {
  axios.get('album').then(function (response) {
    albums = response.data;
  })
})

</script>

<template>
    <AppLayout title="Dashboard">
        <div v-for="album in albums">
            <div class="mt-4">
                <ul>
                    <li>{{ album.name }}</li>
                    <li>{{ album.year }}</li>
                    <li>{{ album.label }}</li>
                    <li>{{ album.producer }}</li>
                    <li>{{ album.image }}</li>
                </ul>
            </div>
        
        </div>
    </AppLayout>
</template>
