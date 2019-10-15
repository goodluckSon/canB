<template>
    <div class="h-screen container py-3 bg-white">
        <div class="py-4">
            <h1 class="text-primary">支払い方法を選択してください</h1>
        </div>
            <div class="py-3 text-grey">
                <strong>支払い方法</strong>
            </div>
        <div class="form-group">
            <div class="custom-control custom-radio">
                <input type="radio" id="paypal" value="paypal" class="custom-control-input" v-model="paymentMethod">
                <label class="custom-control-label" for="paypal">Paypal</label>
            </div>
        </div>

        <div class="form-group">
            <div class="custom-control custom-radio">
                <input type="radio" id="carrier" value="carrier" class="custom-control-input" v-model="paymentMethod">
                <label class="custom-control-label" for="carrier">キャリア決済</label>
            </div>
        </div>
        <div class="form-group">
            <div class="custom-control custom-radio">
                <input type="radio" id="cc" value="cc" class="custom-control-input" v-model="paymentMethod">
                <label class="custom-control-label" for="cc">クレジットカード決済</label>
            </div>
        </div>
            <div class="py-4 text-grey">
                <strong>配達場所の選択</strong>
            </div>
            <loader v-if="loading"></loader>
        <div class="form-group"  v-for="(location, index) in locations" :key="index">
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" :id="location.id" :value="location.id" v-model="selectedLocation">
                <label class="custom-control-label" :for="location.id">{{location.building}}, {{location.landmark}}, {{location.address}}, {{location.zipcode}} ( {{location.phone}})</label>
            </div>
        </div>
            <div class="form-group">
          <button
              :disabled="!paymentMethod || !selectedLocation"
              class="btn btn-primary"
              v-if="$store.state.token">次へ</button>
            </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            loading:true,
            paymentMethod:null,
            selectedLocation:null,
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
