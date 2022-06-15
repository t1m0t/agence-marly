<template>
  <nav class="navbar" role="navigation" aria-label="main navigation">
    <NavbarBrand :data-target="dataTarget" />
    <div :id="dataTarget" class="navbar-menu" :style="display">
      <div class="navbar-start">
        <NavbarStart v-for="item in dataMenu.mainMenu" :key="item.id" :values="item.values"
          @loggedIn="isLoggedIn = true" />
      </div>
      <div v-if="isLoggedIn && isAdmin" class="navbar-start">
        <NavbarStart v-for="item in dataMenu.authenticatedMenu" :key="item.id" :values="item.values"
          @loggedOut="isLoggedIn = false" />
      </div>
      <div v-else-if="isLoggedIn && !isAdmin" class="navbar-start">
        <NavbarStart v-for="item in dataMenu.rendezVousMenuStart" :key="item.id" :values="item.values"
          @loggedOut="isLoggedIn = false" />
      </div>
      <NavbarEnd />
    </div>
  </nav>
</template>

<script setup>
import { provide, ref, watch, inject } from "vue";

import NavbarBrand from "./elements/NavbarBrand.vue";
import NavbarStart from "./elements/NavbarStart.vue";
import NavbarEnd from "./elements/NavbarEnd.vue";
import dataMenu from "./data/index"
import { useCookie } from 'vue-cookie-next'

const cookies = useCookie()
const emitter = inject('emitter')
const dataTarget = "navBarMain";
const activateMenu = ref(false);
const display = ref("");
const isLoggedIn = ref(getIsLoggedIn())
const isAdmin = ref(getIsAdmin())

emitter.on('logged-in', data => {
  isLoggedIn.value = data.isLoggedIn
  isAdmin.value = data.isAdmin
})

provide('isLoggedIn', isLoggedIn)
provide("activateMenu", activateMenu);


function getIsLoggedIn() {
  return cookies.getCookie('IS_LOGGED_IN') === '1' ? true : false
}

function getIsAdmin() {
  return cookies.getCookie('IS_ADMIN') === '1' ? true : false
}


watch(activateMenu, (val) => {
  if (val === true) {
    display.value = "display: inherit";
  } else if (val === false) {
    display.value = "display: none";
  }
});
</script>

<style>
.navbar-start {
  margin-right: 0;
}
</style>