import config from '../config'

const helpers = {
  title: function (subTitle) {
    if (subTitle) {
      return subTitle + ' - ' + config.baseTitle
    } else {
      return config.baseTitle
    }
  },
  dynImport: function dynImport(scope, view) {
    return () => import(`@/pages/${scope}/${view}.vue`)
  }
}

export default helpers
