/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import Vue from 'vue';
import Vuetify from '../plugins/vuetify';
import VueRouter from 'vue-router'
import EventBus from 'vue';
import Toaster from 'v-toaster'

import AppContainer from './components/AppContainer.vue';
import routes from './routes.js'

import 'v-toaster/dist/v-toaster.css'

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('app-container', require('./components/AppContainer.vue').default);

Vue.use(VueRouter);
Vue.use(Toaster, {timeout: 3000});
Vue.prototype.$bus = new EventBus();

//Router configuration
const router = new VueRouter({
  mode: 'history',
  routes
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    vuetify: Vuetify,
    el: '#app',
    render: h => h(AppContainer),
    router,
});
