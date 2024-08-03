<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { capitalizeFirstLowercaseRest } from '@/helpers/strings';
import { CheckCircleIcon } from '@heroicons/vue/20/solid';
import { XMarkIcon } from '@heroicons/vue/20/solid';
import { useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
  album: Object,
  errors: Object,
});

const form = useForm({
  id: props.album.id,
  artist: props.album.artist,
  name: props.album.name,
  year: props.album.year,
  label: props.album.label,
  producer: props.album.producer,
  image: props.album.image,
})

const page = usePage()
const flashMessage = computed(() => page.props.flash.message)

const submit = () => {
  form.post(route('album-update'), form)
}

function closeFlashModal() {
  const flashModal = document.getElementById('flashModal');
  flashModal.remove()
}
</script>

<template>
  <AppLayout title="Edit album">
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

    <h1 class="text-xl flex justify-center mt-3">{{ album.name.toUpperCase() }}</h1>
    <h2 class="text-l text-gray-800 flex justify-center">{{ capitalizeFirstLowercaseRest(album.artist) }}</h2>

    <div class="flex justify-center mt-4">
      <img class="sm:w-50 lg:w-100 block rounded" :src="`/storage/${album.image}`" alt="" />
    </div>

    <div class="flex justify-center mt-3">
      <div class="flex flex-col max-w-md mt-4">
        <form @submit.prevent="submit">
          <div class="flex flex-col max-w-md">
            <label for="year">Year:</label>
            <input id="year" v-model="form.year" />
            <div v-if="errors.year" class="text-red-500">{{ errors.year }}</div>

            <label for="label" class="mt-2">Label:</label>
            <input id="label" v-model="form.label" />
            <div v-if="errors.label" class="text-red-500">{{ errors.label }}</div>

            <label for="producer" class="mt-2">Producer:</label>
            <input id="producer" v-model="form.producer" />
            <div v-if="errors.producer" class="text-red-500">{{ errors.producer }}</div>
          </div>

          <button class="mt-4 w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">
            Submit
          </button>
        </form>
      </div>
    </div>


  </AppLayout>
</template>
