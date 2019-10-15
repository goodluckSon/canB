<template>
<div class="py-3">
    <router-link class="py-2 text-grey" to="/profile/address">すべての住所に戻る</router-link>
    <h4 class="text-primary">Edit Address</h4>
    <div class="py-4"></div>
    <div class="text-center" v-if="loading">
        <loader></loader>
    </div>
    <form action="" class="row" method="post" @submit.prevent="addLocation">
        <div class="form-group col-sm-12 col-md-6 col-lg-4">
            <label for="location.building">建物名や部屋番号</label>
            <input
                class="form-control"
                id="location.building"
                v-model="location.building"
                type="text"/>
        </div>
        <div class="form-group col-sm-12 col-md-6 col-lg-4">
            <label for="location.landmark">都道府県</label>
            <input
                class="form-control"
                id="location.landmark"
                v-model="location.landmark"
                type="text"/>
        </div>
        <div class="form-group col-sm-12 col-md-6 col-lg-4">
            <label for="location.phone">ご連絡先</label>
            <input
                class="form-control"
                id="location.phone"
                v-model="location.phone"
                type="text"/>
        </div>
        <div class="form-group col-sm-12 col-md-6 col-lg-4">
            <label for="location.zipcode">郵便番号</label>
            <input
                class="form-control"
                id="location.zipcode"
                v-model="location.zipcode"
                type="text"/>
        </div>
        <div class="form-group col-sm-12 col-md-6 col-lg-4">
            <label for="location.address">住所</label>
            <textarea
                class="form-control"
                id="location.address"
                v-model="location.address">
            </textarea>
        </div>
        <div class="form-group col-sm-12">
          <button type="submit" class="btn btn-primary">保存</button>
        </div>
    </form>
</div>
</template>
<script>
export default {
    data() {
        return {
            loading:false,
            location:{
                phone:"",
                zipcode:"",
                building:"",
                landmark:"",
                address:"",
            }
        }
    },
    mounted() {
        if(this.$route.params.id){
            this.GetLocation()
        }
    },
    methods: {
      GetLocation(){
          this.loading = true;
          this.$store.dispatch("GetLocation",this.$route.params.id)
          .then(res=>{
              this.location = res.data;
          })
          .catch(error=>{

          })
          .then(()=>{
              this.loading = false;
          })
      },
      addLocation(){
          this.loading = true;
          let method = this.$route.params.id? "UpdateLocation":"AddLocation";
          this.$store.dispatch(method,this.location)
          .then(res=>{
              this.$router.push('/profile/address')
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
