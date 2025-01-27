<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    comment: Object,
    post: Object,
    idAuth: Number
});

const replyOpen = ref(false);

const form = useForm({
    content: '',
    parent_id: null
});

const toggleReply = () => {
    replyOpen.value = !replyOpen.value;
    form.parent_id = props.comment.id;
};

const postComment = () => {
    form.post(route('add_comment', { post_id: props.post.id }))
        .then(() => {
            replyOpen.value = false;
            form.reset('content');
        });
};
</script>

<template>
    <div class="p-3 text-base rounded-lg">
        <footer class="flex justify-between items-center mb-2">
            <div class="flex items-center">
                <p class="inline-flex items-center mr-3 text-sm text-gray-900 font-semibold">
                    <img v-if="comment.user && comment.user.avatar" class="mr-2 w-6 h-6 rounded-full"
                        :src="comment.user.avatar">
                    {{ comment.user ? comment.user.name : 'Unknown User' }}
                </p>
                <p class="text-sm text-gray-600">
                    {{ new Date(comment.created_at).toLocaleDateString("en-us", {
                        year: "numeric", month: "long", day:
                    "numeric" }) }}
                </p>
            </div>
        </footer>
        <p class="text-gray-600 whitespace-pre-wrap text-pretty">{{ comment.content }}</p>
        <button type="button" @click="toggleReply"
            class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400 font-medium">
            <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 20 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z" />
            </svg>
            Reply
        </button>
        <div v-if="replyOpen" class="mt-4">
            <textarea v-model="form.content"
                class="w-full h-24 p-2 text-sm text-gray-600 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-200"
                placeholder="Write a comment..."></textarea>
            <div class="flex justify-end mt-2">
                <button type="button" @click="postComment"
                    class="px-4 py-2 text-sm text-white bg-gray-800 rounded-lg hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-50">
                    Post
                </button>
            </div>
        </div>
        <div v-if="comment.replies && comment.replies.length" class="mt-4 pl-4 border-l border-gray-300">
            <CommentItem v-for="reply in comment.replies" :key="reply.id" :comment="reply" :post="post"
                :idAuth="idAuth" />
        </div>
    </div>
</template>