<template>
    <div class="container">
        <div class="section">
            <div class="columns">
                <div class="column is-7"></div>
                <div class="column is-5"></div>
            </div>
            <div class="columns">
                <div class="column is-7"></div>
                <div class="column is-5"></div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { reactive } from "vue";

const form = reactive({
    prenom: null,
    nom: null,
    email: null,
    telephone: null,
    date: {
        mois: 0,
        jour: 0,
        annee: 0,
        heure: 0,
        minute: 0
    }
})
</script>