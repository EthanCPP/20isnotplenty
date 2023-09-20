<script setup>
import AppHead from "../AppHead.vue";
</script>

<template>
    <img src="./../../images/bg.jpg" class="bg-image" />
    <AppHead></AppHead>

    <div class="main">
        <img src="./../../images/tinp_logo.png" class="tinp-logo" />

        <div class="container">
            <div class="main__inner">
                <slot />
            </div>
        </div>
    </div>
</template>
