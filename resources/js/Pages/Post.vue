<script setup>
import Comments from './Components/Comments.vue'

const props = defineProps({
    user: null,
    post: null,
    comments: null,
    idAuth: null
})

</script>

<template>

    <Head :title="$page.component" />

    <div class="wrapper">
        <div>
            <div class="card">
                <h3 class="card-author">
                    {{ user.name }}
                </h3>
                <p class="content">{{ post.content }}</p>
            </div>
        </div>
    </div>

    <div class="comments-block" >
        <!-- <Comments :author="comment.user.name" :comment="comment.content" /> -->
        <Comments :comments="comments" :post="post" :idAuth="idAuth" />
    </div>

</template>