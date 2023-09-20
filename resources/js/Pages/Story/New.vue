<script setup>
import {useForm} from "@inertiajs/vue3";

const form = useForm({
    name: '',
    story: '',
});
</script>

<template>
    <div class="container">
        <Link :href="$route('home')" class="btn btn-primary">Back to home</Link>

        <h1 class="mt-4 mb-5">Add your story</h1>

        <form @submit.prevent="form.post($route('story.new'))">
            <div class="form-group mb-4">
                <label for="name" class="mb-1">Name</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    v-model="form.name"
                    style="max-width: 200px;"
                    class="form-control" />
                <p><small>Leave blank to remain anonymous</small></p>

                <small
                    v-if="form.errors.name"
                    class="text-danger mt-1 d-block"
                >
                    {{ form.errors.name }}
                </small>
            </div>

            <div class="form-group mb-4">
                <label for="story" class="mb-1">What's your story?</label>
                <textarea
                    name="story"
                    id="story"
                    rows="10"
                    v-model="form.story"
                    class="form-control"></textarea>

                <small
                    v-if="form.errors.story"
                    class="text-danger mt-1 d-block"
                >
                    {{ form.errors.story }}
                </small>
            </div>

            <input type="submit" value="Submit" class="btn btn-primary mt-4" :disabled="form.processing" />

            <p class="mt-4">
                <small>Your story will require approval before appearing live, this is to prevent spam.</small>
            </p>
        </form>
    </div>
</template>
