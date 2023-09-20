<script setup>
import { ref, onMounted } from 'vue';

import axios from "axios";

const props = defineProps(['stories']);

const likedStories = ref([]);

function like(storyId) {
    axios.post(`/story/${storyId}/like`).then(function(resp) {
        if (resp.data == 'done') {
            if (!likedStories.value.includes(storyId)) {
                likedStories.value.push(storyId);
            }
        }
    });
}

function unlike(storyId) {
    axios.post(`/story/${storyId}/unlike`).then(function(resp) {
        if (resp.data == 'done') {
            const storyIndex = likedStories.value.indexOf(storyId);

            if (storyIndex !== -1) {
                likedStories.value.splice(storyIndex, 1);
            }
        }
    });
}

onMounted(() => {
    const stories = props.stories.data;

    if (stories) {
        stories.forEach((story) => {
            if (story.visitorLikes) {
                likedStories.value.push(story.id);
            }
        });
    }
});
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

        <div>
            <button
                v-if="likedStories.includes(story.id)"
                type="button"
                @click="unlike(story.id)"
            >
                Unike
            </button>
            <button
                v-else
                type="button"
                @click="like(story.id)"
            >
                Like
            </button>

            {{ story.likes + (likedStories.includes(story.id) ? (story.visitorLikes ? 0 : 1) : (story.visitorLikes ? -1: 0)) }}
        </div>
    </div>
</template>
