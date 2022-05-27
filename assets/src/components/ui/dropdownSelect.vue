<template>
  <div :class="props.class">
    <select v-model="itemSelected">
      <option disabled value="default">
        {{ defaultSelectText }}
      </option>
      <option v-for="item in props.items" :key="item" :value="item">
        {{ item }}
      </option>
    </select>
  </div>
</template>

<script>
import { ref, watch, inject } from "vue";
export default {
  props: ["class", "items", "defaultSelectText", "formSubmitted"],
  setup(props, { emit }) {
    const itemSelected = ref("default");

    watch(itemSelected, () => {
      emit("update:selected", itemSelected.value);
    });

    const emitter = inject("emitter");

    emitter.on("sourceSubmitted", (value) => {
      if (value === true) {
        itemSelected.value = "default";
      }
    });

    return {
      props,
      itemSelected,
    };
  },
};
</script>
