<script setup>
   const props = defineProps({
        error: String
    })
</script>

<template>
    <span class="input-error">{{props.error}}</span>
</template>

<style scoped>

</style>
