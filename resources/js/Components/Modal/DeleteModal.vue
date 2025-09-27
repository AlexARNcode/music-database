<script setup>
import Modal from '@/Components/Modal.vue'
import { Link } from '@inertiajs/vue3'
import { useI18n } from 'vue-i18n'

const { t } = useI18n()

const props = defineProps({
  show: Boolean,
  title: {
    type: String,
    default: 'Are you sure?'
  },
  message: {
    type: String,
    required: true
  },
  deleteUrl: {
    type: String,
    required: true
  },
  deleteLabel: {
    type: String,
    default: 'Delete'
  }
})

const emit = defineEmits(['close'])

const closeModal = () => emit('close')
</script>

<template>
  <Modal :show="show" @close="closeModal">
    <div class="p-6">
      <h2 class="text-lg font-semibold text-gray-900 text-center">
        {{ title }}
      </h2>

      <p class="text-center text-gray-700 mt-4">
        {{ message }}
      </p>

      <div class="flex flex-col mt-6">
        <Link
          :href="deleteUrl"
          method="delete"
          as="button"
          type="button"
          class="mt-2 bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded text-center"
        >
          {{ deleteLabel }}
        </Link>

        <button
          @click.prevent="closeModal"
          class="mt-2 text-blue-500 hover:bg-blue-100 font-bold py-2 px-4 rounded"
        >
        {{ $t('buttons.cancel') }}
        </button>
      </div>
    </div>
  </Modal>
</template>
