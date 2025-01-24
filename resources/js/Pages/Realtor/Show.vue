<script setup>
import {Link} from "@inertiajs/vue3";
import Box from "@/Pages/Components/UI/Box.vue";
import Price from "@/Pages/Components/UI/Price.vue";
import ListingSpace from "@/Pages/Components/UI/ListingSpace.vue";
import ListingComponent from "@/Pages/Components/ListingComponent.vue";
import {computed} from "vue";
import Offer from "@/Pages/Realtor/Show/Components/Offer.vue";

const props = defineProps({
    listing: {}
})

const hasOffers = computed(()=>props.listing.offers.length)

</script>

<template>
    <div class="mb-4">
        <Link :href="route('realtor.listing.index')">Go back to listings</Link>
    </div>

    <section class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box v-if="!hasOffers" class="flex md:col-span-7 items-center">
            <div class="w-full text-center text-gray-500">
                No offers
            </div>
        </Box>
        <div v-else class ='md:col-span-7 flex flex-col gap-4'>
            <Offer
                v-for="offer in listing.offers"
                :key="offer.id"
                :offer="offer"
                :listing-price="listing.price"
                :is-sold="listing.sold_at !== null"
            ></Offer>
        </div>
        <Box class="md:col-span-5">
            <template #header>Basic Info</template>
            <Price :price="listing.price" class="text-xl font-bold"></Price>
            <ListingSpace :listing="listing" class="text-xl"></ListingSpace>
            <ListingComponent :listing="listing" class="text-gray-500"></ListingComponent>
        </Box>
    </section>

</template>

<style scoped>

</style>
