import axios from 'axios'

const instance = axios.create({
  baseURL: 'http://127.0.0.1:8000/api/', // Set your base URL here
  headers: {
    'Content-Type': 'application/json', // Set your default headers here
    Authorization: `Bearer ${localStorage.getItem('TOKEN')}` // Example of authorization header
  }
})

// Interceptor to add token to headers before requests are sent
instance.interceptors.request.use(
  function (config) {
    const updatedToken = localStorage.getItem('TOKEN')
    config.headers.Authorization = `Bearer ${updatedToken}`
    return config
  },
  function (error) {
    return Promise.reject(error)
  }
)

export default instance
