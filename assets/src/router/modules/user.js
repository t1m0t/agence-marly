import helpers from '../helpers/index'

const userRoutes = [
  {
    path: '/app/profile',
    name: 'profile',
    component: helpers.dynImport('user', 'ProfilePage'),
    meta: {
      title: helpers.title('Profile'),
      requiresAuth: true
    }
  }
]

export default userRoutes
