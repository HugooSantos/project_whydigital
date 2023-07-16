import { AiFillDelete, AiOutlineCheck, AiOutlineReload } from 'react-icons/ai'

export function getComponentButton(type) {
  let comp
  switch (type) {
    case 'delete':
      comp = AiFillDelete
      break
    case 'reload':
      comp = AiOutlineReload
      break
    default:
      comp = AiOutlineCheck
  }
  return comp
}
