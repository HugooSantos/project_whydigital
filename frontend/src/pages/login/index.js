import { useState } from 'react'
import { AiOutlineMail } from 'react-icons/ai'
import { BsFillKeyFill } from 'react-icons/bs'
import { useAuth } from '../../hooks/useAuth'
import { useNavigate } from 'react-router-dom'

export function LoginPage() {
  const [email, setEmail] = useState('')
  const [password, setPassword] = useState('')

  const { login } = useAuth()
  const navigate = useNavigate()

  const handleLogin = async (email, password) => {
    await login(email, password)
    navigate('/')
  }

  return (
    <div className="flex justify-center items-center w-full h-screen bg-sky-900">
      <div className="flex flex-col justify-center items-center bg-white p-8 rounded-lg gap-4">
        <h1>LOGIN</h1>
        <div className="flex justify-center px-2 items-center flex-row w-72 h-8 rounded-full border-2 overflow-hidden border-gray-700">
          <AiOutlineMail />
          <input
            placeholder={'email'}
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            className="w-full px-2 outline-none "
            maxLength={32}
          ></input>
        </div>
        <div className="flex justify-center items-center px-2 flex-row w-72 h-8 rounded-full border-2 overflow-hidden border-gray-700">
          <BsFillKeyFill />
          <input
            placeholder={'password'}
            value={password}
            onChange={(e) => setPassword(e.target.value)}
            className="w-full px-2 outline-none"
            maxLength={32}
          ></input>
        </div>
        <button
          onClick={() => handleLogin(email, password)}
          className="bg-sky-900 w-72 text-white flex flex-row items-center justify-center h-8 rounded-full"
        >
          Entrar
        </button>
      </div>
    </div>
  )
}
