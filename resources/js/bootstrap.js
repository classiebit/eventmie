
window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

let base_url                    = document.head.querySelector('meta[name="base-url"]').content;
window.timezone_default         = document.head.querySelector('meta[name="timezone_default"]').content;
window.google_map_key           = document.head.querySelector('meta[name="google_map_key"]').content;

window.axios                    = require('axios');
window.axios.defaults.baseURL   = base_url;
window.base_url                 = base_url;
window.axios.defaults.headers.common['X-Requested-With']    = 'XMLHttpRequest';


/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}