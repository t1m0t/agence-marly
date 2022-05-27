import helpers from '../helpers/index'

const baseRoutes = [
  {
    path: '/',
    name: 'bienvenue',
    component: helpers.dynImport('base', 'IndexPage'),
    meta: {
      title: helpers.title('Bienvenue')
    }
  },
  {
    path: '/a-propos',
    name: 'aPropos',
    component: helpers.dynImport('base', 'AboutPage'),
    meta: {
      title: helpers.title('A Propos')
    }
  },
  {
    path: '/qui-sommes-nous',
    name: 'quiSommesNous',
    component: helpers.dynImport('base', 'QuiSommesNous'),
    meta: {
      title: helpers.title('Qui sommes-nous ?')
    }
  },
  {
    path: '/nous-contacter',
    name: 'nousContacter',
    component: helpers.dynImport('base', 'ContactPage'),
    meta: {
      title: helpers.title('Nous Contacter')
    }
  },
  {
    path: '/rapporter-erreur',
    name: 'rapporterErreur',
    component: helpers.dynImport('base', 'ReportIssuePage'),
    meta: {
      title: helpers.title('Rapporter Une Erreur')
    }
  },
  {
    path: '/nos-biens',
    name: 'nosBiens',
    component: helpers.dynImport('base', 'NosBiens'),
    meta: {
      title: helpers.title('Nos Biens')
    }
  },
  {
    path: '/:NotFoundPage(.*)',
    component: helpers.dynImport('base', 'NotFoundPage'),
    meta: {
      title: helpers.title('Page Non Trouvée')
    }
  }
]

export default baseRoutes
