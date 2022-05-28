<template>
  <LoggedinNav v-if="isLoggedIn"></LoggedinNav>
  <NotloggedinNav v-else></NotloggedinNav>
</template>

<script setup>
import { ref, inject, watch } from "vue";
import LoggedinNav from "./LoggedinNav.vue";
import NotloggedinNav from "./NotloggedinNav.vue";
import { useCookie } from 'vue-cookie-next'

const cookies = useCookie()
const isLoggedIn = ref(cookies.getCookie('IS_LOGGED_IN') !== null && cookies.getCookie('IS_LOGGED_IN') === '1' ? true : false)
const loggedIn = inject('isLoggedIn')

watch(loggedIn, (newVal, _) => {
  isLoggedIn.value = newVal
})

</script>
