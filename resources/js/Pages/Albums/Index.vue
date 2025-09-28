<script setup>
import { Link, usePage } from '@inertiajs/vue3';

import AppLayout from '@/Layouts/AppLayout.vue';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faPenToSquare, faTrash, faMagnifyingGlass } from '@fortawesome/free-solid-svg-icons';
import FlashMessage from '@/Components/FlashMessage.vue';
import Card from '@/Components/Album/Card.vue';

const props = defineProps({
  albums: Object,
  message: Object,
});

const page = usePage();
</script>

<template>
  <AppLayout :title="$t('albums.list')">
    <FlashMessage />

    <h1 class="text-xl flex justify-center mt-3">{{ $t('albums.title')}}</h1>

    <div v-if="props.albums.data && props.albums.data.length <= 0" class="text-center mt-8">
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
          <div v-for="album in props.albums.data" :key="album.id">
            <Card :album="album" />
          </div>
        </section>

        <!-- Pagination Controls -->
        <nav aria-label="Pagination" class="mt-8 flex justify-center flex-wrap gap-2">
          <!-- Previous Button -->
          <Link
            v-if="props.albums.prev_page_url"
            :href="props.albums.prev_page_url"
            class="px-3 py-1 bg-gray-700 text-white rounded hover:bg-gray-600"
            preserve-scroll
          >
            {{ $t('pagination.previous') }}
          </Link>

          <!-- Page Numbers -->
          <template v-for="pageNum in props.albums.last_page" :key="pageNum">
            <Link
              :href="`?page=${pageNum}`"
              :class="[
                'px-3 py-1 rounded',
                $page.url.includes(`page=${pageNum}`) || (!$page.url.includes('page=') && pageNum === 1)
                  ? 'bg-blue-600 text-white'
                  : 'bg-gray-700 text-gray-300 hover:bg-gray-600'
              ]"
              preserve-scroll
            >
              {{ pageNum }}
            </Link>
          </template>

          <!-- Next Button -->
          <Link
            v-if="props.albums.next_page_url"
            :href="props.albums.next_page_url"
            class="px-3 py-1 bg-gray-700 text-white rounded hover:bg-gray-600"
            preserve-scroll
          >
             {{ $t('pagination.next') }}
          </Link>
        </nav>
      </div>
    </main>
  </AppLayout>
</template>
