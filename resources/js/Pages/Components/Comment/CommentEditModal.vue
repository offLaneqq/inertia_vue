<script setup>

import { useForm } from '@inertiajs/vue3';
import { watch } from 'vue';

const props = defineProps({
    show: Boolean, // прапор, чи показувати модальне вікно
    text: String,  // текст, що відображатиметься
    post: Object,   // об'єкт поста
    commentId: Number,
    comment: Object
})

const emit = defineEmits(['close']) // Оголошуємо подію `close`

const form = useForm({
    content: '',
    comment_id: String(props.commentId)
})

const submit = () => {
    form.put(route('update_comment', { 'post_id': String(props.post.id) }), {
        data: {
            content: form.content,
            comment_id: form.comment_id,
        },
        onSuccess: () => {
            emit('close'); // Відправляємо подію `close`
        }
    })
}

// Відстежуємо зміни у props.comment і оновлюємо форму
watch(() => props.comment, (newComment) => {
    if (newComment && newComment.content) {
        form.content = newComment.content;
    }
}, { immediate: true });

const handleClickOutside = (event) => {
    if (event.target.classList.contains('modal-overlay')) {
        emit('close');
    }
};

</script>

<template>
    <div v-if="show" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 modal-overlay" @click="handleClickOutside">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">

            <h3 class="text-lg font-semibold">{{ text }}</h3>

            <form class="mb-6" @submit.prevent="submit">
                <div class="mb-4 bg-white rounded-lg rounded-t-lg border">
                    <label for="comment" class="sr-only">Your comment</label>
                    <textarea id="comment" rows="6" v-model="form.content"
                        class="px-3 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none"
                        placeholder="Write a comment..." required></textarea>
                </div>

                <div class="float-right">
                    <button type="submit" class="mr-2 bg-blue-500 text-white px-4 py-2 rounded">
                        Update
                    </button>

                    <button @click="$emit('close')" class="bg-red-500 text-white px-4 py-2 rounded">
                        Close
                    </button>
                </div>
            </form>


        </div>
    </div>
</template>