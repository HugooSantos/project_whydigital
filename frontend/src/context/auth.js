import React, { createContext, useState } from 'react'

export const AuthContext = createContext()

export const AuthProvider = ({ children }) => {
  const [user, setUser] = useState(false)

  async function login(email, password) {
    setUser(true)
  }

  async function logout() {
    setUser(false)
  }

  return (
    <AuthContext.Provider value={{ user, isLogged: !!user, login, logout }}>
      {children}
    </AuthContext.Provider>
  )
}
