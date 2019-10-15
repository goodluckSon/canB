<template>
    <div class="bg-white container">
        <div class="py-3">
            <router-link class="btn btn-primary float-right" :to="{name:'AddDesign'}">デザイン追加</router-link>
        </div>
        <div class="p-4">
            <div class="spinner-border" role="status" v-if="loading">
                <span class="sr-only">Loading...</span>
            </div>
            <div role="status" class="text-center" v-if="!designs.length && !loading">
                <i class="material-icons">history</i>
                <h6 class="text-grey">デザインを追加してください</h6>
            </div>
            <!-- Four columns -->
            <div class="row"  v-if="designs.length && !loading">
                <div class="col-sm-12 col-md-4 col-lg-2"  v-for="(frame, index) in designs" :key="index">
                    <div class="text-center shadow-sm card card-body border-0">
                        <div class="py-2">{{frame.model}}</div>
                        <img class="img-fluid" :src="`/storage/${frame.file}`"/>
                        <button @click="DeleteDesign(frame.id)" class="btn btn-sm btn-danger mt-3">削除</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            loading:false,
            designs:[],
        }
    },
    mounted() {
        this.GetDesigns();
    },
    methods: {
        DeleteDesign(id){
            let conf = confirm("Are you sure to delete this? ")
            if(!conf){
                return false;
            }
            this.loading = true;
            this.$store
            .dispatch("DeleteDesign",id)
            .then(res=>{this.$store.commit('Error',"Delete Success");this.GetDesigns()})
            .catch((error)=>{ this.$store.commit('Error',error.message)})
            .then(()=>{this.loading = false})
        },
        async GetDesigns(){
            this.loading = true;
            await this.$store
            .dispatch("GetDesigns")
            .then(res=>{this.designs = res.data})
            .catch((error)=>{ this.$store.commit('Error',error.message)})
            .then(()=>{this.loading = false})
        },
    },
}
</script>
