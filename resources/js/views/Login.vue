<template>
<div class="h-full bg-primary">
    <form class="justify-content-center row " style="height:100%" @submit.prevent="Login">
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="py-4"></div>
            <div class="py-4"></div>
            <div class="py-4"></div>
            <h1 class="text-white text-center">ログイン</h1>
            <div class="card card-body shadow-sm border-0">
                <div class="form-group">
                    <label for="email">ID(メールアドレス)</label>
                    <input type="email" :disabled="loading" name="email" id="email" class="form-control"  v-model="user.email">
                </div>
                <div class="form-group">
                    <label for="password">パスワード</label>
                    <input type="password" :disabled="loading" name="password" id="password" class="form-control" v-model="user.password">
                </div>
                <div class="form-group">
                <transition name="fade">
                    <div class="w-full my-3">
                        <div class="py-3 px-1 text-red-600" v-if="error">
                            {{error}}
                        </div>
                    </div>
                </transition>
                <transition name="fade">
                    <div class="w-full my-3">
                        <div class="py-3 px-4 rounded text-red-200 bg-red-600" v-if="captures.length">
                            <ul>
                                <li v-for="(capture, index) in captures" :key="index">{{capture}}</li>
                            </ul>
                        </div>
                    </div>
                </transition>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-block btn-primary">ログイン</button>
                  <div class="py-2"></div>
                <router-link :disabled="loading" class="btn btn-block btn-sm btn-outline-primary" to="/join">新規登録はこちら</router-link>
                </div>
            </div>
           <router-link class="text-white text-center my-3" to="/forgot-password">パスワードをお忘れですか?</router-link>
        </div>
    </form>
</div>
</template>
<script>
export default {
    data() {
        return {
            loading:false,
            error:"",
            captures:[],
            user:{
                email:"",
                password:"",
            }
        }
    },
    watch: {
        user:{
            handler(){
                this.error = "";
                this.captures = [];
            },
            deep:true
        }
    },
    methods: {
        async Login(){
            let {user} = this;
            if(!user.email){
                this.error = "Please Enter your Email";
                return false;
            }
            if(!user.password){
                this.error = "Please Enter your password";
                return false;
            }
            this.loading = true;
            await this.$store.dispatch('Login',this.user)
                    .then(res=>{
                        this.$store.commit('Error','Welcome Back.')
                        this.$router.push('/')
                    })
                    .catch(error=>{
                        let errors = [];
                        if(error.response){
                            if(error.response.status == 422){
                                this.errors = error.response.data.errors;
                            }
                            if(error.response.status == 401){
                               if(error.response.data.error == 'invalid_credentials'){
                                    errors.push('Username and or Password is Incorrect.')
                               }
                            }

                        }
                        this.captures= errors;
                    })
                    .then(()=>{
                        this.loading = false;
                    })

        }
    },
}
</script>
