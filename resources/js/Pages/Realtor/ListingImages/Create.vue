<script setup>
    import {useForm, Link} from "@inertiajs/vue3";
    import {computed} from "vue";
    import NProgress from 'nprogress'
    import { router } from '@inertiajs/vue3'
    import Box from "@/Pages/Components/UI/Box.vue";

    const form = useForm(
        {
            images: []
        }
    );

    const props = defineProps({
        listing: Object,

    });

    const imageErrors = computed(() => Object.values(form.errors))

    const canUpload = computed(() => form.images.length)
    const upload = () => {
        form.post(
            route('realtor.listing.image.store', { listing: props.listing.id }),
            {
                onSuccess: () => form.reset('images'),
            },
        )
    }

    const addFiles = (event) => {
        for (const image of event.target.files) {
            form.images.push(image)
        }
    }
    const reset = () => form.reset('images')

    router.on('progress', (event) => {
        if (event.detail.progress.percentage) {
            NProgress.set((event.detail.progress.percentage / 100) * 0.9)
        }
    })
</script>

<template>
    <Box >
        <template #header>Upload images</template>
<!--        <form enctype="multipart/form-data" method="post" :action="route('realtor.listing.image.store', {listing: listing.id})">-->
        <form @submit.prevent="upload">
<!--            <input type="file" multiple name="images[]" >-->
<!--            <button type="submit" name="files">Send</button>-->
            <section class="flex items-center gap-2 my-4">
                <input
                    class="border rounded-md file:px-4 file:py-2 border-gray-200 dark:border-gray-700 file:text-gray-700 file:dark:text-gray-400 file:border-0 file:bg-gray-100 file:dark:bg-gray-800 file:font-medium file:hover:bg-gray-200 file:dark:hover:bg-gray-700 file:hover:cursor-pointer file:mr-4"
                    type="file" multiple @input="addFiles"
                />
                <button
                    type="submit"
                    class="btn-outline disabled:opacity-25 disabled:cursor-not-allowed"
                    :disabled="!canUpload"
                >
                    Upload
                </button>
                <button
                    type="reset" class="btn-outline"
                    @click="reset"
                >
                    Reset
                </button>
            </section>
            <div v-if="imageErrors.length" class="input-error">
                <div v-for="(error, index) in imageErrors" :key="index">
                    {{ error }}
                </div>
            </div>
        </form>
    </Box>
    <Box v-if="listing.images.length" class="mt-4">
        <template #header>Currently listing images</template>
        <section class="mt-4 grid grid-cols-3 gap-4">
            <div v-for="image in listing.images" :key="image.id" class="flex flex-col justify-between">
                <img :src="image.src" alt="" class="rounded-b-md">
                <Link :href="route('realtor.listing.image.destroy', {listing: props.listing.id, image: image.id})" class="mt-2 btn-outline text-xs" method="delete" as="button">Delete</Link>
            </div>

        </section>
    </Box>

</template>

<style scoped>

</style>
