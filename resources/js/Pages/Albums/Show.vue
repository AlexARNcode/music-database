<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { capitalizeFirstLowercaseRest } from '@/helpers/strings';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faPenToSquare, faTrash, faMagnifyingGlass } from '@fortawesome/free-solid-svg-icons';
import { Link } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import { ref } from 'vue';

const props = defineProps({
  album: Object,
});

library.add(faPenToSquare, faTrash);

const showModal = ref(false);
const albumToDelete = ref(null);

const showDeleteConfirmationModal = (album) => {
  albumToDelete.value = album;
  toggleDeleteConfirmationModal()
}

const hideDeleteConfirmationModal = () => {
  toggleDeleteConfirmationModal()
}

const toggleDeleteConfirmationModal = () => {
  showModal.value = !showModal.value;
}
</script>

<template>
  <AppLayout title="Show album">
    <Modal :show="showModal">
      <div class="p-8">
        <p class="text-center">
          Delete the album <span class="font-bold">{{ capitalizeFirstLowercaseRest(albumToDelete.name) }}</span>
          by <span class="font-bold">{{ capitalizeFirstLowercaseRest(albumToDelete.artist) }}</span>?
        </p>
        <div class="flex flex-col">
          <Link :href="route('album-delete', albumToDelete)" @click.prevent="hideDeleteConfirmationModal"
            method="delete" as="button" type="button"
            class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
          Delete
          </Link>

          <button @click.prevent="hideDeleteConfirmationModal"
            class="mt-2 text-blue-500 hover:bg-blue-100 font-bold py-2 px-4 rounded" type="submit">
            Cancel
          </button>
        </div>
      </div>
    </Modal>

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

    <div class="flex justify-center mt-8">
      <!-- Edit button -->
      <Link :href="route('album-edit', album)">
      <button>
        <font-awesome-icon icon="pen-to-square" class="text-blue-500 hover:text-blue-600" />
      </button>
      </Link>


      <!-- Delete button -->
      <button @click.prevent="showDeleteConfirmationModal(album)">
        <font-awesome-icon icon="trash" class="ml-4 text-blue-500 hover:text-blue-600" />
      </button>
    </div>

  </AppLayout>
</template>
