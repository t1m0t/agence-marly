import helpers from '../helpers/index'

const legalRoutes = [
  {
    path: '/condition-generales',
    name: 'conditionsGenerales',
    component: helpers.dynImport('legal', 'TermsAndConditionsPage'),
    meta: {
      title: helpers.title('Conditions Générales Utilisateur')
    }
  }
]

export default legalRoutes
