<template>
  <div :class="class">
    <select @change="onChanged">
      <option disabled value="default" ref="noSelect">
        {{ defaultSelect }}
      </option>
      <option v-for="item in props.items" :key="item" :value="item" ref="selectRefs">
        {{ item }}
      </option>
    </select>
  </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
const props = defineProps(["class", "items", "defaultSelectText", 'startValue'])
const emits = defineEmits(["update:modelValue"])
const defaultSelect = ref(props.defaultSelectText)
const selectRefs = ref([])
const noSelect = ref(null)

if (defaultSelect.value === undefined) defaultSelect.value = '-- Selection --'

function onChanged(e) {
  emits("update:modelValue", e.target.value)
}

onMounted(() => {
  if (props.startValue !== undefined) {
    for (let i = 0; i < props.items.length; i++) {
      if (props.startValue === props.items[i]) {
        selectRefs.value[i].selected = true
        break
      }
    }
  } else noSelect.value.selected = true
})

</script>
