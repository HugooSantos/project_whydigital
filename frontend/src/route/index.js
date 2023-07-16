import { Navigate, createBrowserRouter } from 'react-router-dom'
import { LoginPage } from '../pages/login'
import { HomePage } from '../pages/home'
import { useAuth } from '../hooks/useAuth'

function Protected({ children }) {
  const { isLogged } = useAuth()

  if (!isLogged) {
    return <Navigate to="/" replace />
  }

  return children
}

export const router = createBrowserRouter([
  {
    path: '/',
    element: <LoginPage />,
  },
  {
    path: '/home',
    element: (
      <Protected isSignedIn={false}>
        <HomePage />
      </Protected>
    ),
  },
])
