<script setup>

import CommentEditModal from './Comment/CommentEditModal.vue';
import CommentDeleteModal from './Comment/CommentDeleteModal.vue';
import { ref } from 'vue';

const props = defineProps({
    text: String,
    post: Object,
    commentId: Number,
    comment: Object
})

const showModal = ref(false)
const modalType = ref('');

const openModal = (type) => {
    modalType.value = type;
    showModal.value = true;
}


</script>


<template>
    <div class="z-0">
        <button @click="openModal(text)"
            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600">
            {{ text }}
        </button>
        <div v-if="modalType === 'Edit'">
            <CommentEditModal :show="showModal" text="Edit" @close="showModal = false" :post="post" :commentId="commentId" :comment="comment" />
        </div>
        <div v-else-if="modalType === 'Delete'">
            <CommentDeleteModal :show="showModal" text="Delete" @close="showModal = false" :post="post" :commentId="commentId" :comment="comment" />
        </div>
        <div v-else="modalType === 'Report'">

        </div>
    </div>

</template>