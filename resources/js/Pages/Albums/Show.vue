<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { capitalizeFirstLowercaseRest } from '@/helpers/strings';

const props = defineProps({
  album: Object,
});
</script>

<template>
  <AppLayout title="Show album">
    <h1 class="text-xl flex justify-center mt-3">{{ album.name.toUpperCase() }}</h1>
    <h2 class="text-l text-gray-800 flex justify-center">{{ capitalizeFirstLowercaseRest(album.artist) }}</h2>

    <div class="flex justify-center mt-4">
      <img class="sm:w-1/2 lg:w-1/5 block rounded" :src="`/storage/${album.image}`" alt="" />
    </div>

    <div class="flex justify-center mt-4">
      <ul class="list-disc">
        <li>Year: {{ album.year }}</li>
        <li>Label: {{ album.label }}</li>
        <li>Producer: {{ album.producer }}</li>
      </ul>

    </div>

  </AppLayout>
</template>
