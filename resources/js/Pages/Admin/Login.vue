<script setup>
import {useForm} from "@inertiajs/vue3";

const form = useForm({
    email: '',
    password: '',
});
</script>

<template>
    <h1>Admin login</h1>

    <form @submit.prevent="form.post($route('admin.login'))">
        <div class="form-group mb-4">
            <label for="email" class="mb-1">Email</label>
            <input type="text" name="email" id="email" class="form-control" v-model="form.email" />

            <small
                v-if="form.errors.email"
                class="text-danger mt-1 d-block"
            >
                {{ form.errors.email }}
            </small>
        </div>

        <div class="form-group mb-4">
            <label for="password" class="mb-1">Password</label>
            <input type="password" name="password" id="password" class="form-control" v-model="form.password" />

            <small
                v-if="form.errors.password"
                class="text-danger mt-1 d-block"
            >
                {{ form.errors.password }}
            </small>
        </div>

        <input type="submit" class="btn btn-primary" value="Login" :disabled="form.processing" />
    </form>
</template>
