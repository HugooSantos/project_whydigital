import React, { createContext, useState } from 'react'
import { api } from '../Services/api'

export const TaskContext = createContext()

export const TaskProvider = ({ children }) => {
  const [tasks, setTasks] = useState([])

  async function addTask(description) {
    try {
      // const { data } = await api.post(`tasks`, {
      //   data: {
      //     description: description,
      //   },
      // })
      // const newTask = {
      //   id: data.data.id,
      //   description: data.data.description,
      //   completed: false,
      // }
      setTasks([...tasks, description])
    } catch (error) {
      console.log(String(error))
    }
  }

  async function removeTask(item) {
    try {
      //   await api.delete(`tasks/${id}`)
      setTasks(
        tasks.filter(function (i) {
          return item !== i
        }),
      )
    } catch (error) {
      throw new Error('ERROR')
    }
  }

  return (
    <TaskContext.Provider value={{ tasks, addTask, removeTask }}>
      {children}
    </TaskContext.Provider>
  )
}
