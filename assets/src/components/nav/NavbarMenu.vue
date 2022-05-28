<template>
  <nav class="navbar" role="navigation" aria-label="main navigation">
    <NavbarBrand :data-target="dataTarget" />
    <div :id="dataTarget" class="navbar-menu" :style="display">
      <div v-if="!isLoggedIn" class="navbar-start">
        <NavbarStart v-for="item in menuStartItems" :key="item.id" :values="item.values"
          @loggedIn="isLoggedIn = true" />
      </div>
      <div v-else class="navbar-start">
        <NavbarStart v-for="item in authenticatedMenuStart" :key="item.id" :values="item.values"
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
import menuStartItems from "./data/mainMenu.js";
import authenticatedMenuStart from "./data/authenticatedMenu.js";
import { useCookie } from 'vue-cookie-next'

const cookies = useCookie()
const emitter = inject('emitter')
const dataTarget = "navBarMain";
const activateMenu = ref(false);
const display = ref("");
const isLoggedIn = ref(cookies.getCookie('IS_LOGGED_IN') !== null && cookies.getCookie('IS_LOGGED_IN') === '1' ? true : false)
emitter.on('logged-in', (is) => {
  is ? isLoggedIn.value = true : isLoggedIn.value = false
})

provide('isLoggedIn', isLoggedIn)
provide("activateMenu", activateMenu);

watch(activateMenu, (val) => {
  if (val === true) {
    display.value = "display: inherit";
  } else if (val === false) {
    display.value = "display: none";
  }
});
</script>
