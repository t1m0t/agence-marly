<template>
  <div class="navbar-end">
    <div class="navbar-item">
      <div class="buttons">
        <routerLink to="/app/profile" class="button is-primary">
          <strong>Profile</strong>
        </routerLink>
        <routerLink to="/" class="button is-danger is-outlined" @click.prevent="logout"><strong>Se déconnecter</strong>
        </routerLink>
      </div>
    </div>
  </div>
</template>

<script setup>
import { inject } from 'vue'
import { useRouter } from "vue-router";
import axios from "axios";

const emitter = inject('emitter')
const router = useRouter()

const redirect = router.currentRoute.value.query.redirect;

function execRedirect() {
  emitter.emit('logged-in', { isLoggedIn: false, isAdmin: false })
  if (redirect !== undefined) {
    router.push(redirect);
  } else {
    router.push("/");
  }
}

async function logout() {
  await axios.get('/auth/logout').then(execRedirect())
}

</script>
