<script setup>
import {useForm } from "@inertiajs/vue3";
import ErrorMessage from "@/Pages/Components/UI/ErrorMessage.vue";

const props = defineProps({
    listing: {}
})

const form = useForm({
    beds: props.listing.beds,
    baths: props.listing.baths,
    area: props.listing.area,
    city: props.listing.city,
    code: props.listing.code,
    street: props.listing.street,
    street_nr: props.listing.street_nr,
    price: props.listing.price
})

const update = () => form.put(route('realtor.listing.update', { listing: props.listing.id }));
</script>

<template>
    <form @submit.prevent="update">
        <div class="grid grid-cols-6 gap-4">
            <div class="col-span-2">
                <label class="label">Beds</label>
                <input v-model.number="form.beds" type="text" class="input"/>
                <ErrorMessage v-if="form.errors.beds" :error="form.errors.beds"></ErrorMessage>
            </div>

            <div class="col-span-2">
                <label class="label">Baths</label>
                <input v-model.number="form.baths" type="text" class ="input"/>
                <ErrorMessage v-if="form.errors.baths" :error="form.errors.baths"></ErrorMessage>
            </div>

            <div class="col-span-2">
                <label>Area</label>
                <input v-model.number="form.area" type="text" class ="input"/>
                <ErrorMessage v-if="form.errors.area" :error="form.errors.area"></ErrorMessage>
            </div>

            <div class="col-span-2">
                <label class="label">City</label>
                <input v-model="form.city" type="text" class ="input"/>
                <ErrorMessage v-if="form.errors.city" :error="form.errors.city"></ErrorMessage>
            </div>

            <div class="col-span-2">
                <label class="label">Post Code</label>
                <input v-model="form.code.number" type="text" class ="input"/>
                <ErrorMessage v-if="form.errors.code" :error="form.errors.code"></ErrorMessage>
            </div>

            <div class="col-span-4">
                <label class="label">Street</label>
                <input v-model="form.street" type="text" class ="input"/>
                <ErrorMessage v-if="form.errors.street" :error="form.errors.street"></ErrorMessage>
            </div>

            <div class="col-span-2">
                <label class="label">Street Nr</label>
                <input v-model="form.street_nr" type="number" class ="input"/>
                <ErrorMessage v-if="form.errors.street_nr" :error="form.errors.street_nr"></ErrorMessage>
            </div>

            <div class="col-span-6">
                <label class= "label">Price</label>
                <input v-model.number="form.price" type="text" class ="input"/>
                <ErrorMessage v-if="form.errors.price" :error="form.errors.price"></ErrorMessage>
            </div>

            <div>
                <button type="submit" class="btn-primary">Update</button>
            </div>
        </div>
    </form>
</template>

<style scoped>

</style>
