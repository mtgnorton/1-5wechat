
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


import Vue from 'vue';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import router from './router.js';
import VueRouter from 'vue-router'
import 'nprogress/nprogress.css'
// import NProgress from 'nprogress'//页面顶部进度条


Vue.use(VueRouter);
require('./bootstrap');
Vue.use(ElementUI);


const bus = new Vue();
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./App.vue'));

const app = new Vue({
    router:router,
    el: '#app'
});
