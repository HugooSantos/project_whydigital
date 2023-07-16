import { getComponentButton } from '../../../utils/buttonComponent'
import { getIconColor } from '../../../utils/iconColor'

function Button({ type, onClick }) {
  const iconColor = getIconColor(type)
  const Component = getComponentButton(type)

  return (
    <div
      onClick={() => onClick()}
      role="button"
      className={`flex w-8 h-8 rounded-md items-center justify-center ${iconColor}`}
    >
      <Component className={`text-white ${iconColor}`} />
    </div>
  )
}

export default Button
