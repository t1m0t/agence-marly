<template>
    <div class="container " id="login">
        <div class="column is-8 is-offset-2">
            <h3 class="title has-text-black">Edition d'un bien</h3>
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
                                :startValue="fields.est_vendu.val" class="select" />
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
                    <div class="field">
                        <label class="label">{{ fields.photos_bien.label }}</label>
                        <div v-if="fields.photos_bien.val.length > 0">
                            <div class="liste-photo" v-for="(photo, index) in fields.photos_bien.val">
                                <img :src="'/images/' + photo.fileName" alt="" ref="photosRefs">
                                <button @click.prevent="supprimerPhoto(index)" v-if="photo.url !== null"
                                    class="button is-danger">Supprimer</button>
                            </div>
                        </div>

                        <div class="control inline-flex">
                            <img ref="photoAajouter">
                            <div class="file is-primary">
                                <label class="file-label">
                                    <input class="file-input" type="file" name="photo" @input="setPhoto($event)">
                                    <button v-if="photo.file !== null" class="button is-primary"
                                        @click.prevent="envoyerImage()">Envoyer</button>
                                    <button v-if="photo.file !== null" class="button is-danger"
                                        @click.prevent="deleteImage()">Supprimer</button>
                                    <span v-else class="file-cta">
                                        <span class="file-label is-info">
                                            Ajouter
                                        </span>
                                    </span>
                                </label>
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
const router = useRouter()
const inputTextField = ui.inputTextField
const errPopup = ui.errPopup
const fields = bienModel.fields
const photoModel = bienModel.photo
let photo = bienModel.photo
const error = reactive({
    is: false,
    message: null
})
const feed = ref(null)
const photosRefs = ref([])
const photoAajouter = ref(null)

onBeforeMount(async () => {
    await setFeedData()
    console.log(feed.value)
    fields.photos_bien.val = feed.value.photos
    fields.adresse.val = feed.value.data.adresse
    fields.carrez.val = getCarrez(feed.value.data.carrez)
    fields.description.val = feed.value.data.description
    fields.est_vendu.val = feed.value.data.estVendu
    fields.prix.val = feed.value.data.prix
    fields.surface.val = feed.value.data.surface
    fields.titre.val = feed.value.data.titre
    fields.type.val = feed.value.data.type
    fields.type_bien.val = feed.value.data.typeBien
})

function getCarrez(carrez) {
    const res = carrez.split('T')
    return res[1]
}

async function setFeedData() {
    const reponse = await axios.get('/api/bien/' + route.params.id)
    feed.value = reponse.data
    console.log(reponse.data)
}

async function deleteImage() {
    photoAajouter.value.setAttribute('src', '')
    photo = photoModel
    photo.file = null
}

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
        //photosBien: fields.photos_bien.val
    };

    if (error.is === false) {
        const res = await axios.post('/app/edit-bien/' + route.params.id, payload, {
            headers: {
                'content-type': 'application/json'
            }
        })
        if (res.status === 503 || res.status === 422) {
            error.is = true
            error.message = "Echec de traitement de la requete."
        } else if (res.status === 201) {
            router.push('/app/gestion-biens')
        }
    }
}

async function envoyerImage() {
    const formData = new FormData();
    formData.append('photo', photo.file.original)
    try {
        await axios.post('/app/ajouter-photo/' + route.params.id, formData, {
            headers: {
                'content-type': 'multipart/form-data'
            }
        })
        photo = photoModel
    } catch (e) {
        console.log(e)
        error.is = true
        error.message = "Echec de l\'envoi de la photo."
    }
}

async function supprimerPhoto(index) {
    try {
        await axios.post('/app/supprimer-photo/', {
            photo: fields.photos_bien.val[index]
        }, {
            headers: {
                'content-type': 'application/json'
            }
        })
        fields.photos_bien.val.splice(index, 1)
        photosRefs.value[index].remove()
    } catch (e) {
        console.log(e)
        error.is = true
        error.message = "Echec de suppressionde la photo."
    }
}

async function setPhoto(e) {
    const file = e.target.files[0]
    const content = await new Response(file).text()
    photo.file = { name: file.name, mime: file.type, content, original: file }
    await getImage()
}

async function getImage() {
    photoAajouter.value.src = await readURL(photo.file.original)
}

function readURL(file) {
    return new Promise((res, rej) => {
        const reader = new FileReader();
        reader.onload = e => res(e.target.result);
        reader.onerror = e => rej(e);
        reader.readAsDataURL(file);
    });
};

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
