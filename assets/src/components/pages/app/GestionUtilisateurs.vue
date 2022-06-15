<template>
  <div class="section">
    <h1 class="title">Gestion des Utilisateurs</h1>
    <table class="table" v-if="users.data.data.length > 0">
      <thead>
        <tr>
          <td>id</td>
          <td>email</td>
          <td>roles</td>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in users.data.data">
          <td>{{ item.id }}</td>
          <td>{{ item.email }}</td>
          <td>{{ item.roles }}</td>
        </tr>
      </tbody>
    </table>
    <div v-else>Pas encore de rendez-vous pris.</div>
  </div>
</template>

<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";

const users = ref(null)

onMounted(users.value = await getUsers())

async function getUsers() {
  return axios.get('users')
}
</script>