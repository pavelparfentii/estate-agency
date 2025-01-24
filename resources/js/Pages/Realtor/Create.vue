<script setup>
    import {reactive} from "vue";

    import {router} from "@inertiajs/vue3";
    import {useForm } from "@inertiajs/vue3";
    import ErrorMessage from "@/Pages/Components/UI/ErrorMessage.vue";

    const form = useForm({
        beds: 0,
        baths: 0,
        area: 0,
        city: null,
        code: null,
        street: null,
        street_nr: null,
        price: 0
    })

    // const create = () => form.post('/listing', form)
    const create = () => form.post(route('realtor.listing.store'), form)




</script>

<template>
        <form @submit.prevent="create">
            <div class="grid grid-cols-6 gap-4">
                <div class="col-span-2">
                    <label class="label">Beds</label>
                    <input v-model.number="form.beds" type="text" class="input" />
                    <ErrorMessage v-if="form.errors.beds" :error="form.errors.beds"></ErrorMessage>
<!--                    <div v-if="form.errors.beds" class="input-error">{{form.errors.beds}}</div>-->
                </div>

                <div class="col-span-2">
                    <label class="label">Baths</label>
                    <input v-model.number="form.baths" type="text" class="input"/>
                    <ErrorMessage v-if="form.errors.baths" :error="form.errors.baths"></ErrorMessage>
                </div>

                <div class="col-span-2">
                    <label>Area</label>
                    <input v-model.number="form.area" type="text" class="input"/>
                    <ErrorMessage v-if="form.errors.area" :error="form.errors.area"></ErrorMessage>
                </div>

                <div class="col-span-2">
                    <label class="label">City</label>
                    <input v-model="form.city" type="text" class="input"/>
                    <ErrorMessage v-if="form.errors.city" :error="form.errors.city"></ErrorMessage>
                </div>

                <div class="col-span-2">
                    <label class="label">Post Code</label>
                    <input v-model="form.code" type="text" class="input"/>
                    <ErrorMessage v-if="form.errors.code" :error="form.errors.code"></ErrorMessage>
                </div>

                <div class="col-span-4">
                    <label class="label">Street</label>
                    <input v-model="form.street" type="text" class="input"/>
                    <ErrorMessage v-if="form.errors.street" :error="form.errors.street"></ErrorMessage>
                </div>

                <div class="col-span-2">
                    <label class="label">Street Nr</label>
                    <input v-model="form.street_nr" type="text" class="input"/>
                    <ErrorMessage v-if="form.errors.street_nr" :error="form.errors.street_nr"></ErrorMessage>
                </div>

                <div class="col-span-6">
                    <label class="label">Price</label>
                    <input v-model.number="form.price" type="text" class="input"/>
                    <ErrorMessage v-if="form.errors.price" :error="form.errors.price"></ErrorMessage>
                </div>

                <div class="col-span-6">
                    <button type="submit" class="btn-primary">Create</button>
                </div>
            </div>
        </form>
</template>

<style scoped>
label {
    margin-right: 2em;
}

div {
    padding: 2px
}
</style>
