<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import { capitalizeFirstLowercaseRest } from '@/helpers/strings';
import DeleteModal from '@/Components/Modal/DeleteModal.vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import Back from '@/Components/Back.vue';

const props = defineProps({
  album: Object,
});


const showModal = ref(false);
const toggleModal = () => (showModal.value = !showModal.value);
</script>

<template>
  <AppLayout :title="album.name.toUpperCase()">
    <Back routeName="albums.index" />

    <div class="max-w-4xl mx-auto p-6 bg-gray-900 rounded-lg shadow-lg mt-6">
      <!-- Album Cover -->
      <img
        :src="album.image ? `/storage/${album.image}` : '/storage/images/default/default-album.png'"
        :alt="`Cover of album ${album.name}`"
        class="mx-auto rounded-md shadow-lg max-w-full max-h-96 object-contain"
      />



      <!-- Album Info -->
      <div class="mt-6 text-center">
        <h1 class="text-3xl font-bold text-white">{{ album.name.toUpperCase() }}</h1>
        <h2 class="text-xl text-gray-400 mt-1">{{ capitalizeFirstLowercaseRest(album.artist.name) }}</h2>
      </div>

      <!-- Additional Details -->
      <ul class="mt-6 space-y-2 text-gray-300 text-sm sm:text-base max-w-md mx-auto">
        <li>
          <font-awesome-icon icon="calendar" class="mr-2 text-blue-400" />
          <strong>{{ $t('albums.year') }}:</strong> {{ album.year }}
        </li>
        <li>
          <font-awesome-icon icon="building" class="mr-2 text-blue-400" />
          <strong>{{ $t('albums.label') }}:</strong> {{ album.label }}
        </li>
        <li>
          <font-awesome-icon icon="user" class="mr-2 text-blue-400" />
          <strong>{{ $t('albums.producer') }}:</strong> {{ album.producer }}
        </li>
      </ul>

      <!-- Action Buttons -->
      <div class="flex justify-center space-x-6 mt-10">
        <Link :href="route('albums.edit', album)">
          <button
            class="flex items-center space-x-2 bg-blue-600 hover:bg-blue-500 text-white font-semibold py-2 px-5 rounded transition"
            type="button"
          >
            <span>{{ $t('buttons.edit') }}</span>
          </button>
        </Link>

        <button
          @click="toggleModal"
          class="flex items-center space-x-2 bg-red-600 hover:bg-red-500 text-white font-semibold py-2 px-5 rounded transition"
          type="button"
        >
          <span>{{ $t('buttons.delete') }}</span>
        </button>
      </div>

      <!-- Delete Confirmation Modal -->
      <DeleteModal
        :show="showModal"
        title="Delete Album"
        :message="`Delete the album '${capitalizeFirstLowercaseRest(album.name)}' by ${capitalizeFirstLowercaseRest(album.artist.name)}?`"
        :delete-url="route('albums.destroy', album)"
        delete-label="Yes, delete this album"
        @close="toggleModal"
      />
    </div>
  </AppLayout>
</template>
