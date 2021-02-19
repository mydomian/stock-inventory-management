require('./bootstrap');

require('alpinejs');

import Vue from 'vue'
Vue.component('hello', require('./components/Text.vue').default)
Vue.component('product-add', require('./components/products/productAdd.vue').default)
Vue.component('product-edit', require('./components/products/productEdit.vue').default)
Vue.component('stock-manage', require('./components/stocks/stockManage.vue').default)
Vue.component('return-product', require('./components/return_products/returnProduct.vue').default)


//--Emport--
//vuex import
import store from './store'


const app = new Vue({
	el: '#app',
	store

})