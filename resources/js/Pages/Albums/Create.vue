<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { useForm } from '@inertiajs/vue3'
import FlashMessage from '@/Components/FlashMessage.vue'
import { ref } from 'vue'

const props = defineProps({
  artists: Array,
  errors: Object,
})

const creatingNewArtist = ref(false)

const form = useForm({
  artist_id: '',
  new_artist_name: '',
  name: '',
  year: '',
  label: '',
  producer: '',
  image: null,
})

function submit() {
  form.post(route('albums.store'))
}
</script>

<template>
  <AppLayout :title="$t('albums.create_new')">
    <FlashMessage />

    <main class="grid place-items-center min-h-screen px-4 py-8">
      <div class="w-full max-w-2xl bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-semibold text-center mb-6 text-gray-800 dark:text-gray-100">
          {{ $t('albums.create_new') }}
        </h1>

        <form @submit.prevent="submit" class="space-y-5">
          <!-- Artist -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
              {{ $t('albums.artist') }}
            </label>

            <!-- Select existing artist -->
            <div v-if="!creatingNewArtist" class="flex items-center space-x-2">
              <select
                v-model="form.artist_id"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-white"
                required
              >
                <option value="" disabled>{{ $t('albums.select_artist') }}</option>
                <option v-for="artist in props.artists" :key="artist.id" :value="artist.id">
                  {{ artist.name }}
                </option>
              </select>
              <button type="button" class="text-sm text-blue-600 underline" @click="creatingNewArtist = true">
                {{ $t('albums.create_new_artist') }}
              </button>
            </div>

            <!-- Create new artist -->
            <div v-else>
              <input
                v-model="form.new_artist_name"
                placeholder="New artist name"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-white"
              />
              <div class="flex justify-between items-center mt-1">
                <button type="button" class="text-sm text-red-600 underline" @click="creatingNewArtist = false">
                  {{ $t('buttons.cancel') }}
                </button>
              </div>
            </div>

            <p v-if="errors.artist_id || errors.new_artist_name" class="text-red-500 text-sm mt-1">
              {{ errors.artist_id || errors.new_artist_name }}
            </p>
          </div>

          <!-- Name -->
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
              {{ $t('albums.name') }}
            </label>
            <input
              id="name"
              v-model="form.name"
              required
              placeholder="In Rainbows"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-white"
            />
            <p v-if="errors.name" class="text-red-500 text-sm mt-1">{{ errors.name }}</p>
          </div>

          <!-- Year -->
          <div>
            <label for="year" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
              {{ $t('albums.year') }}
            </label>
            <input
              id="year"
              type="number"
              v-model="form.year"
              required
              placeholder="2007"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-white"
            />
            <p v-if="errors.year" class="text-red-500 text-sm mt-1">{{ errors.year }}</p>
          </div>

          <!-- Label -->
          <div>
            <label for="label" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
              {{ $t('albums.label') }}
            </label>
            <input
              id="label"
              v-model="form.label"
              placeholder="XL Recordings"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-white"
            />
            <p v-if="errors.label" class="text-red-500 text-sm mt-1">{{ errors.label }}</p>
          </div>

          <!-- Producer -->
          <div>
            <label for="producer" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
              {{ $t('albums.producer') }}
            </label>
            <input
              id="producer"
              v-model="form.producer"
              placeholder="Nigel Godrich"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-white"
            />
            <p v-if="errors.producer" class="text-red-500 text-sm mt-1">{{ errors.producer }}</p>
          </div>

          <!-- Image Upload -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
              {{ $t('albums.image') }}
            </label>
            <input
              type="file"
              class="mt-1 block w-full text-sm text-gray-700 dark:text-gray-200"
              @input="form.image = $event.target.files[0]"
            />
            <p v-if="errors.image" class="text-red-500 text-sm mt-1">{{ errors.image }}</p>

            <progress
              v-if="form.progress"
              :value="form.progress.percentage"
              max="100"
              class="mt-2 w-full"
            >
              {{ form.progress.percentage }}%
            </progress>
          </div>

          <!-- Submit Button -->
          <div class="flex justify-end">
            <button
              type="submit"
              :disabled="form.processing"
              class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-md transition disabled:opacity-50"
            >
              {{ $t('buttons.submit') }}
            </button>
          </div>
        </form>
      </div>
    </main>
  </AppLayout>
</template>
