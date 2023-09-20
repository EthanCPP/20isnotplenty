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
    <h3 class="my-3">Over 300,000 of us have signed a petition calling for the Welsh Government to rescind the new blanket 20mph law that came into effect on 17th September 2023. Even though this petition has gained record-breaking signatures in such a short period of time, it seems the Welsh Government has no interest in listening to us. Perhaps we need to speak louder about how this new law is affecting our day-to-day lives.</h3>

    <Link :href="$route('story.new')" class="btn btn-primary btn-lg mt-4 mb-5">
        Click here to add your story
    </Link>

    <div v-if="$page.props.flash.success" class="alert alert-success">
        {{ $page.props.flash.success }}
    </div>

    <div
        v-if="stories.data"
        v-for="story in stories.data"
        class="story"
    >
        <p v-html="story.story" class="story__content"></p>
        <small>- {{ story.author }} on {{ story.date }}</small>

        <div class="story__like">
            <button
                v-if="likedStories.includes(story.id)"
                type="button"
                @click="unlike(story.id)"
                class="btn story__like-button"
            >
                <img src="./../../images/thumbsup-fill.png" />
            </button>
            <button
                v-else
                type="button"
                @click="like(story.id)"
                class="btn story__like-button"
            >
                <img src="./../../images/thumbsup.png" />
            </button>

            {{ story.likes + (likedStories.includes(story.id) ? (story.visitorLikes ? 0 : 1) : (story.visitorLikes ? -1: 0)) }}
        </div>
    </div>
</template>
