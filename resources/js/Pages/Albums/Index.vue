<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { capitalizeFirstLowercaseRest } from '@/helpers/strings';
import { Link } from '@inertiajs/vue3';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faEdit, faPenToSquare } from '@fortawesome/free-solid-svg-icons';

let albums = [];

library.add(faPenToSquare);

const props = defineProps({
  albums: Object
});

</script>

<template>
  <AppLayout title="List of albums">
    <h1 class="text-xl flex justify-center mt-3">Albums</h1>

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

                  <button
                    class="hover:scale-110 text-white opacity-0 transform translate-y-3 group-hover:translate-y-0 group-hover:opacity-100 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                      class="bi bi-three-dots" viewBox="0 0 16 16">
                      <path
                        d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                    </svg>
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
