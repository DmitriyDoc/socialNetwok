<template>
    <div class="w-96 mx-auto">
        <input v-model="email" type="email" placeholder="email"  class="w-96 p1 mb2 border border-inherit rounded-lg">
        <input v-model="password" type="password" placeholder="password"  class="w-96 p1 mb2 border border-inherit rounded-lg">
        <input @click.prevent="login" type="submit" value="login" placeholder="login"  class="block float-right mx-auto w32 p-1 bg-sky-400 text-white rounded-lg">
    </div>
</template>

<script>
    export default {
        name: "Login.vue",
        data() {
            return {
                email: null,
                password: null,
            }
        },
        methods: {
            login() {
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.post('/login',{email: this.email, password: this.password})
                    .then(res => {
                        localStorage.setItem('x_xsrf_token',res.config.headers['X-XSRF-TOKEN']);
                        this.$router.push({name:'user.personal'});
                    }).catch( err => {
                        console.log(err);
                    })
                });
            }
        }
    }
</script>

<style scoped>

</style>
