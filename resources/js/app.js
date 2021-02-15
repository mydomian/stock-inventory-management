require('./bootstrap');

require('alpinejs');

import Vue from 'vue'
Vue.component('hello', require('./components/Text.vue').default)
Vue.component('product-add', require('./components/products/productAdd.vue').default)


//--Emport--
//vuex import
import store from './store'


const app = new Vue({
	el: '#app',
	store

})