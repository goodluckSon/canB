import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '../store/store'
import swal from 'sweetalert';

import app from './app'
import auth from './auth'
import guest from './guest'
import admin from './admin'

Vue.use(VueRouter)

const routes =[];
guest.forEach(element =>routes.push(element));
auth.forEach(element =>routes.push(element));
app.forEach(element =>routes.push(element));
admin.forEach(element =>routes.push(element));

const router = new VueRouter({
    mode: 'history',
    linkActiveClass:"act",
    linkExactActiveClass:"active",
    routes: routes,
});
router.beforeEach((to, from, next) => {
    let auth = to.matched.some(record => record.meta.auth);
    let guest = to.matched.some(record => record.meta.guest);
    let admin = to.matched.some(record => record.meta.admin);
    let IsadminLoggedIn = localStorage.getItem('_admin');
    let isloggedin = store.getters.isLoggedIn;
    let adminUser       = {username:"admin",password:"admin@123"}
    if(isloggedin && auth)
    next()
    else if(!isloggedin && auth)
    next({path:"/login",query: { redirect: to.fullPath }})
    else if(isloggedin && guest)
    next({path:"/"})
    else if(!isloggedin && guest)
    next()
    else if(admin && !IsadminLoggedIn)
    next({path:'/admin/login'});
    else if(admin && IsadminLoggedIn)
    next()
    else
    next()

})

export default router;