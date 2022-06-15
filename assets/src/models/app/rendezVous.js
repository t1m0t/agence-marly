import { reactive } from 'vue'
import validator from '../validators/index'

const rendezVousModel = reactive({
    fields: {
        message: {
            placeholder: 'Votre message',
            className: 'textarea',
            val: null,
            inputType: 'textarea',
            error: {
                is: false,
                message: 'Message incorrecte.'
            },
            isValid: function () {
                return validator.text(this.val)
            }
        },
        annee: {
            placeholder: "Année",
            className: "input",
            val: null,
            inputType: 'number',
            error: {
                is: false,
                message: 'Année incorrecte.'
            },
            isValid: function () {
                return validator.annee(this.val)
            }
        },
        mois: {
            placeholder: "Mois",
            className: "input",
            val: null,
            inputType: 'number',
            error: {
                is: false,
                message: 'Mois incorrect.'
            },
            isValid: function () {
                return validator.mois(this.val)
            }
        },
        jour: {
            placeholder: "Jour",
            className: "input",
            val: null,
            inputType: 'number',
            error: {
                is: false,
                message: 'Jour incorrecte.'
            },
            isValid: function () {
                return validator.jour(this.val)
            }
        },
        heure: {
            placeholder: "Heure",
            className: "input",
            val: null,
            inputType: 'number',
            error: {
                is: false,
                message: 'Heure incorrecte.'
            },
            isValid: function () {
                return validator.heure(this.val)
            }
        },
        minute: {
            placeholder: "Minute",
            className: "input",
            val: null,
            inputType: 'number',
            error: {
                is: false,
                message: 'Minute incorrecte.'
            },
            isValid: function () {
                return validator.minute(this.val)
            }
        },
    },
    state: {
        error: {
            is: false,
            message: 'Impossible de se connecter, merci de réessayer.'
        }
    }
})

export default rendezVousModel
