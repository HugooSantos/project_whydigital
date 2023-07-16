import { useContext } from 'react'
import { AuthContext } from '../context/auth'

function useAuth() {
  const context = useContext(AuthContext)

  if (!context) {
    throw new Error('')
  }

  return context
}

export { useAuth }
