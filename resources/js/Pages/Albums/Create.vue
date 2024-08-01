<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { CheckCircleIcon, XMarkIcon } from '@heroicons/vue/20/solid'

defineProps(
  { errors: Object },
)
const page = usePage()

const flashMessage = computed(() => page.props.flash.message)

const form = useForm({
  artist: null,
  name: null,
  year: null,
  label: null,
  producer: null,
  image: null,
})

function submit() {
  form.post(route('album-store'))
}

function closeFlashModal() {
  const flashModal = document.getElementById('flashModal');
  flashModal.remove()
}
</script>

<template>
  <AppLayout title="Create a new album">
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

    <h1 class="text-xl flex justify-center mt-3">Create New Album</h1>

    <form @submit.prevent="submit">
      <div class="flex justify-center mt-3">
        <div class="flex flex-col max-w-md">
          <label for="artist">Band/Artist:</label>
          <input id="artist" v-model="form.artist" required />
          <div v-if="errors.artist" class="text-red-500">{{ errors.artist }}</div>

          <label for="name" class="mt-4">Name:</label>
          <input id="name" v-model="form.name" required />
          <div v-if="errors.name" class="text-red-500">{{ errors.name }}</div>

          <label for="year" class="mt-4">Year:</label>
          <input id="year" v-model="form.year" type="number" required />
          <div v-if="errors.year" class="text-red-500">{{ errors.year }}</div>

          <label for="label" class="mt-4">Label:</label>
          <input id="label" v-model="form.label" />
          <div v-if="errors.label" class="text-red-500">{{ errors.label }}</div>

          <label for="producer" class="mt-4">Producer:</label>
          <input id="producer" v-model="form.producer" />
          <div v-if="errors.producer" class="text-red-500">{{ errors.producer }}</div>

          <input type="file" class="mt-4" @input="form.image = $event.target.files[0]" />
          <div v-if="errors.image" class="text-red-500">{{ errors.image }}</div>

          <progress v-if="form.progress" :value="form.progress.percentage" max="100">
            {{ form.progress.percentage }}%
          </progress>

          <button class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            type="submit">Submit</button>
        </div>
      </div>

    </form>
  </AppLayout>
</template>
