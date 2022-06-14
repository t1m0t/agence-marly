import { reactive, ref } from 'vue'
import loginModel from './loginModel'

const registerModel = reactive({
  email: loginModel.email,
  password: loginModel.password,
  passwordRepeat: loginModel.passwordRepeat,
  acceptTerms: loginModel.rememberMe,
  state: loginModel.state,
  failed: {
    is: false,
    message: 'Echec de la création de l\'utilisateur'
  }
})

// customization
registerModel.state.error.message = 'Failed to register.'
registerModel.passwordRepeat.placeholder = ref('Enter your password again')
registerModel.acceptTerms.error.message =
  'Please accept Terms and Conditions to register.'

export default registerModel
