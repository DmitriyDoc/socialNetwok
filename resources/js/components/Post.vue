<template>
    <div class="mb-4 pb-4 border-b border-gray-300">
        <h1 class="text-xl">{{post.title}}</h1>
        <img class="mx-auto" v-if="post.image_url" :src="post.image_url" :alt="post.title">
        <p>{{post.content}}</p>

        <div v-if="post.reposted_post" class="bg-gray-100 p-4 my-4 border  border-gray-300">
            <h1 class="text-xl">{{post.reposted_post.title}}</h1>
            <img class="mx-auto" v-if="post.reposted_post.image_url" :src="post.reposted_post.image_url" :alt="post.reposted_post.title">
            <p>{{post.reposted_post.content}}</p>
        </div>
        <div class="flex justify-between items-center">
            <div class="flex">
                <div class="flex">
                    <svg @click.prevent="toggleLike(post)" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                         :class="['mr-2 stroke-sky-500 cursor-pointer hover:fill-sky-500 w-6 h-6', post.is_liked ? 'fill-sky-500' : 'fill-white']">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                    </svg>
                    <p>{{post.likes_count}}</p>
                </div>
                <div class="flex">
                    <svg @click.prevent="openRepost()" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                         :class="['mr-2 stroke-sky-500 cursor-pointer hover:fill-sky-500 w-6 h-6 fill-white']">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                    </svg>
                </div>
            </div>
            <p class="mt-2 text-right text-sm">{{post.date}}</p>
        </div>
        <div v-if="is_repost" class="mt-4">
            <div>
                <input v-model="title" class="w-96 mb-3 rounded-3xl border p-2 border-slate-300" type="text" placeholder="title">
            </div>
            <div>
                <textarea v-model="content" class="w-96 mb-3 rounded-3xl border p-2 border-slate-300" placeholder="content"> </textarea>
            </div>
            <div>
                <a href="#" @click="repost(post)" class="block p-2 w-32 text-center mb-3 ml-auto rounded-3xl border p-2 border-slate-300 bg-green-600 text-white hover:bg-white hover:border hover:border-green-600 hover:text-green-600 box-border">Publish</a>
            </div>
        </div>
    </div>
</template>

<script>
    import router from "../router";

    export default {
        name: "Post",
        props: [
            'post'
        ],
        data() {
            return {
                title: '',
                content: '',
                is_repost: false,
                repostedId: null,
            }
        },
        methods: {
            toggleLike(post){
                axios.get(`/api/posts/${post.id}/liked`)
                    .then(res => {
                        post.is_liked = res.data.is_liked;
                        post.likes_count = res.data.likes_count;
                    });
            },
            repost(post) {
                if (this.isPersonal())return
                axios.post(`/api/posts/${post.id}/repost`, {title: this.title, content: this.content})
                .then( res => {
                   this.title = ''
                   this.content = ''
                });
            },
            openRepost() {
                if (this.isPersonal())return
                this.is_repost = !this.is_repost;
            },
            isPersonal() {
                return this.$route.name === 'user.personal';
            }
        },
    }
</script>

<style scoped>

</style>
