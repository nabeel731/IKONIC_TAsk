import { defineStore } from 'pinia'
import instance from '@/services/Api.js'
import { useToast } from 'vue-toastification'
import router from '@/router/index.js'

const toast = useToast()

export const useFeedBackStore = defineStore('feedback', {
  state: () => ({
    categories: null,
    feedbacks: [],
    formLoading: false,
    page: 1,
    search: null,
    mention: false,
    userslist: [],
    totalPages: 1,
    errorMessage: null,
    errorCommentMessage: null,
    loadingnextPage: false
  }),

  actions: {
    async getCategories() {
      let result = await instance.get('/categories')
      if (result.status == 200) {
        this.categories = result.data.data
      }
    },

    async getfeedback() {
      let result = await instance.get('/feedback?page=' + this.page)
      this.loadingnextPage = false

      if (result.status == 200) {
        this.feedbacks = [...this.feedbacks, ...result.data.data]
        this.totalPages = result.data.meta.last_page
      }
    },

    async getmentionuser(comment) {
      let result = await instance.get('/getmentionuser?search=' + comment)

      if (result.status == 200) {
        this.userslist = result.data.data
      }
    },

    AddFeedback(payload) {
      this.formLoading = true
      instance
        .post('/feedback', payload)
        .then((response) => {
          this.formLoading = false
          console.log(response)
          if (response.status == 200) {
            toast.success('FeedBack Added Sucessfuly', {
              position: 'top-right', // Example position
              timeout: 3000 // Example timeout
            })
            this.feedbacks.unshift(response.data.data)
          }
        })
        .catch((error) => {
          // Handle error
          this.errorMessage = error.response.data.message
          this.formLoading = false
        })
    },

    getSegments(text) {
      const pattern = /@(\w+)/g
      const segments = []
      let lastIndex = 0
      let match

      while ((match = pattern.exec(text)) !== null) {
        const index = match.index
        const username = match[1]

        segments.push({ type: 'text', value: text.slice(lastIndex, index) })
        segments.push({ type: 'user', value: username, display: `@${username}` })
        lastIndex = index + username.length + 1
      }

      if (lastIndex < text.length) {
        segments.push({ type: 'text', value: text.slice(lastIndex) })
      }

      return segments
    },

    SaveComment(payload) {
      this.formLoading = true
      instance
        .post('/AddComment', payload)
        .then((response) => {
          this.formLoading = false
          console.log(response)
          if (response.status == 200) {
            toast.success('Comment Added Sucessfuly', {
              position: 'top-right', // Example position
              timeout: 3000 // Example timeout
            })

            const index = this.feedbacks.findIndex((f) => f.id == payload.feedback_id)
            if (index > -1) {
              this.feedbacks[index].comments.unshift(response.data.data)
            }
          }
        })
        .catch((error) => {
          // Handle error
          this.errorMessage = error.response.data.message
          this.formLoading = false
        })
    },

    loadNextPage() {
      if (this.page < this.totalPages) {
        this.page++
        this.loadingnextPage = true
        this.getfeedback()
      }
    }
  }
})
