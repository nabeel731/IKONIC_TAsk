import { defineStore } from 'pinia'
import instance from '@/services/Api.js'
import router from '@/router/index.js'
export const useUserStore = defineStore('user', {
  state: () => ({
    authUser: null,
    IsLogin: false,
    authToken: null,
    formLoading: false,
    errorMessage: null
  }),

  actions: {
    register(payload) {
      this.formLoading = true
      instance
        .post('/register', payload)
        .then((response) => {
          this.formLoading = false
          if (response.status == 201) {
            this.saveAuthInfoAndRedirect(response)
          }
        })
        .catch((error) => {
          // Handle error
          console.log(error.response.data.message)
          this.errorMessage = error.response.data.message
          this.formLoading = false
        })
    },
    saveAuthInfoAndRedirect(response) {
      this.authUser = response.data
      this.IsLogin = true
      localStorage.setItem('TOKEN', response.data.token)
      localStorage.setItem('AUTH_USER', JSON.stringify(response.data))

      router.push('/')
    },

    login(creds) {
      this.formLoading = true
      instance
        .post('/login', creds)
        .then((response) => {
          this.formLoading = false
          if (response.status == 200) {
            this.saveAuthInfoAndRedirect(response)
          }
        })
        .catch((error) => {
          this.errorMessage = error.response.data.message
          this.formLoading = false
        })
    }
  }
})
