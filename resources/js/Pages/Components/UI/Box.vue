<script setup>

</script>

<template>
    <div class="border border-gray-400 dark:border-gray-800 rounded-md p-4 shadow-sm dark:text-gray-300">
        <div class="text-gray-400 font-medium mb-1"><slot name="header"/></div>
        <slot/>
    </div>

</template>

<style scoped>

</style>
