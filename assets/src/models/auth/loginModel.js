import { reactive, ref } from 'vue'
import validator from '../validators/index'

const loginModel = reactive({
  email: reactive({
    placeholder: ref('Votre email'),
    className: ref('input is-large'),
    val: ref(''),
    inputType: 'text',
    error: reactive({
      is: ref(false),
      message: 'Email incorrecte.'
    }),
    isValid: function () {
      return validator.email(this.val)
    }
  }),
  password: reactive({
    placeholder: ref('Votre mot de passe'),
    className: ref('input is-large'),
    val: ref(''),
    inputType: 'password',
    error: reactive({
      is: ref(false),
      message: ref(
        'Mot de passe incorrecte. Doit contenir au moins 10 caractères dont un caractère spécial [!@#$%^&*]'
      )
    }),
    isValid: function () {
      return validator.password(this.val)
    }
  }),
  passwordRepeat: reactive({
    placeholder: ref('Répeter le mot de passe'),
    className: ref('input is-large'),
    val: ref(''),
    inputType: 'password',
    error: reactive({
      is: ref(false),
      message: ref("Les mots de passe ne correspondent pas.")
    }),
    isValid: function () {
      return validator.password(this.val)
    }
  }),
  rememberMe: reactive({
    val: ref(false),
    toggle: function () {
      this.val = !this.val
    },
    error: reactive({
      is: ref(false),
      message: ''
    })
  }),
  state: reactive({
    error: reactive({
      is: ref(false),
      message: 'Impossible de se connecter, merci de réessayer.'
    })
  })
})

export default loginModel
