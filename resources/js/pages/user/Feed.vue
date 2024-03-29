<template>
    <div class="w-96 mx-auto">
        <div v-if="posts">
            <div class="mb-4 pb-4 border-b border-gray-300">Posts</div>
            <Post v-for="post in posts" :post="post"></Post>
        </div>
    </div>
</template>

<script>
    import Post from "../../components/Post.vue";

    export default {
        name: "Feed",
        components: {Post},
        data() {
            return {
                posts: [],
            }
        },
        mounted() {
            this.getPosts();
        },
        methods: {
            getPosts() {
                axios.get(`/api/users/following_posts`)
                    .then(res => {
                        this.posts = res.data.data;
                    });
            },
        }
    }
</script>

<style scoped>

</style>
