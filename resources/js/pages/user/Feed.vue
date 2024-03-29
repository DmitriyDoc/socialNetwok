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
        name: "Show",
        components: {Post},
        data() {
            return {
                posts: [],
                user_id: this.$route.params.id,
            }
        },
        mounted() {
            this.getPosts();
        },
        methods: {
            getPosts() {
                axios.get(`/api/users/${this.user_id}/posts`)
                    .then(res => {
                        this.posts = res.data.data;
                    });
            },
        }
    }
</script>

<style scoped>

</style>
