<template>
  <div class="bg-white mb-5">
    <div class="p-4 border-solid border-2 border-gray-100 m-3">
      <div class="flex items-center">
        <img
          class="rounded-full shadow-md mr-3"
          src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp"
          alt="avatar"
          width="60"
          height="60"
        />
        <div>
          <h6 class="font-bold text-primary mb-1">
            {{ feedback.user?.name }}
          </h6>
        </div>
      </div>
      <h6 class="mb-0 text-blue-400 font-bold text-lg">{{ feedback.category?.title }}</h6>
      <h6 class="mb-0">{{ feedback.title }}</h6>

      <p class="mb-0"></p>
      <p><span v-html="feedback.description"></span></p>
    </div>
    <CommentInput :feedback="feedback" />
    <CommentsSection :feedback="feedback" />
  </div>
</template>

<script setup>
import CommentInput from '@/components/HomePage/CommentInput.vue'
import CommentsSection from '@/components/HomePage/CommentsSection.vue'

import { toRefs } from 'vue'

const props = defineProps({
  feedback: Object
})

const { feedback } = toRefs(props)
</script>
