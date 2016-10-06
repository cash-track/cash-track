
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
	$('[data-toggle="tooltip"]').tooltip();

	$('.trans-header, .trans-operation').on('click', function(e){
		e.preventDefault();
		$(this).closest('.trans-item').toggleClass('active');
	});

	$('.new-trans-item .trans-detail>i, .new-trans-item .trans-detail>a, .new-trans-item .cancel-new-trans').on('click', function(e){
		e.preventDefault();
		$('.new-trans-item-form').toggleClass('active');
	});

	$('.trans-item .action-button .edit-button, .trans-item .cancel-edit').on('click', function(e){
		e.preventDefault();
		$(this).closest('.trans-item').toggleClass('edit');
	});
});
