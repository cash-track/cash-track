
// Lodash
window._ = require('lodash');

// Jquery
window.$ = window.jQuery = require('jquery');

import Popper from 'popper.js';
window.Popper = Popper;

// Bootstrap
require('bootstrap');

// Axios HTTP requests
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.csrf_token = token.content;
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = csrf_token;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
