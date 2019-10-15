<template>
    <div class="bg-white container">
        <div class="py-3">
            <router-link class="btn btn-primary float-right" :to="{name:'AddIcon'}">アイコン追加</router-link>
        </div>
        <div class="p-4">
            <div class="spinner-border" role="status" v-if="loading">
                <span class="sr-only">Loading...</span>
            </div>
            <div role="status" v-if="!icons.length && !loading">
                <i class="material-icons">history</i>
                <h3 class="text-gray-500">アイコンを追加してください</h3>
            </div>
            <!-- Four columns -->
            <div class="row"  v-if="icons.length && !loading">
                <div class="col-sm-12 col-md-4 col-lg-2"  v-for="(icon, index) in icons" :key="index">
                    <div class="text-center shadow-sm card card-body border-0">
                        <div class="py-2">{{icon.name}}</div>
                        <img class="img-fluid" :src="`/storage/${icon.file}`"/>
                        <button @click="DeleteIcon(icon.id)" class="btn btn-sm btn-danger mt-3">削除</button>
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
            icons:[],
            frames:[],
        }
    },
    mounted() {
        this.GetIcons();
    },
    methods: {
        async GetIcons(){
            this.loading = true;
            await this.$store
            .dispatch("GetIcons")
            .then(res=>{this.icons = res.data})
            .catch((error)=>{ this.$store.commit('Error',error.message)})
            .then(()=>{this.loading = false})
        },
        async DeleteIcon(id){
            let confirmI = confirm("Delete this Icon?");
            if(!confirmI){
                return false;
            }
            this.loading = true;
            await this.$store
            .dispatch("DeleteIcon",id)
            .then(res=>{this.GetIcons();this.$store.commit('Error',"Icon Deleted.")})
            .catch((error)=>{ this.$store.commit('Error',error.message)})
            .then(()=>{this.loading = false})
        },
    },
}
</script>
