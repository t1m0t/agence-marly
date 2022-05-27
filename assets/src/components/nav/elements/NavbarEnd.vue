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
const isLoggedIn = ref(cookies.getCookie('isLoggedIn') === true ? true : false)
</script>
