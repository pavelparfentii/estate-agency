<script setup>
import {Link, usePage} from '@inertiajs/vue3'
import ListingComponent from "@/Pages/Components/ListingComponent.vue";
import ListingSpace from "@/Pages/Components/UI/ListingSpace.vue";
import Price from "@/Pages/Components/UI/Price.vue";
import Box from "@/Pages/Components/UI/Box.vue";
import {computed, ref} from "vue";
import useMonthlyPayment from "@/Pages/Composables/useMonthlyPayment.js";
import MakeOffer from "@/Pages/Listing/Show/Components/MakeOffer.vue";
import OfferMade from "@/Pages/Listing/Show/Components/OfferMade.vue";
import EmptyState from "@/Pages/Components/UI/EmptyState.vue";

const interestRate = ref(2.5);
const duration = ref(25);
const props = defineProps({
    listing: Object,
    offerMade: Object
})

const offer = ref(props.listing.price)

const page = usePage();

const user = computed(() => page.props.user);

// const monthlyPayment = computed(() => {
//    const principle = props.listing.price;
//    const monthlyInterest = interestRate.value /100 /12;
//    const numberOfPaymentMonths = duration.value *12;
//
//     return principle * monthlyInterest * (Math.pow(1 + monthlyInterest, numberOfPaymentMonths)) / (Math.pow(1 + monthlyInterest, numberOfPaymentMonths) - 1)
// })
const {monthlyPayment, totalPaid, totalInterest} = useMonthlyPayment(offer, interestRate, duration)

</script>

<template>
    <div class="flex flex-col-reverse md:grid grid-cols-12 gap-4">


        <Box v-if="listing.images.length" class="md:col-span-7 flex items-center w-full">
            <div class="grid grid-cols-2 gap-2">
                <img v-for="image in listing.images" :key="listing.id" :src="image.src" alt="">
            </div>

        </Box>
        <EmptyState v-else class="md:col-span-7 flex items-center">No images</EmptyState>
        <div class="md:col-span-5 flex flex-col gap-4">
            <Box>
                <template #header>
                    Basic info
                </template>
                <Price :price="listing.price" class="text-2xl font-bold" />
                <ListingSpace :listing="listing" class="text-lg" />
                <ListingComponent :listing="listing" class="text-gray-400"></ListingComponent>
            </Box>
            <Box>
                <template #header>
                    Monthly Payment
                </template>
                <div>
                    <label for="" class="label">Interest rate ({{ interestRate}}%)</label>

                    <input v-model.number="interestRate" type="range" min="0.1" max="30" step="0.1" class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700 shadow">

                    <label for="" class="label">Duration rate ({{ duration }} years)</label>

                    <input v-model.number="duration" type="range" min="1" max="35" step="1" class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700 shadow">
                </div>

                <div class="text-gray-300 dark:text-gray-600 mt-2">
                    <div class="text-gray-300">Your monthly payment</div>
                    <Price :price="monthlyPayment" class="text-3xl dark:text-gray-50" />
                </div>

                <div class="text-gray-300 dark:text-gray-600 mt-2">
                    <div class="flex justify-between">
                        <div>Total paid</div>
                        <div>
                            <Price :price="totalPaid" class="font-medium"></Price>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div>Principal paid</div>
                        <div>
                            <Price :price="listing.price" class="font-medium"></Price>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div>Interest paid</div>
                        <div>
                            <Price :price="totalInterest" class="font-medium"></Price>
                        </div>
                    </div>
                </div>

            </Box>
            <MakeOffer
                v-if="user && !offerMade"
                :listing-id="listing.id"
                :price="listing.price"
                @offer-updated="offer = $event"
            />
            <OfferMade v-if="user && offerMade" :offer="offerMade">

            </OfferMade>

        </div>
    </div>


</template>

<style scoped>

</style>
