<template>
  <div class="modal is-active" v-if="isActive">
    <div class="modal-background"></div>
    <div class="modal-content">
      <slot></slot>
    </div>
    <button
      class="modal-close is-large"
      aria-label="close"
      @click.prevent="close"
    ></button>
  </div>
</template>

<script>
import { ref } from "vue";
export default {
  props: ["class", "message", "modelValue"],
  setup(props, { emit }) {
    const isActive = ref(true);

    function close() {
      isActive.value = false;
      if (props.modelValue !== undefined) {
        emit("update:modelValue", !props.modelValue);
      }
    }

    return {
      close,
      isActive,
    };
  },
};
</script>