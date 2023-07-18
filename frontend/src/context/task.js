import React, { createContext, useEffect, useState } from 'react'
import { api } from '../Services/api'
import { toast } from 'react-toastify'

export const TaskContext = createContext()

export const TaskProvider = ({ children }) => {
  const [tasks, setTasks] = useState([])

  async function addTask(description) {
    try {
      const { data } = await api.post(`tasks`, {
        description,
      })

      const newTask = {
        id: data.data.id,
        description: data.data.description,
        complete: 'F',
      }

      setTasks([...tasks, newTask])
    } catch (error) {
      throw new Error(error)
    }
  }

  async function removeTask(id) {
    try {
      await api.delete(`tasks/${id}`)
      setTasks(
        tasks.filter(function (item) {
          return item.id !== id
        }),
      )
    } catch (error) {
      toast(String(error))
    }
  }

  async function updateTask(task) {
    try {
      const { data } = await api.put(`tasks/${task.id}`, {
        description: task.description,
        complete: task.complete === 'F' ? 'T' : 'F',
      })
      setTasks(
        tasks.map(function (item) {
          if (item.id === task.id) {
            return {
              ...item,
              complete: data.data.complete,
            }
          }
          return item
        }),
      )
    } catch (error) {
      toast(String(error))
    }
  }

  async function getTasks() {
    try {
      const { data } = await api.get(`tasks`)
      setTasks(data.data)
    } catch (error) {
      if (error.response.status === 401) {
        throw new Error(error)
      }
    }
  }

  return (
    <TaskContext.Provider
      value={{ tasks, addTask, updateTask, removeTask, getTasks }}
    >
      {children}
    </TaskContext.Provider>
  )
}
