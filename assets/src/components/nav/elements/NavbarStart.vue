<template>
  <routerLink v-if="isLink" :to="props.values.ref" class="navbar-item">
    {{ props.values.content }}
  </routerLink>

  <DropdownItem v-else-if="isDropDown" :values="props.values" />

  <hr v-else-if="isHr" class="navbar-divider" />
</template>

<script>
import DropdownItem from "./DropdownItem.vue";
export default {
  components: { DropdownItem },
  props: ["values"],
  setup(props) {
    function isLink() {
      if (props.values.type === "link") {
        return true;
      }
      return false;
    }

    function isDropDown() {
      if (props.values.type === "dropdownLink") {
        return true;
      }
      return false;
    }

    function isHr() {
      if (props.values.type === "hr") {
        return true;
      }
      return false;
    }

    return {
      isLink: isLink(),
      isDropDown: isDropDown(),
      isHr: isHr(),
      props,
    };
  },
};
</script>
