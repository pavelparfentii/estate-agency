<script setup>
  import Box from "@/Pages/Components/UI/Box.vue";
  import Price from "@/Pages/Components/UI/Price.vue";
  import {computed} from "vue";

  const props =  defineProps({
        offer: {}
    })

  const offerMadeOn = computed(()=>new Date(props.offer.created_at).toDateString());

</script>

<template>
    <Box>
        <template #header>Offer Made</template>
        <Price :price="offer.amount" class="text-2xl"></Price>

        <section class="mt-2 flex flex-col md:flex-row justify-between text-gray-500">
            <div>Offer Made On</div>
            <div class="font-medium">{{offerMadeOn}}</div>
        </section>
    </Box>
</template>

<style scoped>

</style>
