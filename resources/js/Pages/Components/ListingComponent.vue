<script setup>
    defineProps({
        listing: {}
    })
</script>

<template>
    <span>{{listing.street}} {{listing.street_nr}} {{listing.city}}</span>
</template>

<style scoped>

</style>
