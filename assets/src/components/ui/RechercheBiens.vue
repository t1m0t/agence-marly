<template>
    <div class="field has-addons">
        <div class="control">
            <input class="input" type="number" placeholder="Pièces min" v-model="rechercheData.piecesMin">
        </div>
        <div class="control">
            <input class="input" type="number" placeholder="Pièces max" v-model="rechercheData.picesMax">
        </div>
        <div class="control">
            <input class="input" type="number" placeholder="Surface min" v-model="rechercheData.surfaceMin">
        </div>
        <div class="control">
            <input class="input" type="number" placeholder="Surface max" v-model="rechercheData.surfaceMax">
        </div>
        <div class="control">
            <input class="input" type="number" placeholder="Prix min" v-model="rechercheData.prixMin">
        </div>
        <div class="control">
            <input class="input" type="number" placeholder="Prix max" v-model="rechercheData.prixMax">
        </div>
        <div class="control">
            <button class="button is-info" @click.prevent="chercher">Chercher</button>
        </div>
    </div>
</template>

<script setup>
import { reactive } from 'vue';
const emit = defineEmits(['chercher'])

const rechercheData = reactive({
    piecesMin: null,
    picesMax: null,
    surfaceMin: null,
    surfaceMax: null,
    prixMin: null,
    prixMax: null,
})

function chercher() {
    emit('chercher', rechercheData)
}
</script>