<template>
    <div class="py-3">
        <h4 class="text-primary">プロフィール編集</h4>
        <form class="row"  @submit.prevent="UpdateUser">
            <div class="form-group col-sm-12 col-md-4">
                <label for="user.name">名前</label>
                <input
                    :readonly="loading"
                    class="form-control"
                    v-model="user.name"
                    id="user.name"
                    type="text"/>                
            </div>
            <div class="form-group col-sm-12 col-md-4">
                <label for="user.email">メールアドレス</label>
                <input
                    :readonly="loading"
                    class="form-control"
                    v-model="user.email"
                    id="user.email"
                    type="email"/>                
            </div>
            <div class="col-sm-12">

            </div>
            <div class="form-group col-sm-12 col-md-4">
                <label for="user.password">パスワード変更</label>
                <input
                    :readonly="loading"
                    class="form-control"
                    v-model="user.password"
                    id="user.password"
                    type="text"/>                
            </div>
            <div class="form-group col-sm-12 col-md-4">
                <label for="user.password_confirmation">確認用パスワード</label>
                <input
                    :readonly="loading"
                    class="form-control"
                    v-model="user.password_confirmation"
                    id="user.password_confirmation"
                    type="text"/>                
            </div>
            <div class="form-group col-sm-12">
               <button type="submit" class="btn btn-outline-primary">保存</button>               
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data() {
        return {
            loading:false,
            user:{
                name:"",
                email:"",
                password:"",
                password_confirmation:"",
                profile:{

                }
            }
        }
    },
    mounted() {
        this.GetUser()
    },
    methods: {
      GetUser(){
          this.loading = true;
          this.$store.dispatch("GetUser")
          .then(res=>{
              this.user = res.data;
          })
          .catch(error=>{

          })
          .then(()=>{
              this.loading = false;
          })
      },
      UpdateUser(){
          this.loading = true;
          this.$store.dispatch("UpdateUser",this.user)
          .then(res=>{
              this.user = res.data;
          })
          .catch(error=>{

          })
          .then(()=>{
              this.loading = false;
          })
      },
    },
}
</script>
