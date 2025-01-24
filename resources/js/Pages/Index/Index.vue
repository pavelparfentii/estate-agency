<script setup>
    import {Link} from '@inertiajs/vue3'

    defineProps({
        message: String
    })
</script>

<template>
    <div>Index</div>
    <div>The message is {{message}}</div>
    <Link href="/hello">Show Page</Link>
</template>

<style scoped>

</style>

<!--<script>-->
<!--import MainComponent from "../Layouts/MainComponent.vue";-->
<!--export default {-->
<!--    layout: MainComponent-->
<!--}-->
<!--</script>-->
