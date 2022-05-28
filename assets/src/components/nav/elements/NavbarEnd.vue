<template>
  <LoggedinNav v-if="isLoggedIn"></LoggedinNav>
  <NotloggedinNav v-else></NotloggedinNav>
</template>

<script setup>
import { ref, watch } from "vue";
import LoggedinNav from "./LoggedinNav.vue";
import NotloggedinNav from "./NotloggedinNav.vue";
import { useCookie } from 'vue-cookie-next'

const cookies = useCookie()
const isLoggedIn = ref(cookies.getCookie('X_AUTH_TOKEN') !== null ? true : false)

watch(isLoggedIn, () => isLoggedIn.value = cookies.getCookie('X_AUTH_TOKEN'))
</script>
