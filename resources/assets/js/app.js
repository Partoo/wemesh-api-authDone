/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


window.Vue = require('vue');
require('./bootstrap');

import './plugins/axios';
import VueRouter from 'vue-router';
import ElementUI from 'element-ui';
import VueSlimScroll from 'vue-slimscroll';
import '../sass/element-vars.scss';
import routes from './routes.js';
import store from './vuex/store.js';
import App from './App.vue';

Vue.use(ElementUI);
Vue.use(VueSlimScroll);
Vue.use(VueRouter);

Vue.component('app', require('./App.vue'));
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const router = new VueRouter({
    mode: 'history',
    linkActiveClass: 'active',
    routes: routes
});

new Vue(Vue.util.extend({router, store}, App)).$mount('#box');
