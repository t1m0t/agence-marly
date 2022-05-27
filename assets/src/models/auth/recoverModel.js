import loginModel from './loginModel'
import { ref, reactive } from 'vue'

const recoverModel = {
  email: loginModel.email,
  state: reactive({
    performed: reactive({
      is: ref(false),
      message:
        'An email has been sent to the email address including instructions to recover your password.'
    })
  })
}

export default recoverModel
