<template>
  <div class="navbar-end">
    <div class="navbar-item">
      <div class="buttons">
        <routerLink to="/profile" class="button is-primary">
          <strong>Profile</strong></routerLink
        >
        <routerLink
          to="/"
          class="button is-danger is-outlined"
          @click.prevent="logout"
          ><strong>Log out</strong></routerLink
        >
      </div>
    </div>
  </div>
</template>

<script>
import { useStore } from "vuex";
export default {
  setup() {
    const store = useStore();

    function logout() {
      store.dispatch("user/logout");
    }
    return {
      logout,
    };
  },
};
</script>
