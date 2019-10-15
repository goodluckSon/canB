<template>
    <div class="bg-white container">
        <div class="p-4">
            <router-link to="/administration/frames" class="text-grey py-2">戻る</router-link>
            <h4 class="text-primary">デザイン追加</h4>
            <form action="" @submit.prevent="SaveDesign" class="row">
                <div class="form-group col-sm-12 col-md-6 col-lg-3">
                    <label for="category"> デザイン Device</label>
                    <select v-model="device" name="device" id="device" class="form-control" :class="{'is-invalid':errors.device}">
                        <option :value="index" v-for="(type, index) in devices" :key="index">{{type.name}}</option>
                    </select>
                    <span class="invalid-feedback" v-if="errors.device">
                        {{errors.device[0]}}
                    </span>
                </div>
                <div class="form-group col-sm-12 col-md-6 col-lg-3" v-if="models.children">
                    <label for="model"> Model</label>
                    <select v-model="model" name="model" id="model" class="form-control" :class="{'is-invalid':errors.model}">
                        <option :value="dchild.name" v-for="(dchild, d_c_i) in models.children" :key="d_c_i">{{dchild.name}}</option>
                    </select>
                    <span class="invalid-feedback" v-if="errors.model">
                        {{errors.model[0]}}
                    </span>
                </div>
                <div class="form-group col-sm-12 col-md-6 col-lg-3">
                    <label for="category"> カテゴリー</label>
                    <select v-model="category" name="category" id="category" class="form-control" :class="{'is-invalid':errors.category}">
                        <option :value="ct" v-for="(ct, index) in categories" :key="index">{{ct}}</option>
                    </select>
                    <span class="invalid-feedback" v-if="errors.category">
                        {{errors.category[0]}}
                    </span>
                </div>
                <div class="form-group col-sm-12 col-md-6 col-lg-3">
                    <label for="file"> フレームファイル</label>
                    <input type="file" @change="FileChange" name="file" id="file" class="form-control" :class="{'is-invalid':errors.file}">
                    <span class="invalid-feedback" v-if="errors.file">
                        {{errors.file[0]}}
                    </span>
                </div>
                <div class="form-group col-sm-12 col-md-6 col-lg-4">
                    <button type="submit" class="btn btn-primary" :disabled="loading" :class="{'bg-gray-400':loading}">
                        <span v-if="loading">保存中</span>
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
            errors:[],
            devices:require('../../../../json/devices.json'),
            categories:require('../../../../json/designCategories.json'),
            models:[],
            file:"",
            device:null,
            model:"",
            category:"",
        }
    },
    watch: {
        device(){
            this.models = []
            let db  = this.devices[this.device];
            this.models = db
        }
    },
    computed: {
    },
    mounted() {

    },
    methods: {

        FileChange(event){
            this.file = event.target.files[0]?event.target.files[0]:null;
        },
        SaveDesign(){
            this.loading = true;
            let data = new FormData();
            data.append('file', this.file);
            data.append('device', this.device);
            data.append('model', this.model);
            data.append('category', this.category);

            this.$store
            .dispatch("SaveDesign",data)
            .then(res=>{this.$store.commit('Error',"Upload Success");this.$router.push({name:"DesignsIndex"})})
            .catch((error)=>{ this.$store.commit('Error',error.message)})
            .then(()=>{this.loading = false})
        },
    },
}
</script>
