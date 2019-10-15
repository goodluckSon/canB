import router from './router/router'
import store from './store/store'
window.Vue = require('vue');
import VueKonva from 'vue-konva'
import Affix from 'vue-affix';

import 'bootstrap'

Vue.use(Affix);
Vue.use(VueKonva)
const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
const app = new Vue({
    el: '#app',
    router,store
});
