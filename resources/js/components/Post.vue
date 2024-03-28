<template>
    <div class="mb-4 pb-4 border-b border-gray-300">
        <h1 class="text-xl">{{post.title}}</h1>
        <img class="mx-auto" v-if="post.image_url" :src="post.image_url" :alt="post.title">
        <p>{{post.content}}</p>
        <p class="mt-2 text-right text-sm">{{post.date}}</p>
    </div>
</template>

<script>
    export default {
        name: "Post",
        props: [
            'post'
        ],
    }
</script>

<style scoped>

</style>
