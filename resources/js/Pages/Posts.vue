<script setup>

import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    users: null,
    isAuth: null
})

const form = useForm({
    content: null
})

const submit = () => {
    form.post(route('create'))
    form.reset('content')
}


</script>

<template>

    <Head :title="$page.component" />

    <h1>Posts</h1>

    <form @submit.prevent="submit" v-if="isAuth">
        
        <div class="write-post flex">
            
            <textarea placeholder="write your thoughts here" v-model="form.content"></textarea>
            <button>Share</button>
    
        </div>

    </form>

    <div class="wrapper">
        <div v-for="user in props.users" :key="user.id">
            <div class="card" v-for="post in user.posts.slice().reverse()">
                <h3 class="card-author">{{ user.name }}</h3>
                <p class="content">{{ post.content }}</p>
            </div>
        </div>
    </div>

</template>