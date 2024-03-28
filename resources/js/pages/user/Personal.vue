<template>
    <div class="w-96 mx-auto">
        <form>
            <div>
                <input v-model="title" class="w-96 mb-3 rounded-3xl border p-2 border-slate-300" type="text" placeholder="title">
            </div>
            <div>
                <textarea v-model="content" class="w-96 mb-3 rounded-3xl border p-2 border-slate-300" placeholder="content"> </textarea>
            </div>
            <div class="flex mb-3 items-center">
                <div>
                    <input @change="storeImage" type="file" ref="file" class="hidden">
                    <a href="#" class="block p-2 text-sm mb-3 rounded-3xl border p-2 border-slate-300 bg-sky-600 text-white hover:bg-white hover:border hover:border-green-600 hover:text-green-600 box-border" @click.prevent="selectFile()">Image</a>
                </div>
                <div>
                    <a href="#" class="block p-2 ml-2 text-sm mb-3 rounded-3xl border p-2 border-slate-300 bg-gray-600 text-white hover:bg-white hover:border hover:border-green-600 hover:text-green-600 box-border" @click.prevent="image=null">Cancel</a>
                </div>
            </div>
            <div v-if="image" >
                <img :src='image.url' alt="preview">
            </div>
            <div>
                <a href="#" @click="store" class="block p-2 w-32 text-center mb-3 ml-auto rounded-3xl border p-2 border-slate-300 bg-green-600 text-white hover:bg-white hover:border hover:border-green-600 hover:text-green-600 box-border">Publish</a>
            </div>
        </form>
        <div v-if="posts">
            <div class="mb-4 pb-4 border-b border-gray-300">Posts</div>
            <div v-for="post in posts" class="mb-4 pb-4 border-b border-gray-300">
                <h1 class="text-xl">{{post.title}}</h1>
                <img class="mx-auto" v-if="post.image_url" :src="post.image_url" :alt="post.title">
                <p>{{post.content}}</p>
                <p class="mt-2 text-right text-sm">{{post.date}}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Personal",
        data(){
            return {
                content: '',
                title: '',
                image: null,
                posts: [],
            }
        },
        mounted() {
            this.getPosts();
        },
        methods: {
            getPosts(){
                axios.get('/api/posts')
                    .then(res => {
                        this.posts = res.data.data;
                    });
            },
            store(){
                const id =  this.image ?  this.image.id : null;
                axios.post('/api/posts',{
                    content: this.content,
                    title: this.title,
                    image_id: id
                }).then( res => {
                    this.content ='';
                    this.title = '';
                    this.image = null;
                    this.posts.unshift(res.data.data);
                })
            },
            selectFile() {
                this.fileInput = this.$refs.file;
                this.fileInput.click();
            },
            storeImage(e) {
                const file = e.target.files[0];
                const formData = new FormData();
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data',

                    }
                }
                formData.append('image', file);

                axios.post('/api/post_images', formData, config)
                    .then( res => {
                        this.image = res.data.data;
                    });


            }
        }
    }
</script>

<style scoped>

</style>
