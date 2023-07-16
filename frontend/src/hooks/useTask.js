import { useContext } from 'react'
import { TaskContext } from '../context/task'

function useTask() {
  const context = useContext(TaskContext)

  if (!context) {
    throw new Error('')
  }

  return context
}

export { useTask }
