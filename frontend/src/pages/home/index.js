import { useTask } from '../../hooks/useTask'
import { logout, useAuth } from '../../hooks/useAuth'
import Button from '../../components/Tasks/Button'
import { useState } from 'react'
import { toast } from 'react-toastify'
import { useNavigate } from 'react-router-dom'

export function HomePage() {
  const [description, setDescription] = useState('')
  const { tasks, removeTask, addTask } = useTask()
  const notify = (message) => toast(message)

  const add = async (item) => {
    try {
      await addTask(item)
      setDescription('')
      notify('ADD')
    } catch (error) {
      notify('Erro')
    }
  }

  const { logout } = useAuth()
  const navigate = useNavigate()

  const handleLogout = async () => {
    await logout()
    navigate('/login')
  }

  return (
    <div className="flex flex-col justify-center items-center w-full h-screen bg-slate-800">
      <div className="flex relative flex-col justify-center items-center bg-white p-8 rounded-lg gap-4 overflow-y-scroll scrollbar-thick scrollbar-thumb-blue-500 scrollbar-track-blue-100">
        <button
          onClick={() => {
            handleLogout()
          }}
          className="absolute right-2 top-2 w-12 h-8 bg-red-700 rounded-lg text-white"
        >
          Sair
        </button>
        <div>Tarefas</div>
        <div className="flex flex-row w-96 h-8 rounded-full border-2 overflow-hidden border-gray-700">
          <input
            value={description}
            onChange={(e) => setDescription(e.target.value)}
            className="w-3/4 px-2 outline-none"
            maxLength={32}
          ></input>
          <div
            role="button"
            disabled={!description}
            onClick={() => add(description)}
            className={`w-1/4 ${
              !description ? 'bg-green-600 cursor-not-allowed' : 'bg-green-700'
            } font-bold items-center text-white justify-center px-3 cursor-pointer`}
          >
            Adicionar
          </div>
        </div>
        <div className="flex flex-col h-96 w-full overflow-auto gap-2">
          {tasks.map((item, index) => {
            return (
              <div className="w-full" key={index}>
                <div className="gap-2 w-full items-center flex flex-row bg-gray-300 rounded-md">
                  <div className="w-3/4 px-2">{item}</div>
                  <div className="w-1/4 flex justify-end flex-row gap-1">
                    <Button type="reload" />
                    <Button type="delete" onClick={() => removeTask(item)} />
                  </div>
                </div>
              </div>
            )
          })}
        </div>
      </div>
    </div>
  )
}
