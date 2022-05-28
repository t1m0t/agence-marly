<template>
  <routerLink v-if="values.type === 'link'" :to="values.ref" class="navbar-item">
    {{ values.content }}
  </routerLink>

  <DropdownItem v-else-if="values.type === 'dropdownLink'" :values="values" />

  <hr v-else-if="values.type === 'hr'" class="navbar-divider" />
</template>

<script setup>
import DropdownItem from "./DropdownItem.vue";
defineProps(['values'])

</script>
