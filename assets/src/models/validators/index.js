import emailValidator from './emailValidator'
import passwordValidator from './passwordValidator'
import textValidator from './textValidator'

const validators = {
  email: emailValidator,
  password: passwordValidator,
  text: textValidator
}

export default validators
