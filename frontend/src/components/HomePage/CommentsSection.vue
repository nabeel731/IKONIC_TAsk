<template>
  <div
    class="p-3 mx-3 shadow-lg border-solid border-2 rounded-lg border-gray-100 my-3"
    v-for="(comment, index) in feedback.comments"
    :key="index"
  >
    <div class="flex items-center">
      <div>
        <img
          class="rounded-full shadow-md mr-3"
          src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp"
          alt="avatar"
          width="40"
          height="40"
        />
      </div>
      <div>
        <h5 class="text-primary mb-1 font-bold">{{ comment.user.name }}</h5>
      </div>
    </div>

    <div class="text-sm bg-gray-100 mt-1 ms-11 p-3 rounded-lg">
      <span v-if="!comment.comments.includes('@')">{{ comment.comments }}</span>
      <div v-else>
        <template v-for="(word, index) in comment.comments.split(' ')" :key="index">
          <a
            @click="alertMentionenName(word)"
            class="cursor-pointer text-blue-500"
            v-if="word.startsWith('@')"
            >{{ word + ' ' }}</a
          >
          <span v-else>{{ word + ' ' }}</span>
        </template>
      </div>
    </div>
  </div>
</template>

<script setup>
import { toRefs } from 'vue'

const props = defineProps({
  feedback: Object
})

const { feedback } = toRefs(props)

const alertMentionenName = (name) => {
  alert(`You clicked on "${name.replace('@', '')}"`)
}
</script>
