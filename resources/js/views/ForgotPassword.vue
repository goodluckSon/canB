<template>
    <div class="flex justify-center content-center flex-wrap h-screen w-full bg-purple-700">
        <div class="md:flex bg-white rounded-lg p-6 shadow-md w-full  lg:w-1/3 md:w-1/2">
        <form class="w-full" @submit.prevent="ForgotPassword">

          <div class="text-center md:text-left w-full mb-4">
            <h2 class="text-2xl text-purple-400">Forgot Password?</h2>
          </div>

          <div class="w-full my-3">
            <input 
                class="bg-gray-300 focus:outline-none rounded-md py-2 px-4 block w-full appearance-none leading-normal" 
                type="email"
                v-model="user.email"
                placeholder="ID(メールアドレス)"/>
          </div>
          <transition name="fade">
            <div class="w-full my-3">
                <div class="py-3 px-4 rounded text-red-200 bg-red-600" v-if="captures.length">
                    <ul>
                        <li v-for="(capture, index) in captures" :key="index">{{capture}}</li>
                    </ul>
                </div>
            </div>
          </transition>          
          <div class="w-full my-3">
           <button 
                type="submit" 
                :class="{'text-white bg-gray-600':loading,'text-white bg-purple-600':!loading}"
                class="inline-block shadow-lg rounded-sm text-md px-4 py-2 leading-none  uppercase mt-4 lg:mt-0">
               ログイン 
           </button>
           <router-link class="text-purple-800 float-right" to="/login">Back</router-link>
          </div>
        </form>
        </div>
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
                email:"",
            }
        }
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
        async ForgotPassword(){
            this.loading = true;
            await this.$store.dispatch('Login',this.user)
                    .then(res=>{
                        this.$store.commit('Error','Your Password Reset Email has been send to your Email ID.')
                        this.$router.push('/')
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