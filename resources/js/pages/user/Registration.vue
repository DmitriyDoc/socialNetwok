<template>
    <form class="w-96 mx-auto">
        <div> <input v-model="name" type="text" placeholder="name" autocomplete="on" class="w-96 p1 mb2 border border-inherit rounded-lg"></div>
        <div> <input v-model="email" type="email" placeholder="email"  autocomplete="on" class="w-96 p1 mb2 border border-inherit rounded-lg"></div>
        <div> <input v-model="password" type="password" placeholder="password" autocomplete="on" class="w-96 p1 mb2 border border-inherit rounded-lg"></div>
        <div> <input v-model="password_confirmation" type="password" placeholder="password confirmation" autocomplete="on" class="w-96 p1 mb2 border border-inherit rounded-lg"></div>
        <input @click.prevent="register" type="submit" value="register" placeholder="login" class="block float-right mx-auto w32 p-1 bg-sky-400 text-white rounded-lg">
    </form>
</template>

<script>
    export default {
        name: "Registration.vue",
        data() {
            return {
                name: null,
                email: null,
                password: null,
                password_confirmation: null,
            }
        },
        methods: {
            register() {
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.post('/register',{
                        name: this.name,
                        email: this.email,
                        password: this.password,
                        password_confirmation: this.password_confirmation
                    })
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
