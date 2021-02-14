require('./bootstrap');

require('alpinejs');

import Vue from 'vue'
Vue.component('hello', require('./components/Text.vue').default)
const app = new Vue({
	el: '#app',

})