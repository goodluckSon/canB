<template>
    <div class="bg-white container">
        <div class="p-4">
            <router-link to="/administration/icons" class="text-grey py-2">戻る</router-link>
            <h4 class="text-primary">アイコン追加</h4>
            <form action="" @submit.prevent="SaveIcon" class="row">
                <div class="form-group col-sm-12 col-md-6 col-lg-4">
                    <label for="name">Icon Name</label>
                    <input v-model="name" type="text" name="name" id="name" class="form-control" :class="{'is-invalid':errors.name}">
                    <span class="invalid-feedback" v-if="errors.name">
                        {{errors.name[0]}}
                    </span>
                </div>
                <div class="form-group col-sm-12 col-md-6 col-lg-4">
                    <label for="category">Category</label>
                    <select v-model="category" name="category" id="category" class="form-control" :class="{'is-invalid':errors.category}">
                        <option :value="type" v-for="(type, index) in categories" :key="index">{{type}}</option>
                    </select>
                    <span class="invalid-feedback" v-if="errors.category">
                        {{errors.category[0]}}
                    </span>
                </div>
                <div class="form-group col-sm-12 col-md-6 col-lg-4">
                    <label for="file">File</label>
                    <input type="file" @change="FileChange" name="file" id="file" class="form-control" :class="{'is-invalid':errors.file}">
                    <span class="invalid-feedback" v-if="errors.file">
                        {{errors.file[0]}}
                    </span>
                </div>
                <div class="form-group col-sm-12 col-md-6 col-lg-4">
                    <button type="submit" class="btn btn-primary" :disabled="loading" :class="{'bg-gray-400':loading}">
                        <span v-if="loading">保存中..</span>
                        <span v-else>保存</span>
                    </button>
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
            categories:["Stars","Flowers","Animals"],
            icons:[],
            frames:[],
            errors:[],
            name:"",
            file:"",
            type:"icon",
            category:"",
        }
    },
    watch: {
        name(){
            if(this.name !==""){
                if(this.errors.name){
                    this.errors.name = null;
                }
            }
        },
        category(){
            if(this.category !==""){
                if(this.errors.category){
                    this.errors.category = null;
                }
            }
        },
        file(){
            if(this.file !==""){
                if(this.errors.file){
                    this.errors.file = null;
                }
            }
        },
    },
    mounted() {

    },
    methods: {
        FileChange(event){
            this.file = event.target.files[0]?event.target.files[0]:null;
        },
        SaveIcon(){
            this.loading = true;
            this.errors = [];
            let data = new FormData();
            data.append('file', this.file);
            data.append('name', this.name);
            data.append('type', this.type);
            data.append('category', this.category);

            this.$store
            .dispatch("SaveAddon",data)
            .then(res=>{this.$store.commit('Error',"Upload Success");this.$router.push({name:"AdminIconsIndex"})})
            .catch((error)=>{ this.errors = error.response.data.errors; this.$store.commit('Error',error.message)})
            .then(()=>{this.loading = false})
        },
    },
}
</script>
