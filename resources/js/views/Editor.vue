<template>
    <div class="w-full h-full bg-white p-6">
    <div class="flex flex-row flex-wrap">
        <div class="w-1/3 p-6 border-r border-gray-300">
            <affix class="sidebar-menu" relative-element-selector="#myScrollspy">
              <div style="border-radius:31px;overflow:hidden" :style="{'max-width':configKonva.width}" >
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
            </affix>
        </div>
        <div class="w w-2/3" id="myScrollspy">
            <div class="p-4 shadow-md mb-3">
                <h6 class="text-purple-600 font-semibold uppercase">アイコン選択</h6>
                <div class="p-3">
                    <ul class="flex flex-row">
                        <li class="p-4" >
                        <a class="px-3 py-2" href="javascript:void(0)" :class="{'text-purple-800 border-b-2 border-purple-800':activeOpration=='all','text-purple-400':activeOpration !=='all'}" @click="activeOpration = 'all'">All</a>
                        </li>
                        <li class="p-4"  v-for="(category, i) in GetCategories" :key="i">
                        <a class="px-3 py-2" href="javascript:void(0)" :class="{'text-purple-800 border-b-2 border-purple-800':activeOpration==i,'text-purple-400':activeOpration !==i}" @click="activeOpration = i">{{category}}</a>
                        </li>
                    </ul>
                </div>
                <div class="p-3 ">
                    <div class="tab-content" id="addLayers">
                        <div class="bg-gray-200 p-2" :class="{'':activeOpration=='all','hidden':activeOpration !== 'all'}" id="all_category" role="tabpanel" aria-labelledby="all_category_tab">
                            <div class="flex flex-row flex-wrap">
                                <div class="w-2/12 p-4" v-for="(ob, index) in $data.$items" :key="index">
                                <img :src="ob.source" alt="" class="w-full" @click="AddLayer(ob)">
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-200 p-2" v-for="(category, i) in GetCategories" :key="i" :class="{'':activeOpration==i,'hidden':activeOpration != i}" :id="category" role="tabpanel" :aria-labelledby="category+'tab'">
                            <div class="flex flex-row flex-wrap">
                                <div class="w-2/12 p-4" v-for="(ob, index) in GetCategoryObjects(category)" :key="index">
                                <img :src="ob.source" alt="" class="w-full" @click="AddLayer(ob)">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-4 shadow-md mb-3">
                <h6 class="text-purple-600 font-semibold uppercase">フレーム選択</h6>
                <div class="p-3">
                    <ul class="flex flex-row">
                        <li class="p-4" >
                        <a class="px-3 py-2" href="javascript:void(0)" :class="{'text-purple-800 border-b-2 border-purple-800':activeFrame=='all','text-purple-400':activeFrame !=='all'}" @click="activeFrame = 'all'">All</a>
                        </li>
                        <li class="p-4"  v-for="(category, i) in GetFrames" :key="i">
                        <a class="px-3 py-2" href="javascript:void(0)" :class="{'text-purple-800 border-b-2 border-purple-800':activeFrame==i,'text-purple-400':activeFrame !==i}" @click="activeFrame = i">{{category}}</a>
                        </li>
                    </ul>
                </div>
                <div class="p-3">
                    <div class="tab-content" id="addLayers">
                        <div class="bg-gray-200 p-2" :class="{'':activeFrame=='all','hidden':activeFrame !== 'all'}" id="all_category" role="tabpanel" aria-labelledby="all_category_tab">
                            <div class="flex flex-row flex-wrap">
                                <div class="w-2/12 p-4" v-for="(ob, index) in $data.$frames" :key="index">
                                <img :src="ob.source" alt="" class="w-full" @click="AddLayer(ob)">
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-200 p-2" v-for="(category, i) in GetFrames" :key="i" :class="{'':activeFrame==i,'hidden':activeFrame != i}" :id="category" role="tabpanel" :aria-labelledby="category+'tab'">
                            <div class="flex flex-row flex-wrap">
                                <div class="w-2/12 p-4" v-for="(ob, index) in GetFrameObjects(category)" :key="index">
                                <img :src="ob.source" alt="" class="w-full" @click="AddLayer(ob)">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-4 shadow-md mb-3">
                <h6 class="mb-4 text-purple-600 font-semibold uppercase">画像追加</h6>
                <div class="p-3">
                  <div class="p-4 text-center text-gray-400 opacity-50" v-if="!$store.state.token">
                    <div>
                      <i class="material-icons text-gray-500 text-6xl">ファイル</i>
                    </div>
                    <p>ログインしてから画像をアップロードしてください</p>
                  </div>
                  <div v-else>
                    <div class="dropzone border-dashed border-purple-300 py-6 text-purple-600" ref="dropzone"></div>
                  </div>
                </div>
                <div v-if="isloading">
                  <strong>Loading...</strong>
                </div>
                <div v-else>
                  <div class="bg-gray-200 p-2" >
                      <div class="flex flex-row flex-wrap">
                        <div class="w-full p-4">
                          <strong>ファイル</strong>
                        </div>
                        <div class="w-2/12 p-4" v-for="(item, index) in userImages" :key="index">
                          <img :src="item.url" alt="" class="w-full" @click="ImageSelection(index)">
                        </div>
                      </div>
                  </div>
                </div>


                    <ul class="flex flex-row">
                        <li class="p-4"  v-for="(image, i) in images" :key="i">
                            <a
                              class="px-3 py-2"
                              href="javascript:void(0)"
                              :class="{'text-purple-800 border-b-2 border-purple-800':activeEditingImage==i,'text-purple-400':activeEditingImage !==i}"
                              @click="activeEditingImage = i">{{image.name|| `Image - ${i+1}`}}</a>
                        </li>
                    </ul>
                <div class="p-3">
                    <div class="p-4 text-center text-gray-400" v-if="!images.length">
                      <div>
                        <i class="material-icons text-gray-500 text-6xl">image</i>
                      </div>
                      <p>No Images added</p>
                    </div>
                    <div class="p-3 bg-gray-300" v-for="(image, i) in images" :key="i" :class="{'hidden':activeEditingImage!==i}">
                    <div class="p-4 ">
                        <button class="float-right bg-red-400 w-10 h-10 p-2 rounded-full text-white" @click="DeleteImage(i)"><i class="material-icons">close</i></button>
                    </div>
                        <div class="p-2">
                            <label class="text-sm text-gray-800" :for="`image_layer_name_${i}`">名前</label>
                            <input type="text" class="border w-full h-10 px-2" :id="`image_layer_name_.${i}`" v-model="image.name">
                        </div>
                        <div class="p-2">
                            <label class="text-sm text-gray-800" :for="`image_left_objs_${i}`">左右</label>
                            <input type="range" class="slider" :id="`image_left_objs_.${i}`" v-model="image.x" :max="configKonva.width-40" :min="0">
                            <small>{{image.x}}</small>
                        </div>
                        <div class="p-2">
                            <label class="text-sm text-gray-800" :for="`image_bottom_objs_${i}`">上下</label>
                            <input type="range" class="slider" :id="`image_bottom_objs_.${i}`" v-model="image.y" :max="configKonva.height-40" :min="0">
                            <small>{{image.y}}</small>
                        </div>
                        <div class="p-2">
                            <label class="text-sm text-gray-800" :for="`image_width_objs_${i}`">サイズ ({{image.width}})</label>
                            <input type="range" class="slider" :id="`image_width_objs_.${i}`" v-model="image.width" :min="1" :max="configKonva.width">
                        </div>
                        <div class="p-2">
                            <label class="text-sm text-gray-800" :for="`image_height_objs_${i}`">上下 ({{image.height}})</label>
                            <input type="range" class="slider" :id="`image_height_objs_.${i}`" v-model="image.height" :min="1" :max="configKonva.height">
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-4 shadow-md mb-3">
                <h6 class="text-purple-600 font-semibold uppercase">配置</h6>
                <div class="p-3">
                    <ul class="flex flex-row">
                        <li class="p-4" >
                            <a class="px-3 py-2" href="javascript:void(0)" :class="{'text-purple-800 border-b-2 border-purple-800':activeLayer=='text','text-purple-400':activeLayer !=='text'}" @click="activeLayer = 'text'">{{text.text||"Layer Text"}}</a>
                        </li>
                        <li class="p-4"  v-for="(layer, i) in layers" :key="i">
                            <a class="px-3 py-2" href="javascript:void(0)" :class="{'text-purple-800 border-b-2 border-purple-800':activeLayer==i,'text-purple-400':activeLayer !==i}" @click="activeLayer = i">{{layer.name|| `Layer - ${i+1}`}}</a>
                        </li>
                    </ul>
                </div>
                <div class="p-3 bg-gray-300" :class="{'hidden':activeLayer!=='text'}">
                <div class="p-2">
                    <label for="text.text">文字入力</label>
                    <input type="text" v-model="text.text" class="border w-full h-10 px-2">
                </div>
                <div class="p-2">
                    <label for="x_text_layer">左右 ({{text.x}})</label>
                    <input type="range" class="slider" id="x_text_layer" v-model="text.x" :max="configKonva.width-40" :min="0">
                </div>
                <div class="p-2">
                    <label for="y_text_layer">上下 ({{text.y}})</label>
                    <input type="range" class="slider" id="y_text_layer" v-model="text.y" :max="configKonva.height-40" :min="0">
                </div>
                <div class="p-2">
                    <label for="y_text_layer">文字サイズ ({{text.fontSize}})</label>
                    <input type="range" class="slider" id="y_text_layer" v-model="text.fontSize" :max="100" :min="0">
                </div>
                <div class="p-2">
                    <label for="text.fontFamily">字体</label>
                    <select name="text.fontFamily" id="text.fontFamily" class="border w-full h-10 px-2" v-model="text.fontFamily">
                    <option v-for="(fontIn, fI) in fonts" :key="fI" :value="fontIn.name">{{fontIn.name}}</option>
                    </select>
                </div>
                <div class="p-2">
                    <label for="text.fill">色</label>
                    <swatches-picker :value="colors" @input="updateValue"></swatches-picker>
                </div>
                </div>
                <div class="p-3 bg-gray-300" v-for="(layer, i) in layers" :key="i" :class="{'hidden':activeLayer!==i}">
                    <div class="p-4 ">
                        <button class="float-right bg-red-400 w-10 h-10 p-2 rounded-full text-white" @click="DeleteLayer(i)"><i class="material-icons">close</i></button>
                    </div>
                    <div class="p-2">
                        <label :for="`layer_name_.${i}`">パーツ名</label>
                        <input type="text" class="border w-full h-10 px-2" :id="`layer_name_.${i}`" v-model="layer.name">
                    </div>
                    <div class="p-2">
                        <label :for="`left_objs_.${i}`">左右</label>
                        <input type="range" class="slider" :id="`left_objs_.${i}`" v-model="layer.x" :max="configKonva.width-40" :min="0">
                        <small>{{layer.x}}</small>
                    </div>
                    <div class="p-2">
                        <label :for="`bottom_objs_.${i}`">上下</label>
                        <input type="range" class="slider" :id="`bottom_objs_.${i}`" v-model="layer.y" :max="configKonva.height-40" :min="0">
                        <small>{{layer.y}}</small>
                    </div>
                    <div class="p-2">
                        <label :for="`width_objs_.${i}`">サイズ ({{layer.width}})</label>
                        <input type="range" class="slider" :id="`width_objs_.${i}`" v-model="layer.width" @click="layer.height = layer.width; " :min="1">
                    </div>
                </div>
            </div>
        </div>
    </div>
      <div class="fixed bottom-0 left-0 px-6 py-3 shadow-lg bg-gray-400 w-full">
        <div class="float-right">
          <!-- <button :disabled="isloading" class="bg-purple-600 py-2 px-4 text-white border-none" @click="DownloadCanvas">Download</button> -->
          <button
              :disabled="isloading"
              @click="Save"
              :class="{'bg-purple-600 text-white':!isloading,'bg-gray-600':isloading}"
              class="py-2 px-4"
              v-if="$store.state.token">保存</button>
            <router-link
              to="/payment"
              :disabled="isloading"
              class="bg-purple-600 py-2 px-4 text-white"
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
    GetCategories(){
      let cases =  [...new Set(this.$data.$items.map(item => item.category))];
      return cases;
    },
    GetFrames(){
      let cases =  [...new Set(this.$data.$frames.map(item => item.category))];
      return cases;
    }
  },
  data() {
    return {
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
      caseImage:require("../../assets/cases/sw.png"),
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
      $frames:[
        {
          name:"Frame",
          category:"Type -1",
          source:require('../../assets/icon.png'),
          x:30,
          y:30,
          width:30,
          height:30,
        },
      ],
      $items:[
        {
          name:"Star",
          category:"Stars",
          source:require('../../assets/star.png'),
          x:30,
          y:30
        },
        {
          name:"Flower",
          category:"Flowers",
          source:require('../../assets/cherry-blossom.png'),
          x:30,
          y:30,
          width:30,
          height:30,
        },
        {
          name:"Dog",
          category:"Animals",
          source:require('../../assets/dog.png'),
          x:30,
          y:30,
          width:30,
          height:30,
        },
        {
          name:"Flower",
          category:"Flowers",
          source:require('../../assets/flower.png'),
          x:30,
          y:30,
          width:30,
          height:30,
        },
        {
          name:"Star 2",
          category:"Stars",
          source:require('../../assets/stars.png'),
          x:30,
          y:30,
          width:30,
          height:30,
        },
      ],
      configKonva: {
        width: 10,
        radius:33,
        height: 10
      },
      userImages:[]
    };
  },
  mounted() {
    const image = new window.Image();
    image.src = this.caseImage;
    image.onload = () => {
      this.configKonva.width = image.naturalWidth;
      this.configKonva.height = image.naturalHeight;
      this.image = image;
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
      let src  = {id:item.id,name:'Image '+i,x:0,y:0,width:this.configKonva.width,height:this.configKonva.height};
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
    DeleteImage(i){
      let confi = confirm("Are you Sure you want to Delete this Layer?")
      if(confi)
      this.images.pop(i);
      else
      return false;
    },
    DeleteLayer(i){
      let confi = confirm("Are you Sure you want to Delete this Layer?")
      if(confi)
      this.layers.pop(i);
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
    UploadImage(){

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
</style>
