<template>
  <nav class="navbar" role="navigation" aria-label="main navigation">
    <NavbarBrand :data-target="dataTarget" />
    <div :id="dataTarget" class="navbar-menu" :style="display">
      <div v-if="!isLoggedIn" class="navbar-start">
        <NavbarStart v-for="item in menuStartItems" :key="item.id" :values="item.values" />
      </div>
      <div v-else class="navbar-start">
        <NavbarStart v-for="item in authenticatedMenuStart" :key="item.id" :values="item.values" />
      </div>
      <NavbarEnd />
    </div>
  </nav>
</template>

<script setup>
import { provide, ref, watch } from "vue";

import NavbarBrand from "./elements/NavbarBrand.vue";
import NavbarEnd from "./elements/NavbarEnd.vue";
import menuStartItems from "./data/mainMenu.js";
import authenticatedMenuStart from "./data/authenticatedMenu.js";
import { useCookie } from 'vue-cookie-next'

const cookies = useCookie()
const dataTarget = "navBarMain";
const activateMenu = ref(false);
const display = ref("");
const isLoggedIn = ref(cookies.getCookie('isLoggedIn') === true ? true : false)
provide("activateMenu", activateMenu);

watch(activateMenu, (val) => {
  if (val === true) {
    display.value = "display: inherit";
  } else if (val === false) {
    display.value = "display: none";
  }
});
</script>
