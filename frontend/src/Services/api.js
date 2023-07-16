import axios from 'axios'

export const api = axios.create({
  baseURL: 'http://localhost:8029/api',
})
