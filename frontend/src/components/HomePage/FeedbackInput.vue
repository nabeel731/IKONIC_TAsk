<template>
  <div class="max-w-xl mx-auto flex w-full flex-col border rounded-lg bg-white">
    <p
      class="text-red-700 px-4 py-3 rounded relative mb-2 mt-2"
      role="alert"
      v-if="feedbackStore.errorMessage"
    >
      {{ feedbackStore.errorMessage }}
    </p>
    <form class="p-3" method="post" @submit.prevent="formSubmit">
      <div class="grid grid-cols-2 gap-2 content-center w-full">
        <div>
          <input
            type="text"
            v-model="payload.title"
            placeholder="Enter Feedback Title"
            :class="{
              'bg-red-50 border border-red-500 text-red-900 ':
                feedbackStore.errorMessage &&
                feedbackStore.errorMessage.toLowerCase().includes('title')
            }"
            class="w-full rounded border border-gray-300 bg-white py-1 px-3 text-base leading-8 text-gray-700 outline-none transition-colors duration-200 ease-in-out focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
          />
        </div>

        <div>
          <select
            id="countries"
            v-model="payload.category"
            :class="{
              'bg-red-50 border border-red-500 text-red-900 ':
                feedbackStore.errorMessage &&
                feedbackStore.errorMessage.toLowerCase().includes('category')
            }"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          >
            <option value="" disabled>Select Category</option>
            <option v-for="item in feedbackStore.categories" :key="item.id" :value="item.id">
              {{ item.title }}
            </option>
          </select>
        </div>
      </div>

      <div class="my-4">
        <label for="description" class="text-sm font-medium text-gray-900 dark:text-white"
          >Description</label
        >
        <div id="app" class="mt-2">
          <ckeditor :editor="editor" v-model="payload.description"></ckeditor>
        </div>
      </div>
      <button
        :disabled="feedbackStore.formLoading"
        class="rounded border-0 py-2 px-6 text-lg text-white bg-blue-500 hover:bg-blue-600 focus:outline-none"
      >
        {{ feedbackStore.formLoading ? 'Submitting...' : 'Add Feedback' }}
      </button>
    </form>
  </div>
</template>

<script setup>
import { reactive } from 'vue'
import { useFeedBackStore } from '@/stores/feedback.js'
import { onMounted } from 'vue'

const feedbackStore = useFeedBackStore()

const payload = reactive({
  title: '',
  category: '',
  description: ''
})

onMounted(async () => {
  feedbackStore.getCategories()
})

const formSubmit = async () => {
  if (!payload.title) {
    feedbackStore.errorMessage = 'Title  Field Is Required'
  } else if (!payload.category) {
    feedbackStore.errorMessage = 'Category Field Is Required'
  } else if (!payload.description) {
    feedbackStore.errorMessage = 'description Field Is Required'
  }

  if (feedbackStore.errorMessage) {
    return
  }

  feedbackStore.AddFeedback(payload)
  feedbackStore.errorMessage = ''
  payload.title = ''
  payload.category = ''
  payload.description = ''
}
</script>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
import CKEditor from '@ckeditor/ckeditor5-vue'

export default {
  name: 'app',
  components: {
    ckeditor: CKEditor.component
  },
  data() {
    return {
      editor: ClassicEditor
    }
  }
}
</script>
