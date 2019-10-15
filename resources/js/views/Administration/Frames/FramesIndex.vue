<template>
    <div class="bg-white container">
        <div class="py-3">
            <router-link class="btn btn-primary float-right" :to="{name:'AddFrame'}">フレーム追加</router-link>
        </div>
        <div class="p-4">
            <div class="spinner-border" role="status" v-if="loading">
                <span class="sr-only">Loading...</span>
            </div>
            <div role="status" v-if="!frames.length && !loading">
                <i class="material-icons">history</i>
                <h3 class="text-gray-500">フレームが追加されていません</h3>
            </div>
            <!-- Four columns -->
            <div class="row"  v-if="frames.length && !loading">
                <div class="col-sm-12 col-md-4 col-lg-2"  v-for="(frame, index) in frames" :key="index">
                    <div class="text-center shadow-sm card card-body border-0">
                        <div class="py-2">{{frame.name}}</div>
                        <img class="img-fluid" :src="`/storage/${frame.file}`"/>
                        <button @click="DeleteFrame(frame.id)" class="btn btn-sm btn-danger mt-3">削除</button>
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
            frames:[],
        }
    },
    mounted() {
        this.Getframes();
    },
    methods: {
        async Getframes(){
            this.loading = true;
            await this.$store
            .dispatch("GetFrames")
            .then(res=>{this.frames = res.data})
            .catch((error)=>{ this.$store.commit('Error',error.message)})
            .then(()=>{this.loading = false})
        },
        async DeleteFrame(id){
            let confirmI = confirm("Delete this Frame?");
            if(!confirmI){
                return false;
            }
            this.loading = true;
            await this.$store
            .dispatch("DeleteIcon",id)
            .then(res=>{this.Getframes();this.$store.commit('Error',"frame Deleted.")})
            .catch((error)=>{ this.$store.commit('Error',error.message)})
            .then(()=>{this.loading = false})
        },
    },
}
</script>
