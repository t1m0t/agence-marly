<template>
  <div class="navbar-brand">
    <router-link to="/" class="navbar-item"
      ><strong>Agence Marly</strong></router-link
    >

    <a
      role="button"
      class="navbar-burger"
      aria-label="menu"
      aria-expanded="false"
      :data-target="props.dataTarget"
      @click="display"
    >
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>
</template>

<script>
import { inject } from "vue";
export default {
  setup(props) {
    const activateMenu = inject("activateMenu");
    function display() {
      activateMenu.value = !activateMenu.value;
    }
    return {
      props,
      display,
    };
  },
};
</script>
