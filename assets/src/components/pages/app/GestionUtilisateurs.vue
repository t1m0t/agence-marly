<template>
  <div class="section">
    <h1 class="title">Gestion des Utilisateurs</h1>
    {{ users }}
  </div>
</template>

<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";

const users = ref(null)

onMounted(users.value = await getUsers())

async function getUsers() {
  return axios.get('app/users')
}
</script>