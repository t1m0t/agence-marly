import helpers from '../helpers/index'

const appRoutes = [
  {
    path: '/app/gestion-biens',
    name: 'biens',
    component: helpers.dynImport('app', 'Biens'),
    meta: {
      title: helpers.title('Nos Biens'),
      requiresAuth: true
    }
  },
  {
    path: '/app/gestion-utilisateurs',
    name: 'utlisateurs',
    component: helpers.dynImport('app', 'Utilisateurs'),
    meta: {
      title: helpers.title('Utilisateurs'),
      requiresAuth: true
    }
  }
]

export default appRoutes
