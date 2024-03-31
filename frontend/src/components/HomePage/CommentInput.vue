<template>
  <form class="space-y-4 md:space-y-6" method="post" @submit.prevent="Addcomment">
    <div class="bg-gray-100 p-3">
      <p
        class="text-red-700 px-4 py-3 rounded relative mb-2 mt-2"
        role="alert"
        v-if="feedbackStore.errorCommentMessage"
      >
        {{ feedbackStore.errorCommentMessage }}
      </p>
      <div class="flex items-start">
        <div class="w-full">
          <textarea
            v-model="comment"
            @input="handleInput"
            class="w-full p-3 py-2 bg-white border rounded-md focus:outline-none focus:border-blue-500"
            id="textAreaExample"
            rows="1"
            placeholder="Write a comment..."
          ></textarea>
          <div class="bg-white p-6 rounded-lg shadow-md" v-if="mentionMenuOpen">
            <ul>
              <li
                v-for="(user, index) in feedbackStore.userslist"
                :key="index"
                @click="insertUser(user.name)"
              >
                <span class="cursor-pointer">@{{ user.name }}</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="mt-2 flex justify-end">
        <!-- <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md mr-2">
          Post comment
        </button> -->

        <button type="submit">
          <i class="fa fa-paper-plane text-blue-400 me-2" aria-hidden="true"></i>
        </button>
      </div>
    </div>
  </form>
</template>

<script setup>
import { toRefs, ref } from 'vue'
import { useFeedBackStore } from '@/stores/feedback.js'

import { debounce } from 'lodash'

const feedbackStore = useFeedBackStore()

const props = defineProps({
  feedback: Object
})
const { feedback } = toRefs(props)

const comment = ref('')
const mentionMenuOpen = ref(false)

const handleInput = () => {
  const words = comment.value.split(' ')
  const lastWord = words.pop()

  if (lastWord.startsWith('@')) {
    debouncedFunction(lastWord.replace('@', ''))
  } else {
    mentionMenuOpen.value = false
  }
}

const insertUser = (user) => {
  let words = comment.value.split(' ')
  words[words.length - 1] = '@' + user
  comment.value = words.join(' ')
  feedbackStore.userslist = ''
  mentionMenuOpen.value = false
}

const debouncedFunction = debounce((mention) => {
  mentionMenuOpen.value = true
  return feedbackStore.getmentionuser(mention)
}, 500)

const Addcomment = async () => {
  if (!comment.value) {
    feedbackStore.errorCommentMessage = 'Comment  Field Is Required'
  }

  if (feedbackStore.errorCommentMessage) {
    return
  }

  feedbackStore.SaveComment({
    comment: comment.value,
    feedback_id: feedback.value.id
  })

  comment.value = ''
}
</script>
