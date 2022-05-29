<template>
    <p>Pages : <button v-for="page in [...Array(data.pages).keys()]" class="button is-info"
            @click.prevent="goToPage(page + 1)">{{
                    page + 1
            }}</button></p>

</template>

<script setup>
const props = defineProps(['data'])
const emit = defineEmits(['goToPage'])

function goToPage(number) {
    emit('goToPage', number)
}
</script>