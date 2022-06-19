<template>
  <div class="container">
    <h1 class="title">Voici nos biens disponibles</h1>
    <RechercheBiens @chercher="handleChercher" :typeBien="listBiens.data.type_bien"
      :typeBati="listBiens.data.type_bati" />
    <Pagination :data="listBiens.data.pagination" @goToPage="handleGoToPage" />
    <div class="flex-container">
      <div v-for="bien in listBiens.data.data" class="card in-flex-list">
        <div class="card-image">
          <figure class="image is-4by3">
            <img :src="getPhotoPrincipale(bien)" alt="Placeholder image">
          </figure>
        </div>
        <div class="card-content">
          <div class="media">
            <div class="media-content">
              <p class="title is-4"><a :href="/bien/ + bien.id" target="_blank">{{ bien.titre }}</a></p>
              <p>Type : {{ bien.type }}</p>
              <p>Prix : {{ bien.prix }} €</p>
              <p>Carrez : {{ bien.carrez }}</p>
              <p>Surface : {{ bien.surface }} m²</p>
            </div>
          </div>

          <div class="content">
            <p><time>Créé le {{ new Date(bien.date_creation).toLocaleString() }}</time></p>
            <p><time>Mis à jour le {{ new Date(bien.date_modification).toLocaleString() }}</time></p>
          </div>
        </div>
      </div>
    </div>
    <Pagination :data="listBiens.data.pagination" @goToPage="handleGoToPage" />
  </div>
</template>

<script setup>
import axios from 'axios'
import { reactive, watch, ref } from 'vue';
import Pagination from '../../ui/Pagnination.vue'
import RechercheBiens from '../../ui/RechercheBiens.vue'

const rechercher = ref(false)
const recherche = reactive({
  data: {
    piecesMin: null,
    picesMax: null,
    surfaceMin: null,
    surfaceMax: null,
    prixMin: null,
    prixMax: null,
    typeBien: null,
    typeBati: null
  }
})

const queryMapping = {
  prixMin: 'pmin',
  prixMax: 'pmaw',
  surfaceMin: 'smin',
  surfaceMax: 'smax',
  piecesMin: 'pimin',
  picesMax: 'pimax',
  pageNumber: 'page',
  typeBien: 'tbien',
  typeBati: 'tbati'
}

const listBiens = ref(await axios.get('/liste-biens'))

function handleGoToPage(pageNumber) {
  recherche.data.pageNumber = pageNumber
  const query = getQuery()
  getListeBien(query)
}

function handleChercher(data) {
  recherche.data = data
  const query = getQuery()
  console.log(query)
  getListeBien(query)
}

function getPhotoPrincipale(bien) {
  let res = ''
  bien.photo.forEach(el => {
    if (el.estPrincipale === true) res = '/images/' + el.fileName
  })
  return res
}

function getListeBien(query) {
  let res = null;
  if (query) res = axios.get('/liste-biens?' + query).then(resp => {
    listBiens.value = resp
  })
  else res = axios.get('/liste-biens').then(resp => {
    listBiens.value = resp
  })
}

function getQuery() {
  let query = ''
  const keysRecherche = Object.keys(recherche.data)
  keysRecherche.forEach(el => {
    if (recherche.data[el] > 0) {
      const newQ = queryMapping[el] + '=' + recherche.data[el] + '&'
      query += newQ
    } else if (el === 'typeBien' && recherche.data[el] !== null) {
      const newQ = queryMapping[el] + '=' + recherche.data[el] + '&'
      query += newQ
    } else if (el === 'typeBati' && recherche.data[el] !== null) {
      const newQ = queryMapping[el] + '=' + recherche.data[el] + '&'
      query += newQ
    }
  })
  return query
}

</script>

<style>
.flex-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: normal;
  align-items: stretch;
  align-content: stretch;
}

.in-flex-list {
  display: block;
  flex-grow: 0;
  flex-shrink: 1;
  flex-basis: auto;
  align-self: auto;
  order: 0;
  width: 20vw;
  min-width: 200px;
  max-width: 250px;
  padding: 10px;
  margin: 5px;
}
</style>