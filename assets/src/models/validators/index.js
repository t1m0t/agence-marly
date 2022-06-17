import emailValidator from './emailValidator'
import passwordValidator from './passwordValidator'
import textValidator from './textValidator'

const validators = {
  email: emailValidator,
  password: passwordValidator,
  text: textValidator,
  annee: (val) => {
    const item = parseInt(val)
    const date = new Date()
    return item >= date.getFullYear() && item < date.getFullYear() + parseInt(1)
  },
  jour: (val) => {
    const item = parseInt(val)
    return item > 0 && item < 31
  },
  mois: (val) => {
    const item = parseInt(val)
    return item > 0 && item <= 12
  },
  heure: (val) => {
    const item = parseInt(val)
    return item >= 0 && item <= 24
  },
  minute: (val) => {
    const item = parseInt(val)
    return item >= 0 && item <= 60
  },
  prix: (val) => {
    const item = parseInt(val)
    return item >= 0 && item <= 99999999
  },
  surface: (val) => {
    const item = parseInt(val)
    return item >= 0 && item <= 99999999
  },
  carrez: (val) => {
    const item = parseInt(val)
    return item >= 0 && item <= 12
  }
}

export default validators
