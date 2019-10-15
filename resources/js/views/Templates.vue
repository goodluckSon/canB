<template>
    <div class="h-full bg-white">
        <div class="row no-gutters">
            <div class="col-sm-12 col-md-3 border-right mainer tabs">
                <ul class="nav flex-column nav-pills">
                    <li class="nav-item"  v-for="(category, index) in categories" :key="index">
                        <a @click="selectedCategory = index" :class="{'active':selectedCategory ==index}" class="nav-link" href="#">{{category}} <i class="material-icons float-right">keyboard_arrow_right</i></a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-12 col-md-9 mainer tabs bg-light">
                <div class="row">
                    <div class="col-sm-12 text-center py-4" v-if="!GetCategoryItems">
                        <h6>カテゴリーを選択してください</h6>
                    </div>
                    <div class="col-sm-12 text-center py-4" v-else-if="!GetCategoryItems.length">
                        <h6>デザインで利用できるカテゴリーがありません．</h6>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-2 mb-2" v-else v-for="(item, index) in GetCategoryItems" :key="index">
                        <img :src="item.source" alt="" class="img-thumbnail" :class="{'active':index == selectedImage}" @click="selectedImage = index">
                    </div>
                </div>
            </div>
        </div>
      <div class="fixed card card-body py-1 border-0 shadow-lg bg-dark">
        <div class="float-right">
            <router-link
              to="/payment"
              :disabled="isloading"
              class="btn btn-light"
              v-if="$store.state.token && selectedImage !==null">購入</router-link>
            <router-link
              to="/login?redirect=templates"
              :disabled="isloading"
              class="btn btn-light"
              v-if="!$store.state.token">Login</router-link>
        </div>
      </div>
    </div>
</template>
<script>
import designItems from '../../json/designItems'
export default {
    data() {
        return {
            selectedCategory:-1,
            selectedImage:null,
            images:designItems,
            categories:[
                "花",
                "ペット",
                "動物",
                "イラスト",
                "スカル",
                "テクスチャー",
                "食べ物",
                "写真",
                "リゾート",
                "家紋",
                "絵画",
                "ハロウイン",
                "春",
                "夏",
                "秋",
                "冬",
                "テキスト",
                "国旗",
                "宇宙",
                "和柄",
                "ダマスク",
                "ペイズリー",
                ]
        }
    },
    computed: {
        GetCategoryItems(){
            if(this.selectedCategory == -1){
                return false;
            }
            let i = this.categories[this.selectedCategory];
            let items = this.images.filter(res=>res.category ==i);
            return items;
        }
    },
}
</script>
<style lang="scss">
.mainer{
    max-height: 98vh;
    overflow: hidden;
    overflow-y: scroll;
}
.img-thumbnail.active{
    background-color:purple;
}
.tabs::-webkit-scrollbar {
  width: 2px;
  height: 3px;
}
.tabs::-webkit-scrollbar-track {
  background: #f1f1f1;
}
.tabs::-webkit-scrollbar-thumb {
  background: #888;
}
.tabs::-webkit-scrollbar-thumb:hover {
  background: #555;
}
</style>
