<script setup>

import Box from "@/Pages/Components/UI/Box.vue";
import Price from "@/Pages/Components/UI/Price.vue";
import {useForm, usePage} from "@inertiajs/vue3";
import {computed, watch} from "vue";
import {debounce} from "lodash";

const props = defineProps({
    listingId: Number,
    price: Number,
})

const form = useForm({
    amount: props.price,
});

const difference = computed(()=>form.amount - props.price);

const minOffer = computed(()=> Math.round(form.amount/2));
const maxOffer = computed(()=> Math.round(form.amount*2));

const makeOffer = () => form.post(
    route('listing.offer.store', {listing: props.listingId}),
    {
        preserveScroll: true,
        preserveState: true,
    }
)

const emit = defineEmits(['offerUpdated'])
watch(
    () => form.amount,
    debounce((value) => emit('offerUpdated', value), 200),
)


</script>

<template>
    <Box>
        <template #header>Make Offer</template>
    </Box>
    <div>
        <form @submit.prevent="makeOffer" method="post">
            <input type="text" class="input" v-model="form.amount">
            <input v-model="form.amount" type="range" :min="minOffer" :max="maxOffer" :step="10000" class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700 shadow">
            <button type="submit" class="btn-outline w-full mt-2 text-sm">Make an Offer</button>
            {{ form.errors.amount }}
        </form>
    </div>
    <div class="flex justify-between text-gray-400 mt-2">
        <div>Difference</div>
        <div>
            <Price :price="difference"></Price>
        </div>

    </div>
</template>

<style scoped>

</style>
