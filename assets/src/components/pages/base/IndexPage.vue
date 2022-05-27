<template>
  <div class="section">
    <h1 class="title">Page d'Accueil</h1>
    <p>Liste des biens :</p>
  </div>
</template>

<script setup>
import { inject } from 'vue'

const axios = inject('axios')
/* const liste = await axios.get('/biens/liste', {
  headers: {
    'cache-control': 'max-age=600',
    'accept': 'application/json'
  }
})
console.log(liste) */
</script>