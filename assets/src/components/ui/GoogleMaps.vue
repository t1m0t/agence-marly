<template>
    <div ref="mapDiv" style="width: 100%; height: 50vh" />
</template>

<script setup>
import { computed, ref, onMounted, onUnmounted, watch } from 'vue'
import { Loader } from '@googlemaps/js-api-loader'
const GOOGLE_MAPS_API_KEY = 'AIzaSyDKcpqIyuu1bt9Y2KWB3lpdrRbMJcwPr0s'

const pos = {
    lat: 48.87297408286036,
    lng: 2.329100531958169
}

const currPos = computed(() => (pos))
const loader = new Loader({ apiKey: GOOGLE_MAPS_API_KEY })
const mapDiv = ref(null)
let map = ref(null)
let clickListener = null
onMounted(async () => {
    await loader.load()
    map.value = new google.maps.Map(mapDiv.value, {
        center: currPos.value,
        zoom: 14
    })
    new google.maps.Marker({
        position: pos,
        map: map.value,
        title: "Agence Marly",
    });

})
onUnmounted(async () => {
    if (clickListener) clickListener.remove()
})
</script>