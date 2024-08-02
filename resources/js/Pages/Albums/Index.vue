<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { capitalizeFirstLowercaseRest } from '@/helpers/strings';
import { Link, usePage } from '@inertiajs/vue3';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faPenToSquare, faTrash } from '@fortawesome/free-solid-svg-icons';
import Modal from '@/Components/Modal.vue';
import { computed, ref } from 'vue';
import { CheckCircleIcon } from '@heroicons/vue/20/solid';
import { XMarkIcon } from '@heroicons/vue/20/solid';

library.add(faPenToSquare, faTrash);

const props = defineProps({
  albums: Object,
  message: Object,
});

const page = usePage()
const flashMessage = computed(() => page.props.flash.message)

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

function closeFlashModal() {
  const flashModal = document.getElementById('flashModal');
  flashModal.remove()
}

</script>

<template>
  <AppLayout title="List of albums">
    <h1 class="text-xl flex justify-center mt-3">Albums</h1>

    <div v-if="flashMessage" class="text-green-700 font-bold">
      <div class="rounded-md bg-green-50 p-4" id="flashModal">
        <div class="flex">
          <div class="flex-shrink-0">
            <CheckCircleIcon class="h-5 w-5 text-green-400" aria-hidden="true" />
          </div>
          <div class="ml-3">
            <p class="text-sm font-medium text-green-800">{{ flashMessage }}</p>
          </div>
          <div class="ml-auto pl-3">
            <div class="-mx-1.5 -my-1.5">
              <button @click="closeFlashModal" type="button"
                class="inline-flex rounded-md bg-green-50 p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50">
                <span class="sr-only">Dismiss</span>
                <XMarkIcon class="h-5 w-5" aria-hidden="true" />
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <Modal :show="showModal">
      <div class="p-8">
        <p class="text-center">
          Delete the album <span class="font-bold">{{ capitalizeFirstLowercaseRest(albumToDelete.name) }}</span>
          by <span class="font-bold">{{ capitalizeFirstLowercaseRest(albumToDelete.artist) }}</span>?
        </p>
        <div class="flex flex-col">
          <Link :href="route('album-delete', albumToDelete)" @click.prevent="hideDeleteConfirmationModal" method="delete" as="button" type="button"
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
          <div v-for="album in props.albums">
            <div class="bg-gray-900 shadow-lg rounded p-3">
              <div class="group relative">
                <img class="w-full md:w-72 block rounded" :src="`/storage/${album.image}`" alt="" />
                <Link :href="route('album-show', album)">
                <div
                  class="absolute bg-black rounded bg-opacity-0 group-hover:bg-opacity-60 w-full h-full top-0 flex items-center group-hover:opacity-100 transition justify-evenly">
                  <Link :href="route('album-edit', album)">
                  <button
                    class="hover:scale-110 text-white opacity-0 transform translate-y-3 group-hover:translate-y-0 group-hover:opacity-100 transition">
                    <font-awesome-icon icon="pen-to-square" />
                  </button>
                  </Link>

                  <button
                    class="hover:scale-110 text-white opacity-0 transform translate-y-3 group-hover:translate-y-0 group-hover:opacity-100 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                      class="bi bi-play-circle-fill" viewBox="0 0 16 16">
                      <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.79 5.093A.5.5 0 0 0 6 5.5v5a.5.5 0 0 0 .79.407l3.5-2.5a.5.5 0 0 0 0-.814l-3.5-2.5z" />
                    </svg>
                  </button>

                  <button @click.prevent="showDeleteConfirmationModal(album)"
                    class="hover:scale-110 text-white opacity-0 transform translate-y-3 group-hover:translate-y-0 group-hover:opacity-100 transition">
                    <font-awesome-icon icon="trash" />
                  </button>
                </div>
                </Link>
              </div>
              <div class="p-5">
                <h3 class="text-white text-lg">{{ album.name.toUpperCase() }}</h3>
                <p class="text-gray-400">{{ capitalizeFirstLowercaseRest(album.artist) }}</p>
              </div>
            </div>
          </div>
        </section>
      </div>
    </main>
  </AppLayout>
</template>
