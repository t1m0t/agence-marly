<template>
  <input :class="className" :type="type" @input="onChanged" :placeholder="placeholder" autofocus="true"
    :value="modelValue" />
</template>

<script setup>
const props = defineProps(["placeholder", "modelValue", "type", "className"])

const emits = defineEmits(["update:modelValue"])

function onChanged(e) {
  emits("update:modelValue", e.target.value)
}

</script>