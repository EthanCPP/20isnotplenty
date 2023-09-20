<script setup>
import { Head } from "@inertiajs/vue3"

defineProps({
    title: String,
});

let pageTitle = "20 is not plenty";
</script>

<template>
    <Head :title="title ? `${title} | ${pageTitle}` : pageTitle">
        <slot />
    </Head>
</template>
