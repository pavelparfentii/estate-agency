<script setup>
import {Link, useForm} from "@inertiajs/vue3";

const form = useForm({
    email: null,
    name: null,
    password: null,
    password_confirmation: null,
})

const register = () => form.post(route("user-account.store"))
</script>

<template>
    <form  @submit.prevent="register">
        <div class="w-1/2 mx-auto">
            <div class="mt-4">
                <label for="name" class="label">Enter your name</label>
                <input type="text" id="name" name="name" placeholder="Your name" class="input"  v-model="form.name"/>
                <div class="input-error" v-if="form.errors.name">{{form.errors.name}}</div>
            </div>
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
                <label for="password_confirmation" class="label">Confirm password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" class="input" v-model="form.password_confirmation"/>
                <div class="input-error" v-if="form.errors.password_confirmation">{{form.errors.password_confirmation}} </div>
            </div>
            <div class="mt-4">
                <button class="w-full btn-primary" type="submit">Create Account</button>
                <div class="mt-2 text-center">
                    <Link :href="route('login')" class="text-sm text-gray-500"> Already have an account? Click here</Link>
                </div>
            </div>
        </div>
    </form>
</template>

<style scoped>

</style>
