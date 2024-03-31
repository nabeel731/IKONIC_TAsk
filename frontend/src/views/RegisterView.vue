<template>
  <section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <a
        href="#"
        class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white"
      >
        <img
          class="w-8 h-8 mr-2"
          src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg"
          alt="logo"
        />
        Flowbite
      </a>
      <div
        class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700"
      >
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
          <h1
            class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white"
          >
            Sign Up to your account
          </h1>
          <form class="space-y-4 md:space-y-6" method="post" @submit.prevent="formSubmit">
            <p
              class="text-red-700 px-4 py-3 rounded relative mb-2 mt-2"
              role="alert"
              v-if="authStore.errorMessage"
            >
              {{ authStore.errorMessage }}
            </p>

            <div>
              <label
                for="email"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Your Name</label
              >

              <input
                type="text"
                name="name"
                v-model="payload.name"
                id="name"
                :class="{
                  'bg-red-50 border border-red-500 text-red-900 ':
                    authStore.errorMessage && authStore.errorMessage.toLowerCase().includes('name')
                }"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="name"
              />
            </div>

            <div>
              <label
                for="email"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Your email</label
              >
              <input
                type="email"
                name="email"
                :class="{
                  'bg-red-50 border border-red-500 text-red-900 ':
                    authStore.errorMessage && authStore.errorMessage.toLowerCase().includes('email')
                }"
                v-model="payload.email"
                id="email"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="name@company.com"
              />
            </div>

            <div>
              <label
                for="password"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Password</label
              >
              <input
                type="password"
                name="password"
                v-model="payload.password"
                id="password"
                :class="{
                  'bg-red-50 border border-red-500 text-red-900 ':
                    authStore.errorMessage &&
                    authStore.errorMessage.toLowerCase().includes('password')
                }"
                placeholder="••••••••"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              />
            </div>

            <div>
              <label
                for="password"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >Confirm Password</label
              >
              <input
                type="password"
                name="password"
                :class="{
                  'bg-red-50 border border-red-500 text-red-900 ':
                    authStore.errorMessage &&
                    authStore.errorMessage.toLowerCase().includes('Confirm Password')
                }"
                v-model="payload.password_confirmation"
                id="password1"
                placeholder="••••••••"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              />
            </div>
            <button
              type="submit"
              :disabled="authStore.formLoading"
              class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
            >
              {{ authStore.formLoading ? 'Submitting...' : 'Register' }}
            </button>
            <p class="text-sm font-light text-gray-500 dark:text-gray-400">
              If You have an account?
              <router-link
                to="/"
                class="font-medium text-primary-600 hover:underline dark:text-primary-500"
                >Login</router-link
              >
            </p>
          </form>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { reactive } from 'vue'
import { useUserStore } from '@/stores/auth.js'

const authStore = useUserStore()

const payload = reactive({
  name: '',
  email: '',
  password: '',
  password_confirmation: ''
})

const formSubmit = async () => {
  if (!payload.name) {
    authStore.errorMessage = 'Name  Field Is Required'
  } else if (!payload.email) {
    authStore.errorMessage = 'Email Field Is Required'
  } else if (!payload.password) {
    authStore.errorMessage = 'Password Field Is Required'
  } else if (!payload.password_confirmation) {
    authStore.errorMessage = 'Password Confirmation Is Required'
  } else if (payload.password != payload.password_confirmation) {
    authStore.errorMessage = 'Password And Confirm Password Do Not Match'
  }

  if (authStore.errorMessage) {
    return
  }

  authStore.register(payload)
}
authStore.errorMessage = ''
</script>
