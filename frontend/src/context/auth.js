import React, { createContext, useEffect, useState } from 'react'
import { api } from '../Services/api'
import { toast } from 'react-toastify'

export const AuthContext = createContext()

export const AuthProvider = ({ children }) => {
  const [logged, setLogged] = useState(false)

  useEffect(() => {
    async function initAuth() {
      const token = localStorage.getItem('tasksBearer')
      if (token) {
        api.defaults.headers.Authorization = token
        setLogged(true)
      }
    }
    initAuth()
  }, [])

  async function login(email, password) {
    try {
      const { data } = await api.post('/auth/login', {
        email,
        password,
      })

      const { auth } = data
      localStorage.setItem('tasksBearer', `Bearer ${auth.token}`)
      api.defaults.headers.Authorization = `Bearer ${auth.token}`
      setLogged(true)
    } catch (e) {
      Object.values(e.response.data).map((e) => {
        return toast(JSON.stringify(e).replace('[', '').replace(']', ''))
      })
    }
  }

  async function logout() {
    localStorage.removeItem('tasksBearer')
    api.defaults.headers.Authorization = ``
    setLogged(false)
  }

  return (
    <AuthContext.Provider value={{ logged, login, logout }}>
      {children}
    </AuthContext.Provider>
  )
}
