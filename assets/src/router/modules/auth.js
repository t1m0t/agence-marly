import helpers from '../helpers/index'

const authRoutes = [
  {
    path: '/senregistrer',
    name: 'senregistrer',
    component: helpers.dynImport('auth', 'RegisterPage'),
    meta: {
      title: helpers.title('S\'enregistrer'),
      displayMainNav: false
    }
  },
  {
    path: '/connexion',
    name: 'connexion',
    component: helpers.dynImport('auth', 'LoginPage'),
    meta: {
      title: helpers.title('Connexion'),
      displayMainNav: false
    }
  },
  {
    path: '/mot-de-passe-oublie',
    name: 'motDePasseOublie',
    component: helpers.dynImport('auth', 'ForgotPasswordPage'),
    meta: {
      title: helpers.title('Mot de Passe Oublié'),
      displayMainNav: false
    }
  }
]

export default authRoutes
