<script setup>

import Box from "@/Pages/Components/UI/Box.vue";
import {Link} from "@inertiajs/vue3";
import Price from "@/Pages/Components/UI/Price.vue";
import {computed} from "vue";

const props = defineProps({
    offer: {},
    listingPrice: Number,
    isSold: Boolean
})

const difference = computed(()=> props.offer.amount - props.listingPrice)

const madeOn = computed(()=>new Date(props.offer.created_at).toDateString() )

// const NotSold = computed(()=>!props.offer.accepted_at && !props.offer.rejected_at)

</script>

<template>
    <Box>
        <template #header>Offer #{{offer.id}} <span v-if="offer.accepted_at" class="dark:bg-green-900 dark:text-gray-200 bg-green-200 p-1 rounded-md uppercase ml-2">accepted</span></template>
<!--        {{offer}}-->
        <section class="flex items-center justify-between">
            <div>
                <Price :price="offer.amount" class="text-2xl"></Price>
                <div class="text-gray-500">Difference <Price :price="difference"></Price></div>
                <div class="text-gray-500 text-sm">
                    Made by {{offer.bidder.name}}
                </div>
                <div class="text-gray-500 text-sm">
                    Made on {{madeOn}}
                </div>
            </div>
            <div>
                <Link v-if="!isSold"
                    :href="route('realtor.offer.accept', {offer: offer.id})"
                    method="put"
                    class="btn-outline text-sm font-medium"
                    as="button">Accept</Link>
            </div>
        </section>
    </Box>
</template>

<style scoped>

</style>
