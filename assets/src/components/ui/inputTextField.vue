<template>
  <input
    :class="className"
    :type="type"
    @input="onChanged"
    :placeholder="placeholder"
    autofocus="true"
    :value="modelValue"
  />
</template>

<script>
export default {
  props: ["placeholder", "modelValue", "type", "className"],
  setup(props, { emit }) {
    function onChanged(e) {
      emit("update:modelValue", e.currentTarget.value);
    }
    return {
      onChanged,
    };
  },
};
</script>