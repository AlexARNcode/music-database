<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    routeName: {
        type: String,
        default: 'albums.index'
    }
});
</script>

<template>
    <div class="mb-6">
        <Link
            :href="route(props.routeName)"
            class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-white rounded-md shadow-sm hover:bg-gray-200 dark:hover:bg-gray-700 transition"
        >
        <svg
        xmlns="http://www.w3.org/2000/svg"
        class="h-4 w-4 mr-2"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
        stroke-width="2"
        >
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
        {{ $t('albums.back_to_list') }}
    </Link>
</div>
</template>