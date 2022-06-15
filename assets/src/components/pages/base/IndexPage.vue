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
import GoogleMaps from '../../ui/GoogleMaps.vue'
</script>
