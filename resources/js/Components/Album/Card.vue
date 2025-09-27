<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import { capitalizeFirstLowercaseRest } from '@/helpers/strings';
import DeleteModal from '@/Components/Modal/DeleteModal.vue';

const props = defineProps({
  album: Object,
});

const showModal = ref(false);
const toggleModal = () => showModal.value = !showModal.value;
</script>

<template>
  <div
    class="bg-gray-900 shadow-lg rounded p-3 hover:shadow-xl transition cursor-default"
  >
    <Link :href="route('album-show', album)" class="block group cursor-pointer">
      <img
        :src="`/storage/${album.image}`"
        :alt="`Cover of album ${album.name}`"
        class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
      />

      <div class="p-5">
        <h3 class="text-white text-lg">{{ album.name.toUpperCase() }}</h3>
        <p class="text-gray-400">{{ capitalizeFirstLowercaseRest(album.artist) }}</p>
      </div>
    </Link>

    <!-- Action Buttons -->
    <div class="flex justify-evenly w-full mt-4 space-x-2">
      <Link
        :href="route('album-edit', album)"
        class="flex-1"
        @click.stop
      >
        <button
          class="w-full px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-500 transition"
          type="button"
        >
          {{ $t('buttons.edit') }}
        </button>
      </Link>

      <button
        @click.stop="toggleModal"
        class="flex-1 px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-500 transition"
        type="button"
      >
        {{ $t('buttons.delete') }}
      </button>
    </div>

    <DeleteModal
      :show="showModal"
      title="Delete Album"
      :message="`Delete the album '${capitalizeFirstLowercaseRest(album.name)}' by ${capitalizeFirstLowercaseRest(album.artist)}?`"
      :delete-url="route('album-delete', album)"
      delete-label="Yes, delete this album"
      @close="toggleModal"
    />
  </div>
</template>
