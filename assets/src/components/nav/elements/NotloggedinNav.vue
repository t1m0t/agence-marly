<template>
  <div class="navbar-end">
    <div class="navbar-item">
      <div class="buttons">
        <!--<router-link to="/senregistrer" class="button is-primary">
          <strong>S'enregister</strong></router-link
        > -->
        <router-link to="/connexion" class="button is-light" @click.prevent="axios.get('/auth/login/init')">
          <strong>Se connecter</strong>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script setup>
import axios from 'axios'
</script>
