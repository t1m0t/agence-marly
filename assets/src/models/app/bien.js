import { reactive } from 'vue'
import validator from '../validators/index'

const bienModel = reactive({
    fields: {
        adresse: {
            label: 'Adresse du bien',
            placeholder: 'Adresse',
            className: 'input',
            val: null,
            inputType: 'text',
            error: {
                is: false,
                message: 'Adresse incorrecte.'
            },
            isValid: function () {
                return validator.text(this.val)
            }
        },
        type: {
            label: "Type d'offre",
            className: "select",
            val: null,
            inputType: 'select',
            items: ['vente', 'location'],
        },
        prix: {
            label: "Prix",
            placeholder: "Prix",
            className: "input",
            val: null,
            inputType: 'number',
            error: {
                is: false,
                message: 'Prix incorrect.'
            },
            isValid: function () {
                return validator.prix(this.val)
            }
        },
        surface: {
            label: "Surface",
            placeholder: "Surface",
            className: "input",
            val: null,
            inputType: 'number',
            error: {
                is: false,
                message: 'Surface incorrecte.'
            },
            isValid: function () {
                return validator.surface(this.val)
            }
        },
        carrez: {
            label: "Carrez",
            placeholder: "Carrez",
            className: "input",
            val: null,
            inputType: 'number',
            error: {
                is: false,
                message: 'Carrez incorrect.'
            },
            isValid: function () {
                return validator.carrez(this.val)
            }
        },
        est_vendu: {
            label: "Le bien est-il vendu ?",
            className: "input",
            val: null,
            inputType: 'radio',
            items: ['Oui', 'Non'],
        },
        titre: {
            label: 'Titre de l\'annonce',
            placeholder: 'Titre',
            className: 'input',
            val: null,
            inputType: 'text',
            error: {
                is: false,
                message: 'Titre incorrect.'
            },
            isValid: function () {
                return validator.text(this.val)
            }
        },
        description: {
            label: 'Description du bien',
            placeholder: 'Description',
            className: 'textarea',
            val: null,
            inputType: 'textarea',
            error: {
                is: false,
                message: 'Description incorrecte.'
            },
            isValid: function () {
                return validator.text(this.val)
            }
        },
        type_bien: {
            label: "Type de bien",
            className: "select",
            val: null,
            inputType: 'select',
            items: ['maison', 'appartement'],
        },
        photos_bien: {
            label: "Photos du bien",
            className: "image",
            val: [],
            inputType: 'image',
        },
    },
    state: {
        error: {
            is: false,
            message: 'Echec de l\'enregistrement du bien.'
        }
    },
    photo: {
        est_principale: false,
        file: null,
        error: {
            is: false,
            message: 'Image incorrecte.'
        }
    }
})

export default bienModel
