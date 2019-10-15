<template>
  <div class="h-full bg-light py-4">
    <div class="container">
      <h1 class="text-primary font-weight-lighter my-4">デザイン</h1>
      <p>・白枠いっぱいにデザインを入れてください.</p>
      <p>・赤枠の内側が実際のサイズです.</p>
      <p>・緑枠の外側にはテキストなど切れたらまずいものは配置しないでください.</p>
      <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-4 border-right mb-4">
              <div style="overflow:hidden" :style="{'max-width':configKonva.width}" class="mx-auto">
                <v-stage :config="configKonva" ref="stage">
                  <v-layer ref="layer_bgs">
                    <v-image v-for="(im, index) in images" :key="index" :config="im"></v-image>
                  </v-layer>

                  <v-layer ref="layer_text" v-if="text.text !==''">
                    <v-text :config="text"></v-text>
                  </v-layer>
                  <v-layer ref="layer_case">
                    <v-image :config="{image: image,cornerRadius:30}"/>
                  </v-layer>
                  <v-layer ref="layer_images">
                    <v-image v-for="(layer, index) in layers" :key="index" :config="layer" :class="{active:activeLayer==index}"></v-image>
                  </v-layer>
                </v-stage>
              </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-8 heighted">
       <!-- Icons -->
          <div class="row mb-3">
            <div class="col-sm-12">
              <div class="card shadow-sm border-0">
                <div class="card-body">
                  <h6 class="text-primary">アイコン選択</h6>
                </div>
              <ul class="nav nav-pills">
                <li class="nav-item">
                  <a class="nav-link" :class="{active:activeOpration=='all'}" href="javascript:void(0)" @click.prevent="activeOpration = 'all'">All</a>
                </li>
                <li class="nav-item" v-for="(category, i) in GetCategories" :key="i">
                  <a class="nav-link" :class="{active:activeOpration==i}" href="javascript:void(0)" @click="activeOpration = i">{{category}}</a>
                </li>
              </ul>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-2 col-xs-4 mb-2 col-md-4 col-lg-2" v-for="(ob, index) in GetCategoryItems" :key="index">
                    <img :src="ob.source" alt="" class="img-thumbnail rounded" @click="AddLayer(ob)">
                  </div>
                </div>
              </div>
              </div>
            </div>
            </div>
          <!-- Icons -->

       <!-- Frames -->
          <div class="row mb-3">
            <div class="col-sm-12">
              <div class="card shadow-sm border-0">
                <div class="card-body">
                  <h6 class="text-primary">フレーム選択</h6>
                </div>
              <ul class="nav nav-pills">
                <li class="nav-item">
                  <a class="nav-link" :class="{active:activeFrame=='all'}" href="javascript:void(0)" @click.prevent="activeFrame = 'all'">All</a>
                </li>
                <li class="nav-item" v-for="(category, i) in GetFrames" :key="i">
                  <a class="nav-link" :class="{active:activeFrame==i}" href="javascript:void(0)" @click="activeFrame = i">{{category}}</a>
                </li>
              </ul>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-4 col-md-4 col-lg-2" v-for="(ob, index) in GetFrameItems" :key="index">
                    <img :src="ob.source" alt="" class="img-thumbnail rounded" @click="AddLayer(ob)">
                  </div>
                </div>
              </div>
              </div>
            </div>
            </div>
          <!-- Frames -->

       <!-- Images -->
          <div class="row mb-3">
            <div class="col-sm-12">
              <div class="card shadow-sm border-0">
                <div class="card-body">
                  <h6 class="text-primary">画像追加</h6>
                </div>
                  <div class="p-4 text-center text-gray-400 opacity-50" v-if="!$store.state.token">
                    <div>
                      <i class="material-icons">image</i>
                    </div>
                    <p>ログイン後，画像を挿入してください</p>
                  </div>
                  <div v-else>
                    <div class="dropzone text-primary" ref="dropzone"></div>
                  </div>
                </div>
                <div v-if="isloading">
                  <strong>Loading...</strong>
                </div>
                <div v-else>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-4 col-md-4 col-lg-2" v-for="(item, index) in userImages" :key="index">
                        <a href="javascript.void(0);" @click.prevent="ImageSelection(index)">
                          <div style="width:100%;height:70px;background-size:100%;background-repeat:no-repeat;background-position:center;" :style="{'background-image':`url(${item.url})`}" >
                          </div>
                        </a>
                        <button class="btn btn-sm btn-link text-danger" @click="DeleteImage(item.id)">Delete</button>
                      </div>
                    </div>
                  </div>
                </div>
                <ul class="nav nav-tabs">
                  <li class="nav-item"  v-for="(image, i) in images" :key="i">
                      <a
                        class="nav-link"
                        href="javascript:void(0)"
                        :class="{'active':activeEditingImage==i}"
                        @click="activeEditingImage = i">{{image.name|| `Image - ${i+1}`}}</a>
                  </li>
                </ul>
                <div class="card-body" v-if="GetEditableImage">
                  <div class="form-group">
                    <button class="float-right rounded btn-sm btn-danger btn" @click="DeleteImageLayer(activeEditingImage)"><i class="material-icons">close</i></button>
                  </div>
                  <div class="form-group">
                    <label class="text-sm text-gray-800" for="image_layer_name">名前</label>
                    <input type="text" class="form-control" id="image_layer_name" v-model="GetEditableImage.name">
                  </div>
                  <div class="form-group">
                    <label class="text-sm text-gray-800" for="image_left_objs">左</label>
                    <input type="range" class="custom-range" id="image_left_objs" v-model="GetEditableImage.x" :max="configKonva.width-40" :min="0">
                    <small>{{GetEditableImage.x}}</small>
                  </div>
                  <div class="form-group">
                    <label class="text-sm text-gray-800" for="image_bottom_objs">下</label>
                    <input type="range" class="custom-range" id="image_bottom_objs" v-model="GetEditableImage.y" :max="configKonva.height-40" :min="0">
                    <small>{{GetEditableImage.y}}</small>
                  </div>
                  <div class="form-group">
                    <label class="text-sm text-gray-800" for="image_width_objs">サイズ</label>
                    <input type="range" class="custom-range" id="image_width_objs" v-model="GetEditableImage.width" :max="configKonva.width" :min="1">
                    <small>{{GetEditableImage.width}}</small>
                  </div>
                  <div class="form-group">
                    <label class="text-sm text-gray-800" for="image_height_objs">Height</label>
                    <input type="range" class="custom-range" id="image_height_objs" v-model="GetEditableImage.height" :max="configKonva.height" :min="1">
                    <small>{{GetEditableImage.height}}</small>
                  </div>
                </div>

                <div class="card mb-3 border-0 shadow-sm">
                  <div class="card-body">
                    <h6 class="text-primary">配置</h6>
                  </div>
                  <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a
                          class="nav-link"
                          href="javascript:void(0)"
                          :class="{'active':activeLayer=='text'}"
                          @click="activeLayer = 'text'">{{text.text||"Layer Text"}}</a>
                    </li>
                    <li class="nav-item"  v-for="(layer, i) in layers" :key="i">
                        <a
                          class="nav-link"
                          href="javascript:void(0)"
                          :class="{'active':activeLayer==i}"
                          @click="activeLayer = i">{{layer.name|| `Layer - ${i+1}`}}</a>
                    </li>
                  </ul>
                  <div class="card-body">
                    <div v-if="activeLayer == 'text'">
                      <div class="form-group">
                        <label for="GetActiveLayer.text">文字入力</label>
                        <input v-model="GetActiveLayer.text" type="text" name="GetActiveLayer.text" id="GetActiveLayer.text" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="GetActiveLayer.x_text_layer">左右 ({{GetActiveLayer.x}})</label>
                        <input v-model="GetActiveLayer.x" :max="configKonva.width-40" :min="0" type="range" name="GetActiveLayer.x_text_layer" id="GetActiveLayer.x_text_layer" class="custom-range">
                      </div>
                      <div class="form-group">
                        <label for="GetActiveLayer.y_text_layer">上下 ({{GetActiveLayer.y}})</label>
                        <input v-model="GetActiveLayer.y" :max="configKonva.height-40" :min="0" type="range" name="GetActiveLayer.y_text_layer" id="GetActiveLayer.y_text_layer" class="custom-range">
                      </div>
                      <div class="form-group">
                        <label for="GetActiveLayer.fontSize">文字サイズ ({{GetActiveLayer.y}})</label>
                        <input v-model="GetActiveLayer.fontSize" :max="100" :min="0" type="range" name="GetActiveLayer.fontSize" id="GetActiveLayer.fontSize" class="custom-range">
                      </div>
                      <div class="form-group">
                        <label for="text.fontFamily">字体</label>
                        <select name="text.fontFamily" id="text.fontFamily" class="form-control" v-model="GetActiveLayer.fontFamily">
                          <option v-for="(fontIn, fI) in fonts" :key="fI" :value="fontIn.name">{{fontIn.name}}</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="text.fill">色</label>
                        <swatches-picker :value="colors" @input="updateValue"></swatches-picker>
                      </div>
                    </div>
                    <div v-else>
                    <div class="form-group ">
                        <button class="btn btn-sm btn-danger float-right" @click="DeleteLayer(activeLayer)"><i class="material-icons">close</i></button>
                    </div>
                    <div class="form-group">
                        <label for="layer_name">パーツ名</label>
                        <input type="text" class="border w-full h-10 px-2" id="layer_name" v-model="GetActiveLayer.name">
                    </div>
                    <div class="form-group">
                        <label for="left_objs">左右</label>
                        <input type="range" class="slider" id="left_objs" v-model="GetActiveLayer.x" :max="configKonva.width-40" :min="0">
                        <small>{{GetActiveLayer.x}}</small>
                    </div>
                    <div class="form-group">
                        <label for="bottom_objs">上下</label>
                        <input type="range" class="slider" id="bottom_objs" v-model="GetActiveLayer.y" :max="configKonva.height-40" :min="0">
                        <small>{{GetActiveLayer.y}}</small>
                    </div>
                    <div class="form-group">
                        <label for="width_objs">サイズ ({{GetActiveLayer.width}})</label>
                        <input type="range" class="slider" id="width_objs" v-model="GetActiveLayer.width" @click="GetActiveLayer.height = GetActiveLayer.width; " :min="1">
                    </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            </div>
          <!-- Images -->
        </div>
    </div>
      <div class="fixed card card-body py-1 border-0 shadow-lg bg-dark">
        <div class="float-right">
          <!-- <button :disabled="isloading" class="bg-purple-600 py-2 px-4 text-white border-none" @click="DownloadCanvas">Download</button> -->
          <button
              :disabled="isloading"
              @click="Save"
              class="btn btn-light"
              v-if="$store.state.token">保存</button>
            <router-link
              to="/payment"
              :disabled="isloading"
              class="btn btn-light"
              v-if="$store.state.token">購入</router-link>
        </div>
      </div>
  </div>
</template>
<script>
import { Swatches } from 'vue-color'
import colors from "../../json/Colors"
import download from 'downloadjs'
import Dropzone from 'dropzone'
Dropzone.autoDiscover = false;
export default {
  components: {
    'swatches-picker': Swatches
  },
  computed:{
    GetCategoryItems(){
      if(this.activeOpration == 'all'){
        return this.$data.$items;
      }
      let cate = this.$data.$items[this.activeOpration].category;
      return this.GetCategoryObjects(cate)
    },
    GetFrameItems(){
      if(this.activeFrame == 'all'){
        return this.$data.$frames;
      }
      let cate = this.$data.$frames[this.activeFrame].category;
      return this.GetFrameObjects(cate)
    },
    GetCategories(){
      let cases =  [...new Set(this.$data.$items.map(item => item.category))];
      return cases;
    },
    GetEditableImage(){
      if(this.activeEditingImage !==null){
        return this.images[this.activeEditingImage];
      }
      else{
        return false;
      }
    },
    GetActiveLayer(){
      if(this.activeLayer =='text'){
        return this.text;
      }
      else if(this.activeLayer !== null){
        return this.layers[this.activeLayer];
      }
      else{
        return false;
      }
    },
    GetFrames(){
      let cases =  [...new Set(this.$data.$frames.map(item => item.category))];
      return cases;
    }
  },
  data() {
    return {
      caseImages:{
        0:{ //Ploomtech
          0:require("../../assets/cases/PloomTech.png"),
          1:require("../../assets/cases/PloomTech.png")
        },
        1:{
          0:require("../../assets/cases/iQOS3multi.png"),
          1:require("../../assets/cases/iQOS.png"),
          2:require("../../assets/cases/iQOS3.png"),
        },
        2:{
          0:require("../../assets/cases/DiaryCase_L.png"),
          1:require("../../assets/cases/DiaryCase_M.png"),
          2:require("../../assets/cases/DiaryCase_S.png"),
        },
        3:{
          0:require("../../assets/cases/iQOS3multi.png"),
          1:require("../../assets/cases/iQOS.png"),
          2:require("../../assets/cases/iQOS3.png"),
        },
        4:{
          0:require("../../assets/cases/glomini.png"),
          1:require("../../assets/cases/glo.png"),
        },
        5:{
          0:require("../../assets/cases/PassCase.png"),
        },
        6:{
          0:require("../../assets/cases/sw_1.png"),
          1:require("../../assets/cases/sw_2.png"),
          2:require("../../assets/cases/sw_3.png"),
          3:require("../../assets/cases/sw_3.png"),
          4:require("../../assets/cases/sw_5.png"),
          5:require("../../assets/cases/sw_6.png"),
          6:require("../../assets/cases/sw.png"),
        },
      },
      saveid:null,
      isloading:false,
      activeLayer:'text',
      activeOpration:'all',
      Dropezoner:'',
      activeEditingImage:0,
      activeFrame:'all',
      colors:colors,
      images:[],
      fonts:[
        {name:"Arial"},
        {name:"Poppins"},
        {name:"Anton"},
        {name:"Bonbon"},
        {name:"Darker Grotesque"},
        {name:"Fascinate"},
        {name:"Hanalei"},
        {name:"Quicksand"},
      ],
      caseImage:require("../../assets/cases/PloomTech.png"),
      image:"",
      layers:[],
      text:{
        x:30,
        y:30,
        text:"",
        fontFamily:"Arial",
        fontSize: 20,
        fill:"#008080"
      },
      $frames:[],
      $items:[],
      configKonva: {
        width: 300,
        height: 400
      },
      userImages:[]
    };
  },
  mounted() {
    this.GetIcons();
    this.Gframes();
    let bg = this.caseImage;

    if(this.$route.params.model){
      bg = this.caseImages[this.$route.params.model][this.$route.params.size];
    }
    const image = new window.Image();
    image.src = bg;
    image.onload = () => {
      this.image = image;
      this.image.width = 300;
      this.image.height = 400;
    };
    if(this.$store.state.token){
      this.Images();
      this.CreateDropzone();
    }
    if(this.$route.params.id){
      this.saveid = this.$route.params.id
      this.GetU();
    }
  },
  methods: {
      getIm(id){
          return this.userImages.filter(image=>image.id == id)[0];
      },
    async GetU(){
      this.isloading = true;
      await this.$store.dispatch('GetFlake',this.$route.params.id)
      .then(res=>{
          let images    = JSON.parse(res.data.data.images)
          let layers    = JSON.parse(res.data.data.layers)
          let text      = JSON.parse(res.data.data.text)
          this.text = text;
          layers.forEach(element => {
              this.AddLayer(element)
          });
          images.forEach(element => {
              this.ImageGetByID(element)
          });
      })
      .catch(error=>this.$store.commit('Error',error.message))
      .then(()=>this.isloading=false)
    },
    CreateDropzone(){
      this.Dropezoner = new Dropzone(this.$refs.dropzone,{ url: "/api/images",headers:{Authorization:`Bearer ${this.$store.state.token}`}});
      this.Dropezoner.on('complete',()=>{
        this.Images();
      })
    },
    async Images(){
        this.isloading = true;
        await this.$store.dispatch("Images")
              .then(res=>{
                this.userImages = res.data;
              })
            .catch(error=>this.$store.commit('Error',error.message))
              .then(res=>{
                  this.isloading = false;
              })
    },
    ImageGetByID(config){
      let item = this.getIm(config.id);
      let src  = config;
      let image = new window.Image();
      image.src = item.url;
      image.onload = () => {
        src.image = image;
        this.images.push(src)
      };
    },
    ImageSelection(i){
      let item = this.userImages[i];
      let src  = {id:item.id,name:'',x:0,y:0,width:this.configKonva.width,height:this.configKonva.height};
      let image = new window.Image();
      image.src = item.url;
      image.onload = () => {
        src.image = image;
        this.images.push(src)
      };
    },
    AddImage(){
      this.images.push({image:null,name:"",x:0,y:0,width:this.configKonva.width,height:this.configKonva.height});
    },
    GetCategoryObjects(category){
      return this.$data.$items.filter(res=>res.category == category);
    },
    GetFrameObjects(category){
      return this.$data.$frames.filter(res=>res.category == category);
    },
    DeleteImageLayer(i){
      let confi = confirm("Are you Sure you want to Delete this Layer?")
      if(confi)
      this.images.pop(i);
      else
      return false;
    },
    DeleteLayer(i){
      let confi = confirm("Are you Sure you want to Delete this Layer?")
      if(confi){
        this.layers.pop(i);
        this.activeLayer = null
      }
      else
      return false;
    },
    updateValue(val){
      this.text.fill = val.hex
    },
    AddLayer(obj){
      let instrument = this.cleanSource(obj);

      let article = new window.Image();
      article.src = instrument.source;
      article.onload = () => {
        instrument.image = article;
        this.layers.push(instrument)
      };

    },
    cleanSource (source) {
      return JSON.parse(JSON.stringify(source));
    },

    DownloadCanvas(){
      let stage = this.$refs.stage.getStage();
      let URL = stage.toDataURL({ pixelRatio: 5 });
      download(URL, new Date().toString()+'_ik.png', "image/png");
    },
    async Save(){
        this.isloading = true;
        let js = {};
        if(this.saveid)
          js.id = this.saveid;

          js.layers = JSON.stringify(this.layers);
          js.images = JSON.stringify(this.images);
          js.text   = JSON.stringify(this.text);
      let action = "";
      if(this.saveid){
        action = await this.$store.dispatch('UpdateFlake',js)
                      .then(res=>{this.saveid = res.data.id;this.$store.commit('Error',"Draft Updated")})
                      .catch(error=>this.$store.commit('Error',error.message))
                      .then(()=>this.isloading = false)
      }
      else{
        action = await this.$store.dispatch('NewFlake',js)
                      .then(res=>{this.saveid = res.data.id;this.$store.commit('Error',"Draft Saved")})
                      .catch(error=>this.$store.commit('Error',error.message))
                      .then(()=>this.isloading = false)
      }

    },
    async DeleteImage(id){
        await this.$store.dispatch('DeleteImage',id)
                      .then(res=>{
                          this.saveid = res.data.id;
                          this.$store.commit('Error',"Image Deleted")
                          this.userImages.pop(this.getIm(id));
                          this.images.pop(this.getIm(id));
                        })
                      .catch(error=>this.$store.commit('Error',error.message))
                      .then(()=>{this.isloading = false;this.Images();})
    },
    async GetIcons(){
        this.loading = true;
        await this.$store
        .dispatch("GetIcons")
        .then(res=>{
          let its = res.data;
          its.forEach(element => {
            this.$data.$items.push({
              source:`/storage/${element.file}`,
              category:element.category,
              x:30,
              y:30,
              width:30,
              height:30,
            })
          });
        })
        .catch((error)=>{ this.$store.commit('Error',error.message)})
        .then(()=>{this.loading = false})
    },
    async Gframes(){
        this.loading = true;
        await this.$store
        .dispatch("GetFrames")
        .then(res=>{
          let its = res.data;
          its.forEach(element => {
            this.$data.$frames.push({
              source:`/storage/${element.file}`,
              category:element.category,
              x:30,
              y:30,
              width:30,
              height:30,
            })
          });
        })
        .catch((error)=>{ this.$store.commit('Error',error.message)})
        .then(()=>{this.loading = false})
    },
    Purchase(){
      let stage = this.$refs.stage.getStage();
      let URL = stage.toDataURL({ pixelRatio: 5 });
      download(URL, new Date().toString()+'_ik.png', "image/png");
    },
  },
};

</script>
<style lang="scss">
  .atom-picker{
    border-color:transparent;
    width: 50%;
    height: 30px;
    font-size: 14px;
  }
  .atom-picker.active{
    color:#FFFFFF;
    background-color: blue;
    border: 1px solid blue;
  }
.slider {
  -webkit-appearance: none;
  width: 100%;
  height: 10px;
  background: #1e1e1e;
  outline: none;
  opacity: 0.7;
  -webkit-transition: .2s;
  transition: opacity .2s;
}

.slider:hover {
  opacity: 1;
}

.slider::-webkit-slider-thumb {
  -webkit-appearance: none;
  appearance: none;
  width: 25px;
  height: 25px;
  background: purple;
  cursor: pointer;
}

.slider::-moz-range-thumb {
  width: 25px;
  height: 25px;
  background: purple;
  cursor: pointer;
}
.heighted{
  max-height: 80vh;
  overflow-y: scroll;
}
</style>
