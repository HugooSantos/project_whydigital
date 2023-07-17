import { Navigate, createBrowserRouter } from 'react-router-dom'
import { LoginPage } from '../pages/login'
import { HomePage } from '../pages/home'
import { useAuth } from '../hooks/useAuth'

function Protected({ children }) {
  const { logged } = useAuth()

  if (!logged) {
    return <Navigate to="/login" replace />
  }

  return children
}

function Sign({ children }) {
  const { logged } = useAuth()

  if (logged) {
    return <Navigate to="/" replace />
  }

  return children
}

export const router = createBrowserRouter([
  {
    path: '/login',
    element: (
      <Sign>
        <LoginPage />
      </Sign>
    ),
  },
  {
    path: '/',
    element: (
      <Protected isSignedIn={false}>
        <HomePage />
      </Protected>
    ),
  },
])
