<script setup>
defineProps(['stories']);
</script>

<template>
    <Link :href="$route('story.new')" class="btn btn-primary">
        Add your story
    </Link>

    <div v-if="$page.props.flash.success" class="alert alert-success">
        {{ $page.props.flash.success }}
    </div>

    <div
        v-if="stories.data"
        v-for="story in stories.data"
    >
        <p v-html="story.story"></p>
        <small>- {{ story.author }} on {{ story.date }}</small>
    </div>
</template>
