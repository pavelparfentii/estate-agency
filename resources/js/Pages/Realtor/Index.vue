<script setup>
    import Box from "@/Pages/Components/UI/Box.vue";
    import Price from "@/Pages/Components/UI/Price.vue";
    import ListingSpace from "@/Pages/Components/UI/ListingSpace.vue";
    import ListingComponent from "@/Pages/Components/ListingComponent.vue";
    import {Link} from "@inertiajs/vue3";
    import RealtorFilters from "@/Pages/Realtor/Index/Components/RealtorFilters.vue";
    import Pagination from "@/Pages/Components/UI/Pagination.vue";
    import EmptyState from "@/Pages/Components/UI/EmptyState.vue";

    defineProps({
        listings: Object,
        filters: Object
    })
</script>

<template>
    <h1 class="text-2xl mb-4">Your listings</h1>
    <section class="mb-4">
        <RealtorFilters :filters="filters"/>

    </section >
    <section v-if="listings.data.length" class="grid grid-cols-1 lg:grid-cols-2 gap-2">
        <Box v-for="listing in listings.data" :key="listing.id" :class="{'border-dashed':  listing.deleted_at}">
            <div class="flex flex-col md:flex-row gap-2 md:items-center justify-between">
                <div :class="{'opacity-25': listing.deleted_at}">
                    <div v-if="listing.sold_at != null" class="text-sm font-bold uppercase border border-dashed p-1 border-green-200 text-green-500 dark:border-green-500 dark:text-green-700 inline-block rounded-md mb-2">sold</div>
                    <div class="xl:flex items-center gap-2"></div>
                    <Price :price="listing.price"  class="text-2xl font-medium" />
                    <ListingSpace :listing="listing" />
                    <ListingComponent :listing="listing" class="text-gray-500"/>
                </div>
                <section>
                    <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                        <a class="btn-outline text-xs font-medium" :href="route('listing.show', {listing: listing.id})" target="_blank">Preview</a>
                        <Link class="btn-outline text-xs font-medium" :href="route('realtor.listing.edit', {listing: listing.id})">Edit</Link>
                        <Link v-if="!listing.deleted_at"
                              class="btn-outline text-xs font-medium" :href="route('realtor.listing.destroy', {listing: listing.id})" as="button" method="DELETE">Delete</Link>
                        <Link v-else
                              class="btn-outline text-xs font-medium" :href="route('realtor.listing.restore', {listing: listing.id})" as="button" method="PUT">Restore</Link>
                    </div>
                    <div class="mt-2">
                        <Link :href="route('realtor.listing.image.create', {listing: listing.id})" as="button" class="block w-full btn-outline text-xs font-medium text-center">Images ({{listing.images_count}})</Link>
                    </div>

                    <div class="mt-2">
                        <Link :href="route('realtor.listing.show', {listing: listing.id})" as="button" class="block w-full btn-outline text-xs font-medium text-center">Offers ({{listing.offers_count}})</Link>
                    </div>
                </section>

            </div>
        </Box>

    </section>

    <EmptyState v-else>No listings yet</EmptyState>
    <section v-if="listings.data.length" class="w-full mt-4 mb-4 flex justify-center gap-2">
        <Pagination :links="listings.links"/>
    </section>

</template>

<style scoped>

</style>
