<script setup>

import Box from "@/Pages/Components/UI/Box.vue";
import Price from "@/Pages/Components/UI/Price.vue";
import ListingComponent from "@/Pages/Components/ListingComponent.vue";
import ListingSpace from "@/Pages/Components/UI/ListingSpace.vue";
import {Link} from "@inertiajs/vue3";
import useMonthlyPayment from "@/Pages/Composables/useMonthlyPayment.js";

const props = defineProps({
    listing: Object
})

const {monthlyPayment} = useMonthlyPayment(props.listing.price, 2.5, 25)


</script>

<template>
    <Box>
        <Link :href="route('listing.show', listing.id)">
            <div class="flex items-center gap-1">
                <Price :price="listing.price" class="text-2xl font-bold" />
                <div class="text-xs text-gray-500">
                    <Price :price="monthlyPayment" class="text-lg font-bold" /> pm
                </div>
            </div>

            <ListingSpace :listing="listing" class="text-lg" />
            <ListingComponent :listing="listing" class="text-gray-400"></ListingComponent>
        </Link>
        <div>
            <!--            <Link :href="`/listing/${listing.id}/edit`">-->
            <!--                Edit-->
            <!--            </Link>-->
        </div>

    </Box>
</template>

<style scoped>

</style>
