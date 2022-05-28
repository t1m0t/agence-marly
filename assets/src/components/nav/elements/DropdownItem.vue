<template>
  <div class="navbar-item has-dropdown is-hoverable">
    <a class="navbar-link"> {{ props.values.content }} </a>
    <div class="navbar-dropdown">
      <NavbarStart v-for="item in props.values.items" :key="item.id" :values="item.values" />
    </div>
  </div>
</template>

<script setup>
const props = defineProps(['values'])
</script>
