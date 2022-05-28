<template>
  <div class="box">
    <div class="columns">
      <div class="column is-8">
        <img class="image"
          src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.bourges.infoptimum.com%2Fimages%2Fpara%2F_lapetiteagence-malus.jpg&f=1&nofb=1"
          alt="">
      </div>
      <div class="column is-4">
        <div class="content">
          <h1>Agence Marly</h1>
          <p>7 rue de Rivoli, 75012 Paris</p>
          <p>Tel : 01 45 89 55 41</p>
          <GoogleMaps />
        </div>
      </div>
    </div>
  </div>


</template>

<script setup>
import { inject } from 'vue'
import GoogleMaps from '../../ui/GoogleMaps.vue'
const axios = inject('axios')
/* const liste = await axios.get('/biens/liste', {
  headers: {
    'cache-control': 'max-age=600',
    'accept': 'application/json'
  }
})
console.log(liste) */
/* 
const data = {
  center: { lat: 51.093048, lng: 6.842120 },
  markers: [
    {
      position: {
        lat: 51.093048, lng: 6.842120
      },
    }
    , // Along list of clusters
  ]
} */
</script>