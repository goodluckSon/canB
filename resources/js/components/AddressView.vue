<template>
<div class="py-3">
     <router-link class="btn btn-primary float-right" :to="`/profile/address/create`">配達先の登録</router-link>
    <h4 class="text-primary">配達場所🚛</h4>
    <div class="py-4"></div>
    <div class="text-center" v-if="loading">
        <loader></loader>
    </div>    
    <div class="row" v-else>
        <div class="col-sm-12 col-md-6 col-lg-4" v-for="(location, index) in locations" :key="index">
            <div class="card card-body">
                 <p class="text-grey">{{location.building}}, {{location.landmark}}, {{location.zipcode}}, {{location.address}}, {{location.phone}}
                 </p>
                <router-link :to="`/profile/address/${location.id}/update`" >編集</router-link>
            </div>
        </div>
    </div>
    <div class="p-12 text-center font-semibold text-gray-600" v-if="!locations.length">
        <h1 class="material-icons text-purple-700 text-2xl">location_off</h1>
        <h4 class="text">配達先が登録されていません</h4>
        <router-link to="/profile/address/create" class="text-purple-700 text-sm">配達先の登録</router-link>
    </div>    
</div>
</template>
<script>
export default {
    data() {
        return {
            loading:false,
            addAddressModal:true,
            locations:[]
        }
    },
    mounted() {
        this.GetLocations()
    },
    methods: {
      GetLocations(){
          this.loading = true;
          this.$store.dispatch("GetLocations")
          .then(res=>{
              this.locations = res.data;
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
