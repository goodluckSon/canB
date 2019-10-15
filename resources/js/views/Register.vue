<template>
    <div class="h-full bg-primary">
    <form class="justify-content-center row " style="height:100%" @submit.prevent="Register">
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="py-4"></div>
            <h1 class="text-white text-center">登録</h1>
            <div class="card card-body shadow-sm border-0">
                <div class="form-group">
                    <label for="name">名前</label>
                    <input type="text" :disabled="loading" name="name" id="name" class="form-control"  v-model="user.name">
                </div>
                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <input type="email" :disabled="loading" name="email" id="email" class="form-control"  v-model="user.email">
                </div>
                <div class="form-group">
                    <label for="password">パスワード</label>
                    <input type="password" :disabled="loading" name="password" id="password" class="form-control" v-model="user.password">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">確認用パスワード</label>
                    <input type="password" :disabled="loading" name="password_confirmation" id="password_confirmation" class="form-control" v-model="user.password_confirmation">
                </div>
                <div class="form-group">
                <transition name="fade">
                    <div class="alert alert-danger my-0" v-if="PasswordConfirmationValidation">
                        Your password and Password confirmation doensnt match
                    </div>
                </transition>
                <transition name="fade">
                    <div class="alert alert-danger my-0"  v-if="error">
                        {{error}}
                    </div>
                </transition>
                <transition name="fade">
                    <div class="alert alert-danger my-0"   v-if="captures.length">
                        <ul>
                            <li v-for="(capture, index) in captures" :key="index">{{capture}}</li>
                        </ul>
                    </div>
                </transition>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-block btn-primary">登録</button>
                  <div class="py-1"></div>
                <router-link :disabled="loading" class="btn btn-block btn-sm btn-outline-primary" to="/login">ログインはこちら</router-link>
                </div>
            </div>
        </div>
    </form>
    </div>
</template>
<script>
export default {
    data() {
        return {
            loading:false,
            error:null,
            captures:[],
            user:{
                name:"",
                email:"",
                password:"",
                password_confirmation:"",
            }
        }
    },
    computed:{
        PasswordConfirmationValidation(){
            let {user} = this;
            if(user.password && user.password_confirmation)
            return user.password !== user.password_confirmation?true:false;
            else
            return false;
        },
    },
    watch: {
        user:{
            handler(){
                this.error = null;
                this.captures = [];
            },
            deep:true
        }
    },
    methods: {
        async Register(){
            let {user} = this;
            if(!user.name || !user.email || !user.password || !user.password_confirmation){
                this.error = "Please Check all the fields before submitting.";
                return false;
            }
            this.loading = true;
            await this.$store.dispatch('Register',this.user)
                    .then(res=>{
                        this.$store.commit('Error','Your Registration is Success. Please Login')
                        this.$router.push('/login')
                    })
                    .catch(error=>{
                        let errors = [];
                        if(error.response){
                            if(error.response.status == 422){
                                let eo = Object.values(error.response.data.errors);
                                eo.forEach(element => {
                                    errors.push(element[0])
                                });
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
