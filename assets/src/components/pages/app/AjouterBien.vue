<template>
    <div class="container " id="login">
        <div class="column is-8 is-offset-2">
            <h3 class="title has-text-black">Ajouter un bien</h3>
            <routerLink to="/app/gestion-biens">Revenir à la gestion des biens</routerLink>
            <hr class="login-hr" />
            <div class="box">
                <errPopup v-show="error.is" :message="error.message" v-model="error.is" />
                <form>
                    <div class="field is-grouped is-grouped-multiline">
                        <div class="control">
                            <label class="label">{{ fields.type.label }}</label>
                            <dropdownSelect :items="fields.type.items" v-model="fields.type.val"
                                :startValue="fields.type.val" class="select" />
                        </div>
                        <div class="control">
                            <label class="label">{{ fields.type_bien.label }}</label>
                            <dropdownSelect :items="fields.type_bien.items" v-model="fields.type_bien.val"
                                :startValue="fields.type_bien.val" class="select" />
                        </div>
                        <div class="control">
                            <label class="label">{{ fields.prix.label }}</label>
                            <inputTextField :placeholder="fields.prix.placeholder" :type="fields.prix.inputType"
                                :className="fields.prix.className" v-model="fields.prix.val" />
                        </div>
                        <div class="control">
                            <label class="label">{{ fields.surface.label }}</label>
                            <inputTextField :placeholder="fields.surface.placeholder" :type="fields.surface.inputType"
                                :className="fields.surface.className" v-model="fields.surface.val" />
                        </div>
                        <div class="control">
                            <label class="label">{{ fields.carrez.label }}</label>
                            <inputTextField :placeholder="fields.carrez.placeholder" :type="fields.carrez.inputType"
                                :className="fields.carrez.className" v-model="fields.carrez.val" />
                        </div>
                        <div class="control">
                            <label class="label">{{ fields.est_vendu.label }}</label>
                            <dropdownSelect :items="fields.est_vendu.items" v-model="fields.est_vendu.val"
                                :startValue="fields.est_vendu.val === true ? 'Oui' : 'Non'" class="select" />
                        </div>
                    </div>

                    <div class="field">
                        <div class="control">
                            <label class="label">{{ fields.adresse.label }}</label>
                            <inputTextField :placeholder="fields.adresse.placeholder" :type="fields.adresse.inputType"
                                :className="fields.adresse.className" v-model="fields.adresse.val" />
                        </div>
                        <div class="control">
                            <label class="label">{{ fields.titre.label }}</label>
                            <inputTextField :placeholder="fields.titre.placeholder" :type="fields.titre.inputType"
                                :className="fields.titre.className" v-model="fields.titre.val" />
                        </div>
                        <div class="field">
                            <div class="control">
                                <label class="label">{{ fields.description.placeholder }}</label>
                                <textarea class="input" :placeholder="fields.description.placeholder"
                                    :class="fields.description.className" v-model="fields.description.val" cols="10"
                                    lines="20" />
                            </div>
                        </div>
                    </div>

                    <button class="button is-block is-info is-large is-fullwidth" @click.prevent="submit">
                        Envoyer <i class="fa fa-sign-in" aria-hidden="true"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from "axios"
import bienModel from './../../../models/app/bien'
import dropdownSelect from '../../ui/dropdownSelect.vue'
import ui from "../../ui/index"
import { onBeforeMount, onUpdated, reactive, ref } from "vue"
import { useRoute, useRouter } from 'vue-router'

const route = useRoute()
const inputTextField = ui.inputTextField
const errPopup = ui.errPopup
const fields = bienModel.fields
const error = reactive({
    is: false,
    message: null
})

async function submit() {
    checkFieldsValid()
    const payload = {
        adresse: fields.adresse.val,
        carrez: 'T' + fields.carrez.val,
        description: fields.description.val,
        estVendu: fields.est_vendu.val,
        prix: Number(fields.prix.val),
        surface: Number(fields.surface.val),
        titre: fields.titre.val,
        type: fields.type.val,
        typeBien: fields.type_bien.val,
    };

    if (error.is === false) {
        const res = await axios.post('/app/ajout-bien', payload, {
            headers: {
                'content-type': 'application/json'
            }
        })
        if (res.status === 503 || res.status === 422) {
            error.is = true
            error.message = "Echec de traitement de la requete."
        }
    }
}

function checkFieldsValid() {
    const list = Object.keys(fields)
    list.forEach(field => {
        if (fields[field].isValid !== undefined && typeof fields[field].isValid === 'function') {
            const res = fields[field].isValid()
            if (res === false) {
                error.is = true
                error.message = fields[field].error.message
            }
        }
    })
    if (fields.photos_bien.val.length > 0) fields.photos_bien.val.pop()
}

</script>
