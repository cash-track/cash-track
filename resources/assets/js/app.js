
// load libraries
require('./bootstrap');

// import needle components
let example = require('./components/Example.vue');
Vue.component('example', example);

// The main Vue instance
window.app = new Vue({
    el: 'body'
});

// bind main hooks
$(function(){
	$('[data-toggle="tooltip"]').tooltip()
});
