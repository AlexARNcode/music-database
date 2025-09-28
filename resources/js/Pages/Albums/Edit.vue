<script setup>
import FlashMessage from '@/Components/FlashMessage.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { capitalizeFirstLowercaseRest } from '@/helpers/strings';
import { Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
  album: Object,
  errors: Object,
});

const form = useForm({
  id: props.album.id,
  artist_id: props.album.artist.id,
  name: props.album.name,
  year: props.album.year,
  label: props.album.label,
  producer: props.album.producer,
  image: props.album.image,
});

const submit = () => {
  form.put(route('albums.update', form.id));
};
</script>

<template>
  <AppLayout :title="$t('albums.edit', {name: album.name, artist: album.artist.name})">
    <FlashMessage />

    <div class="mb-4">
       <Link
        :href="route('albums.index')"
        class="text-blue-500 hover:underline"
      >
        &larr; {{ $t('albums.back_to_list') }}
      </Link>
    </div>

    <h1 class="text-xl flex justify-center mt-3">{{ album.name.toUpperCase() }}</h1>
    <h2 class="text-lg text-gray-400 flex justify-center mb-6">{{ capitalizeFirstLowercaseRest(album.artist.name) }}</h2>

    <div class="flex justify-center mb-6">
      <img
        class="sm:w-1/2 lg:w-1/5 rounded shadow-lg"
        :src="`/storage/${album.image}`"
        :alt="`Cover of album ${album.name}`"
      />
    </div>

    <div class="flex justify-center">
      <form @submit.prevent="submit" class="w-full max-w-md bg-gray-800 p-6 rounded shadow-md">
        <div class="flex flex-col">
          <label for="year" class="text-gray-300 font-semibold"> {{ $t('albums.year') }} </label>
          <input
            id="year"
            v-model="form.year"
            type="number"
            class="mt-1 rounded px-3 py-2 bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
          />
          <div v-if="errors.year" class="text-red-500 mt-1">{{ errors.year }}</div>

          <label for="label" class="text-gray-300 font-semibold mt-4"> {{ $t('albums.label') }} </label>
          <input
            id="label"
            v-model="form.label"
            type="text"
            class="mt-1 rounded px-3 py-2 bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
          />
          <div v-if="errors.label" class="text-red-500 mt-1">{{ errors.label }}</div>

          <label for="producer" class="text-gray-300 font-semibold mt-4"> {{ $t('albums.producer') }} </label>
          <input
            id="producer"
            v-model="form.producer"
            type="text"
            class="mt-1 rounded px-3 py-2 bg-gray-700 border border-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
          />
          <div v-if="errors.producer" class="text-red-500 mt-1">{{ errors.producer }}</div>
        </div>

        <button
          type="submit"
          class="mt-6 w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition"
        >
          {{ $t('buttons.submit') }}
        </button>
      </form>
    </div>
  </AppLayout>
</template>
