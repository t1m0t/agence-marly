import helpers from '../helpers/index'

const appRoutes = [
  {
    path: '/app/gestion-biens',
    name: 'biens',
    component: helpers.dynImport('app', 'GestionBiens'),
    meta: {
      title: helpers.title('Nos Biens'),
      requiresAuth: true
    }
  },
  {
    path: '/app/gestion-utilisateurs',
    name: 'utlisateurs',
    component: helpers.dynImport('app', 'GestionUtilisateurs'),
    meta: {
      title: helpers.title('Utilisateurs'),
      requiresAuth: true
    }
  },
  {
    path: '/app/prendre-rendez-vous',
    name: 'prendre-rendez-vous',
    component: helpers.dynImport('app', 'PrendreRendezVous'),
    meta: {
      title: helpers.title('Prendre un rendez-vous'),
      requiresAuth: true
    }
  },
  {
    path: '/app/mes-rendez-vous',
    name: 'mes-rendez-vous',
    component: helpers.dynImport('app', 'MesRendezVous'),
    meta: {
      title: helpers.title('Mes Rendez-Vous'),
      requiresAuth: true
    }
  },
  {
    path: '/app/edit-bien/:id',
    name: 'edit-bien',
    component: helpers.dynImport('app', 'EditionBien'),
    meta: {
      title: helpers.title('Edition d\'un bien'),
      requiresAuth: true
    }
  }
]

export default appRoutes
