<template>
  <div class="section">
    <button class="button is-success" @click.prevent="handleAjouterBien">Ajouter un bien</button>
    <h1 class="title">Gestion des Biens</h1>
    <div class="table-container">
      <table class="table is-narrow">
        <thead>
          <tr>
            <td v-for="column in columns">{{ column }}</td>
            <td>Action</td>
          </tr>
        </thead>
        <tbody>
          <tr v-for="bien in listBiens.data.data">
            <td v-for="column in columns">{{ bien[column] }}</td>
            <td><a @click.prevent="editBien(bien.id)" class="button is-info">Editer</a></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import axios from 'axios'
import { useRouter } from "vue-router"

const router = useRouter()
const listBiens = await axios.get('/liste-biens')
const columns = Object.keys(listBiens.data.data[0])

function editBien(bienId) {
  router.push('/app/edit-bien/' + bienId);
}

function handleAjouterBien() {
  router.push('/app/ajout-bien');
}
</script>