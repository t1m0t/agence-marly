<template>
    <div class="container">
        {{ bien }}
        <div class="section">
            <div class="columns">
                <div class="column is-7 box">
                    <div class="columns">
                        <div class="column">
                            photo principale
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column">
                            autres photos
                        </div>
                    </div>
                </div>
                <div class="column is-5 box">

                </div>
            </div>
            <div class="columns box">
                <div class="column">
                    <div>
                        <label class="label">Description</label>
                        <p>{{ bien.description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router'
import axios from 'axios';

const route = useRoute()
const bien = ref(null)

const reponse = await axios.get('/api/bien/' + route.params.id)
bien.value = reponse.data.data


</script>