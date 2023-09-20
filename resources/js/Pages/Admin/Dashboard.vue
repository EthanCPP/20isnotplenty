<script setup>
defineProps(['stories']);
</script>

<template>
    <h1>Admin</h1>
    <Link :href="$route('home')" class="btn btn-primary btn-sm">Return home</Link>

    <div v-if="$page.props.flash.success" class="my-3 alert alert-success">
        {{ $page.props.flash.success }}
    </div>

    <div class="mt-5">
        <div
            v-if="stories.data"
            v-for="story in stories.data"
            class="py-3"
        >
            <p v-html="story.story"></p>
            <small>- {{ story.author }} on {{ story.date }}</small>

            <div class="mt-3 d-flex gap-3">
                <Link :href="$route('admin.approve', { story: story.id })" method="post" class="btn btn-success btn-sm">Approve</Link>
                <Link :href="$route('admin.reject', { story: story.id })" method="post" class="btn btn-danger btn-sm">Reject</Link>
            </div>
        </div>
    </div>
</template>
