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

     <p v-if="$page.props.flash.greet" class="p-4 bg-red-200">{{ $page.props.flash.greet }}</p>
    
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
        <Comments :comments="comments" :post="post" :idAuth="idAuth" />
    </div>

</template>