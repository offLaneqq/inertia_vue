<script setup>

import { usePage } from '@inertiajs/vue3';
import CommentItem from './CommentItem.vue';
import { useForm } from '@inertiajs/vue3';

const page = usePage();

const form = useForm({
    content: '',
});


</script>

<template>

    <section class=" py-8 lg:py-16 antialiased">
        <div class="max-w-2xl mx-auto px-4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg lg:text-2xl font-bold">
                    Comments (
                        <!-- {{ comments.length }} -->
                        )
                </h2>
            </div>

            <form class="mb-6" @submit.prevent="submit(post)">

                <div class="mb-4 bg-white rounded-lg rounded-t-lg border">
                    <label for="comment" class="sr-only">Your comment</label>
                    <textarea id="comment" rows="6" v-model="form.content" @keyup="inputKeyUp($event, post)"
                        class="px-3 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none"
                        placeholder="Write a comment..." required></textarea>
                </div>

                <button type="submit"
                    class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center bg-gray-300 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                    Post comment
                </button>

            </form>

            <div>
                <CommentItem v-for="comment in $page.props.parent_comments.slice().reverse()" :key="comment.id"
                    :comment="comment" :post="$page.props.post" :idAuth="$page.props.idAuth" />
            </div>
        </div> -->
    </section>

</template>