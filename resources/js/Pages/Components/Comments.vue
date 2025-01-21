<script setup>

import CommentLayout from './CommentLayout.vue'
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    comments: null,
    post: null,
    idAuth: null
})

const form = useForm({
    content: null
})

const inputKeyUp = (event, post) => {
    if (event.key === 'Enter' && !event.shiftKey) { // Shift+Enter для нового рядка
        event.preventDefault();
        submit(post)
    }
}

const submit = (post) => {
    form.post(route('add_comment', {'post_id': post.id}))
    form.reset('content')
}



</script>

<template>

    <section class=" py-8 lg:py-16 antialiased">
        <div class="max-w-2xl mx-auto px-4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg lg:text-2xl font-bold">
                    Comments ({{ comments.length }})
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
            
            <div v-for="comment in comments.slice().reverse()">
                <CommentLayout :author="comment.user.name" :comment="comment" :date="comment.created_at"
                    :idAuth="idAuth" :avatar="comment.user.avatar" :post="post" />
            </div>


            <!-- Inner comment -->
            <!-- <article class="p-6 mb-3 ml-6 lg:ml-12 text-base bg-white rounded-lg dark:bg-gray-900">
                <footer class="flex justify-between items-center mb-2">
                    <div class="flex items-center">
                        <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">
                            <img class="mr-2 w-6 h-6 rounded-full"
                                src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="Jese Leos">Jese
                            Leos</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-12"
                                title="February 12th, 2022">Feb. 12, 2022</time></p>
                    </div>
                    <button id="dropdownComment2Button" data-dropdown-toggle="dropdownComment2"
                        class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 dark:text-gray-40 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                        type="button">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 16 3">
                            <path
                                d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                        </svg>
                        <span class="sr-only">Comment settings</span>
                    </button>
                </footer>
                <p class="text-gray-500 dark:text-gray-400">Much appreciated! Glad you liked it ☺️</p>
                <div class="flex items-center mt-4 space-x-4">
                    <button type="button"
                        class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400 font-medium">
                        <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 20 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z" />
                        </svg>
                        Reply
                    </button>
                </div>
            </article> -->
        </div>
    </section>

</template>