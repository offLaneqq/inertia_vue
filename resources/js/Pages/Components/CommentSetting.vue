<script setup>

import CommentEditModal from './Comment/CommentEditModal.vue';
import { ref } from 'vue';

const props = defineProps({
    text: String,
})

const showModal = ref(false)

const openModal = () => {
    showModal.value = true;
}


</script>


<template>

    <button @click="openModal"
        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600">
        {{ text }}
    </button>

    <CommentEditModal :show="showModal" text="test" @close="showModal = false" />

</template>