export function getIconColor(type) {
  let iconColor
  switch (type) {
    case 'delete':
      iconColor = 'bg-red-600'
      break
    case 'reload':
      iconColor = 'bg-green-600'
      break
    default:
      iconColor = 'bg-blue-600'
  }
  return iconColor
}
