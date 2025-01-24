<script setup>
    import {useForm, Link} from "@inertiajs/vue3";

    const form = useForm({
        email: null,
        password: null,
    })

    const login = () => form.post(route("login"))
</script>

<template>
    <form  @submit.prevent="login">
        <div class="w-1/2 mx-auto">
            <div class="mt-4">
                <label for="email" class="label">Email (username)</label>
                <input type="email" id="email" name="email" placeholder="Email (username)" class="input"  v-model="form.email"/>
                <div class="input-error" v-if="form.errors.email">{{form.errors.email}}</div>
            </div>
            <div class="mt-4">
                <label for="password" class="label">Password</label>
                <input type="password" id="password" name="password" placeholder="Your Password" class="input" v-model="form.password"/>
                <div class="input-error" v-if="form.errors.password">{{form.errors.password}} </div>
            </div>
            <div class="mt-4">
                <button class="w-full btn-primary" type="submit">Login</button>

                <div class="mt-2 text-center">
                    <Link :href="route('user-account.create')" class="text-sm text-gray-500"> New account. Click here</Link>
                </div>
            </div>
        </div>
    </form>
</template>

<style scoped>

</style>
