<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faPenToSquare, faTrash, faMagnifyingGlass } from '@fortawesome/free-solid-svg-icons';
import FlashMessage from '@/Components/FlashMessage.vue';
import Card from '@/Components/Album/Card.vue';

library.add(faPenToSquare, faTrash, faMagnifyingGlass);

const props = defineProps({
  albums: Object,
  message: Object,
});
</script>

<template>
  <AppLayout :title="$t('albums.list')">
    <FlashMessage />

    <h1 class="text-xl flex justify-center mt-3">{{ $t('albums.title')}}</h1>

    <div v-if="props.albums && props.albums.length <= 0" class="text-center mt-8">
      <p>{{ $t('albums.not_any') }}</p>
      <p class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
        <Link href="/albums/create">
        {{ $t('albums.add') }}
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
