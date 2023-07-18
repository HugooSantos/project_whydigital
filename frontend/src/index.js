import React from 'react'
import ReactDOM from 'react-dom/client'
import './index.css'
import reportWebVitals from './reportWebVitals'
import { ToastContainer } from 'react-toastify'
import 'react-toastify/dist/ReactToastify.css'
import { TaskProvider } from './context/task'
import { AuthProvider } from './context/auth'
import { RouterProvider } from 'react-router-dom'
import { router } from './route'

const root = ReactDOM.createRoot(document.getElementById('root'))
root.render(
  <>
    <AuthProvider>
      <TaskProvider>
        <ToastContainer
          position="top-right"
          autoClose={1000}
          hideProgressBar={false}
          newestOnTop={false}
          closeOnClick
          rtl={false}
          draggable
          theme="dark"
        />
        <RouterProvider router={router} />
      </TaskProvider>
    </AuthProvider>
  </>,
)

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
reportWebVitals()
