<template>
    <div class="bg-primary h-full py-4">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="card card-body">
                    <h6 class="">Admin Login</h6>
                    <form class="p-2" @submit.prevent="Login">
                        <div class="form-group">
                            <label for="user.username">Username</label>
                            <input 
                            type="text" 
                            v-model="user.user"
                            name="user.user" 
                            id="user.user" 
                            class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="user.password">Password</label>
                            <input 
                            type="password" 
                            v-model="user.password"
                            name="user.password" 
                            id="user.password" 
                            class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Login</button>                        
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            user:{
                user:"",
                password:""
            },
            cred:{
                image:"canb_add",
                canb_admin:"159047",
            }
        }
    },
    methods: {
        Login(){
            if(this.cred[this.user.user]){
                if(this.cred[this.user.user] == this.user.password){
                    localStorage.setItem('_admin',true);
                    this.$router.push('/admin');                    
                }
                else{
                    alert("Incorrect Password");
                    return false;
                }
            }
            else{
                alert("Incorrect Username and or Password");
                return false;
            }
            localStorage.setItem('_admin',true);
            if(this.user.user == "image"){
                this.$router.push('/administration');
            }
            else{
                this.$router.push('/admin');
            }
        }
    },
}
</script>
