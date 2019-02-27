window.Axios = require('axios');
window.Axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
  window.Axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

window.Materialize = require('../libraries/materialize/js/materialize');
window.Moment = require('moment-timezone');
window.Vue = require('vue');
window.VueRouter = require('vue-router').default;
