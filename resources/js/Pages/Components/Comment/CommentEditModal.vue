<script setup>
const props = defineProps({
    show: Boolean, // прапор, чи показувати модальне вікно
    text: String,  // текст, що відображатиметься
})



</script>

<template>
    <div v-if="show" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
            <h3 class="text-lg font-semibold">{{ text }}</h3>
            <button 
            @close="show = false" 
            class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">
                Close
            </button>
        </div>
    </div>
</template>