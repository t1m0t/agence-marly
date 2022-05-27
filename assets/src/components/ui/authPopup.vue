<template>
  <div :class="popupClass" v-show="isActive">
    <button @click="close" class="delete"></button
    ><strong> {{ message }}</strong>
  </div>
</template>

<script>
import { ref, computed } from "vue";
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

    const popupClass = computed(() => {
      if (props.class !== undefined) {
        return props.class;
      } else {
        return "notification is-warning";
      }
    });

    return {
      close,
      isActive,
      popupClass,
    };
  },
};
</script>
