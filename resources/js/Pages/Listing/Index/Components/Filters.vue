<script setup>

import {useForm} from '@inertiajs/vue3';
import {computed} from "vue";

const props = defineProps({
    filters: {
        type: Object, // Default to an empty object if filters is not provided
    },
});

const filterForm = useForm(() => ({
    priceFrom: props.filters?.priceFrom ?? null,
    priceTo: props.filters?.priceTo ?? null,
    areaFrom: props.filters?.areaFrom ?? null,
    areaTo: props.filters?.areaTo ?? null,
    beds: props.filters?.beds ?? null,
    baths: props.filters?.baths ?? null,
}));


const filter = () =>{
    filterForm.get(
        route('listing.index'),
        {
            preserveState: true,
            preserveScroll: true
        }
    )
}

const clear = () => {
        filterForm.priceFrom= null;
        filterForm.priceTo= null;
        filterForm.areaFrom= null;
        filterForm.areaTo= null;
        filterForm.beds= null;
        filterForm.baths= null;
        filter()
}

</script>

<template>
    <form @submit.prevent="filter">
        <div class="mt-8 mb-4 flex flex-wrap gap-2">
            <div class="flex flex-nowrap items-center">
                <input type="text"
                       name=""
                       id=""
                       placeholder="Price from"
                       class="input-filter-l w-28"
                       v-model.number="filterForm.priceFrom"
                >
                <input type="text"
                       name=""
                       id=""
                       placeholder="Price to"
                       class="input-filter-r w-28"
                       v-model.number="filterForm.priceTo">
            </div>
            <div class="flex flex-nowrap items-center">
                <select name="" id="" class="input-filter-l w-28" v-model="filterForm.beds">
                    <option  :value="null">Beds</option>
                    <option v-for="n in 5" :key="n" :value="n">{{n}}</option>
                    <option value="6+"></option>
                </select>
                <select name="" id="" class="input-filter-r w-28" v-model="filterForm.baths">
                    <option  :value="null">Baths</option>
                    <option v-for="n in 5" :key="n" :value="n">{{n}}</option>
                    <option value="6+"></option>
                </select>

            </div>
            <div class="flex flex-nowrap items-center">
                <input type="text"
                       name=""
                       id=""
                       placeholder="Area from"
                       class="input-filter-l w-28"
                       v-model.number="filterForm.areaFrom">
                <input type="text"
                       name=""
                       id=""
                       placeholder="Area to"
                       class="input-filter-r w-28"
                       v-model.number="filterForm.areaTo">
            </div>
            <button type="submit" class="btn-normal">Filter</button>
            <button type="button" @click="clear">Clear</button>
        </div>
    </form>

</template>

<style scoped>

</style>
