import { Navigate, createBrowserRouter } from 'react-router-dom'
import { LoginPage } from '../pages/login'
import { HomePage } from '../pages/home'

function Protected({ isSignedIn, children }) {
  if (!isSignedIn) {
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
