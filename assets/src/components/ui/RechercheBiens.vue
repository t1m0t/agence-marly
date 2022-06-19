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
    <div class="field">
        <div class="control">
            <label class="label">Type de bien</label>
            <dropdownSelect :items="typeBien" v-model="rechercheData.typeBien" class="select" />
        </div>
        <div class="control">
            <label class="label">Type de bâti</label>
            <dropdownSelect :items="typeBati" v-model="rechercheData.typeBati" class=" select" />
        </div>
    </div>
</template>

<script setup>
import { reactive } from 'vue';
import dropdownSelect from '../ui/dropdownSelect.vue'
const emit = defineEmits(['chercher'])
const props = defineProps(['typeBien', 'typeBati'])
const rechercheData = reactive({
    piecesMin: null,
    picesMax: null,
    surfaceMin: null,
    surfaceMax: null,
    prixMin: null,
    prixMax: null,
    typeBien: null,
    typeBati: null
})

function chercher() {
    emit('chercher', rechercheData)
}
</script>