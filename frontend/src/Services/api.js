import axios from 'axios'

export const api = axios.create({
  baseURL: 'http://localhost:8029/api',
})

api.interceptors.response.use(
  function (response) {
    return response
  },
  function (error) {
    return Promise.reject(error)
  },
)
