<script setup>

import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import CommentSetting from './CommentSetting.vue';

const props = defineProps({
    author: null,
    comment: null,
    date: null,
    idAuth: null,
    avatar: null,
    post: null,
    child_comments: null
})

const replyOpen = ref(false);

const form = useForm({
    content: null,
    parent_id: null
})

// format data
const getDate = (date) =>
    new Date(date).toLocaleDateString("en-us", {
        year: "numeric",
        month: "long",
        day: "numeric"
    })

const dropdownOpen = ref({});

const toggleDropdown = (commentId) => {
    dropdownOpen.value[commentId] = !dropdownOpen.value[commentId];
};

const toggleReply = () => {
    form.parent_id = props.comment.id;
    replyOpen.value = !replyOpen.value;
};

const postComment = (post) => {
    form.post(route('add_comment', { 'post_id': post.id }))
    replyOpen.value = false;
    form.reset('content')
};

</script>


<template>

    <article class="p-3 text-base rounded-lg">
        <footer class="flex justify-between items-center mb-2">
            <div class="flex items-center">

                <p class="inline-flex items-center mr-3 text-sm text-gray-900 font-semibold">
                    <img class="mr-2 w-6 h-6 rounded-full" :src="avatar">
                    {{ author }}
                </p>

                <p v-if="comment.parent" class="text-sm text-gray-600">
                    Replying to: {{ comment.parent.user.name }}
                </p>

                {{ child_comments }}

                <p class="text-sm text-gray-600">
                    {{ getDate(date) }}
                </p>
            </div>
            <button @click="toggleDropdown(comment.id)" id="dropdownComment1Button"
                data-dropdown-toggle="dropdownComment1"
                class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 dark:text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 "
                type="button">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 16 3">
                    <path
                        d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                </svg>
                <span class="sr-only">Comment settings</span>
            </button>
        </footer>
        <!-- Need add dropdown menu -->
        <div v-if="dropdownOpen[comment.id]"
            class="relative flex float-right justify-center w-36 py-2 bg-white rounded-lg shadow dark:bg-gray-700">

            <div class="flex" v-if="idAuth === comment.user_id">
                <CommentSetting text="Edit" :post="post" :commentId="comment.id" :comment="comment" />
                <CommentSetting text="Delete" :post="post" :commentId="comment.id" :comment="comment" />
            </div>
            <div class="flex" v-else>
                <CommentSetting text="Report" />
            </div>

        </div>
        <p class="text-gray-600 whitespace-pre-wrap text-pretty">{{ comment.content }}</p>

        <form @submit.prevent="postComment(post)">
            <div class="flex items-center mt-4 space-x-4">

                <button type="button" @click="toggleReply"
                    class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400 font-medium">
                    <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z" />
                    </svg>
                    Reply
                </button>

            </div>
            <div v-if="replyOpen" class="mt-4">
                <textarea v-model="form.content"
                    class="w-full h-24 p-2 text-sm text-gray-600 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-200"
                    placeholder="Write a comment..."></textarea>
                <div class="flex justify-end mt-2">
                    <button type="submit"
                        class="px-4 py-2 text-sm text-white bg-gray-800 rounded-lg hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-50">
                        Comment
                    </button>
                </div>
            </div>
        </form>
    </article>

</template>