<template>
  <div class="section">
    <h1 class="title">Mes Rendez-Vous</h1>
    <table class="table" v-if="data.data.data.length > 0">
      <thead>
        <tr>
          <td>Message</td>
          <td>Jour</td>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in data.data.data">
          <td>{{ item.message }}</td>
          <td>{{ item.annee }}/{{ item.mois }}/{{ item.jour }} à {{ item.heure }}:{{ item.minute }}</td>
        </tr>
      </tbody>
    </table>
    <div v-else>Pas encore de rendez-vous pris.</div>
  </div>
</template>

<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";

const data = ref(null)

onMounted(data.value = await getRendezVous())

async function getRendezVous() {
  return axios.get('/app/liste-rendez-vous')
}
</script>