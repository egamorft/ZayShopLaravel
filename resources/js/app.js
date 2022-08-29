/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
 import Vue from 'vue';
 import CKEditor from '@ckeditor/ckeditor5-vue2';
// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.use(CKEditor);

Vue.component('coupon', require('./components/Coupon.vue').default);
Vue.component('category', require('./components/Category.vue').default);
Vue.component('subcategory', require('./components/SubCategory.vue').default);
Vue.component('slider', require('./components/Slider.vue').default);
Vue.component('profile_address', require('./components/Address.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const vue = new Vue({
    el: '#vue',
});
