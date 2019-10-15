<template>
    <div class="py-3">
        <router-link class="btn btn-primary float-right" :to="`/create`">Create</router-link>
        <h4 class="text-primary">保存一覧</h4>
        <div class="py-4"></div>
        <div class="text-center" v-if="loading">
            <loader></loader>
        </div>    
        <div class="row" v-else>
            <div class="col-sm-12 col-md-6 col-lg-3" v-for="(draft, index) in drafts" :key="index">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <p class="text-grey">{{draft.created_at}}</p>
                    </div>
                    <div class="card-footer bg-light border-0 p-0">
                        <div class="btn-group float-right">
                            <router-link :to="`/edit/${draft.id}/`" class="btn btn-sm btn-primary">編集</router-link>
                            <button @click="DeleteFlake(draft.id)" class="btn btn-sm btn-danger">削除</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-12 text-center font-semibold text-gray-600" v-if="!drafts.length">
            <h1 class="material-icons">save_alt</h1>
            <h6 class="text">No 保存一覧</h6>
            <router-link to="/create" class="btn btn-sm btn-outline-primary">Create</router-link>
        </div>    
    </div>
</template>
<script>
export default {
    data() {
        return {
            isLoading:false,
            drafts:[]
        }
    },
    mounted() {
        this.MyFlakes();
    },
    methods:{
        MyFlakes(){
            this.isLoading = true;
            this.$store.dispatch("MyFlakes")
                .then(res=>this.drafts = res.data)
                .catch(error=>this.$store.commit('Error',error.message))
                .then(()=>this.isLoading = false)
        },
        DeleteFlake(id){
            let conf = confirm("Are you Sure to Delete this ?");
            if(!conf)
            return false;

            this.isLoading = true;
            this.$store.dispatch("DeleteFlake",id)
                .then(res=>{this.drafts = res.data;this.$store.commit('Error',"Draft Deleted")})
                .catch(error=>this.$store.commit('Error',error.message))
                .then(()=>{this.isLoading = false;this.MyFlakes()})
        },
    }
}
</script>
