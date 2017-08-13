
// Lodash
window._ = require('lodash');

// Jquery
window.$ = window.jQuery = require('jquery');

import Popper from 'popper.js';
window.Popper = Popper;

// Bootstrap
require('bootstrap');

// Vue.js
window.Vue = require('vue');

// Vue resource
require('vue-resource');

// Set up a laravel crfs implementation in vue-resource
Vue.http.interceptors.push((request, next) => {
    request.headers['X-CSRF-TOKEN'] = Laravel.csrfToken;

    next();
});