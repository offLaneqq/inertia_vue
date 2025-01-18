<script setup>

const props = defineProps({
    user: null,
    post: null,
    comments: null
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

    <div class="comments-block" v-for="comment in comments">
        <div class="comment-author" >
            {{ comment.user.name }}
        </div>
        <div class="comment-body" > 
            {{ comment.content }}
        </div>
    </div>

</template>