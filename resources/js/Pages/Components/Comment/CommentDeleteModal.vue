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
    comment_id: String(props.commentId)
})

const submit = () => {
    form.delete(route('delete_comment', { 'post_id': String(props.post.id), comment_id: form.comment_id }), {
        onSuccess: () => {
            emit('close'); // Відправляємо подію `close`
        }
    })
}

const handleClickOutside = (event) => {
    if (event.target.classList.contains('modal-overlay')) {
        emit('close');
    }
};

</script>

<template>
    <div v-if="show" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 modal-overlay"
        @click="handleClickOutside"
        >
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">

            <h3 class="text-lg font-semibold">Are you sure you want to delete this comment?</h3>

            <form class="mb-6" @submit.prevent="submit">

                <div class="float-right">
                    <button type="submit" class="mr-2 bg-blue-500 text-white px-4 py-2 rounded">
                        Delete
                    </button>

                    <button type="button" @click.prevent="$emit('close')" class="bg-red-500 text-white px-4 py-2 rounded">
                        Cancel
                    </button>
                </div>
            </form>


        </div>
    </div>
</template>