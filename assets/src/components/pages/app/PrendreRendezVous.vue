<template>
  <div class="container has-text-centered" id="login">
    <div class="column is-6 is-offset-3">
      <h3 class="title has-text-black">Prendre un rendez-vous</h3>
      <routerLink to="/">Revenir à la Page d'Accueil</routerLink>
      <hr class="login-hr" />
      <div class="box">
        <errPopup v-show="error.is" :message="error.message" v-model="error.is" />
        <form>
          <div class="field">
            <label class="label">{{ fields.message.placeholder }}</label>
            <div class="control">
              <textarea class="input" :placeholder="fields.message.placeholder" :class="fields.message.className"
                v-model="fields.message.val" cols="10" lines="20" />
            </div>
          </div>
          <label class="label">Date du rendez-vous désiré</label>
          <div class="field has-addons">

            <div class="control">
              <inputTextField :placeholder="fields.annee.placeholder" :type="fields.annee.inputType"
                :className="fields.annee.className" v-model="fields.annee.val" />
            </div>
            <div class="control">
              <inputTextField :placeholder="fields.mois.placeholder" :type="fields.mois.inputType"
                :className="fields.mois.className" v-model="fields.mois.val" />
            </div>
            <div class="control">
              <inputTextField :placeholder="fields.jour.placeholder" :type="fields.jour.inputType"
                :className="fields.jour.className" v-model="fields.jour.val" />
            </div>
            <div class="control">
              <inputTextField :placeholder="fields.heure.placeholder" :type="fields.heure.inputType"
                :className="fields.heure.className" v-model="fields.heure.val" />
            </div>
            <div class="control">
              <inputTextField :placeholder="fields.minute.placeholder" :type="fields.minute.inputType"
                :className="fields.minute.className" v-model="fields.minute.val" />
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
import rendezVousModel from './../../../models/app/rendezVous'
import ui from "../../ui/index"
import { reactive } from "vue"
import { useRouter } from "vue-router"

const router = useRouter()
const inputTextField = ui.inputTextField
const errPopup = ui.errPopup
const fields = rendezVousModel.fields
const error = reactive({
  is: false,
  message: null
})

async function submit() {
  checkFieldsValid()
  const payload = {
    annee: Number(fields.annee.val),
    jour: Number(fields.jour.val),
    mois: Number(fields.mois.val),
    heure: Number(fields.heure.val),
    minute: Number(fields.minute.val),
    message: fields.message.val,
  };
  if (error.is === false) {
    const res = await axios.post('/app/prendre-rendez-vous', payload, {
      headers: {
        'content-type': 'application/json'
      }
    })
    if (res.status === 503) {
      error.is = true
      error.message = "Echec de traitement de la requete."
    } else if (res.status === 201) {
      router.push("/app/mes-rendez-vous")
    }
  }
}

function checkFieldsValid() {
  const list = Object.keys(fields)
  list.forEach(field => {
    const res = fields[field].isValid()
    if (res === false) {
      error.is = true
      error.message = fields[field].error.message
    }
  })
}
</script>