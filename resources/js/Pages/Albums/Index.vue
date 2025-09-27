<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { capitalizeFirstLowercaseRest } from '@/helpers/strings';
import { Link } from '@inertiajs/vue3';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faPenToSquare, faTrash, faMagnifyingGlass } from '@fortawesome/free-solid-svg-icons';
import Modal from '@/Components/Modal.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import Card from '@/Components/Album/Card.vue';

library.add(faPenToSquare, faTrash, faMagnifyingGlass);

const props = defineProps({
  albums: Object,
  message: Object,
});
</script>

<template>
  <AppLayout title="List of albums">
    <FlashMessage />

    <h1 class="text-xl flex justify-center mt-3">Albums</h1>

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

    <div v-if="props.albums && props.albums.length <= 0" class="text-center mt-8">
      <p>There is currently no album in the database.</p>
      <p class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
        <Link href="/albums/create">
        You can add albums here.
        </Link>
      </p>
    </div>

    <main class="grid place-items-center min-h-screen p-5">
      <div>
        <section class="grid grid-cols-1 sm:grid-cols-3 gap-4">
          <!-- Album list -->
          <div v-for="album in props.albums">
            <Card :album="album" />
          </div>
        </section>
      </div>
    </main>
  </AppLayout>
</template>
