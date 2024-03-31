<script setup>
import FeedbackCard from '@/components/HomePage/FeedbackCard.vue'
import FeedbackInput from '@/components/HomePage/FeedbackInput.vue'
import { useFeedBackStore } from '@/stores/feedback.js'
import router from '@/router/index.js'
import { onMounted } from 'vue'

const feedbackStore = useFeedBackStore()
onMounted(async () => {
  feedbackStore.getfeedback()
})

function logout() {
  localStorage.removeItem('TOKEN')
  router.push('/login')
}
</script>

<template>
  <main class="bg-gray-200">
    <div
      class="container mx-auto my-5 py-5 overflow-y-auto h-screen bg-white my-5"
      style="max-width: 650px"
    >
      <div class="flex justify-end p-4">
        <button
          @click="logout"
          class="flex items-center bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-full shadow-md transform transition-all duration-300 ease-in-out"
        >
          <span class="mr-2">Logout</span>
          <svg
            class="w-6 h-6"
            aria-hidden="true"
            focusable="false"
            data-prefix="fas"
            data-icon="sign-out-alt"
            role="img"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 512 512"
          >
            <path
              fill="currentColor"
              d="M176 128v64h120c13.2 0 24 10.8 24 24v80h32c13.2 0 24 10.8 24 24v96c0 13.2-10.8 24-24 24H320v80c0 13.2-10.8 24-24 24H176c-13.2 0-24-10.8-24-24v-96c0-13.2 10.8-24 24-24h32v-80c0-13.2 10.8-24 24-24h120v-64H176zm208 104c6.6 0 12-5.4 12-12v-80c0-6.6-5.4-12-12-12H200c-6.6 0-12 5.4-12 12v80c0 6.6 5.4 12 12 12h184z"
            ></path>
          </svg>
        </button>
      </div>
      <section class="flex justify-center">
        <FeedbackInput />
      </section>

      <div class="px-4">
        <hr class="mt-4" />
        <h1 class="text-center text-xl font-bold my-4">Feedbacks</h1>
        <hr class="mb-4" />
      </div>

      <div class="w-full">
        <FeedbackCard
          v-for="feedback in feedbackStore.feedbacks"
          :key="feedback.id"
          :feedback="feedback"
        />

        <div class="flex justify-center mb-3">
          <button
            v-if="!feeloadingnextPage && feedbackStore.page < feedbackStore.totalPages"
            class="bg-white cursor-pointer text-center py-1 px-4 border border-2 border-gray-500 text-gray-500"
            @click="feedbackStore.loadNextPage()"
          >
            Load More
          </button>

          <p v-if="feedbackStore.loadingnextPage">Loading...</p>
        </div>
      </div>
    </div>
  </main>
</template>
