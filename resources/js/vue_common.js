/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

/** 
 * This is the default file for initiating a Vue instance
 * All the common vue components and common plugins will be 
 * declared here except auth
 */

require('./bootstrap');

window.Vue = require('vue');


import lodash from 'lodash';
Vue.use(lodash);
window.trans = (string) => _.get(window.i18n, string);
Vue.prototype.trans = string => _.get(window.i18n, string);

Vue.prototype.base_url = window.base_url;

// Vue Global Config
Vue.config.productionTip = false;
Vue.config.devtools = false;
Vue.config.debug = false;
Vue.config.silent = true;

window.VueProgressBar = require('vue-progressbar');
const options = {
    color: '#ec398b',
    failedColor: '#1b89ef',
    thickness: '4px',
    transition: {
        speed: '1s',
        opacity: '1s',
        termination: 900
    },
    autoRevert: true,
    location: 'top',
    inverse: false
}

Vue.use(VueProgressBar, options)

// import custom helpers
import helpers from './helpers';
const plugin = {
    install () {
        Vue.helpers = helpers
        Vue.prototype.$helpers = helpers
    }
}
Vue.use(plugin);

/**
 * Axios Interceptors 
 * just include the file
 */
require('./interceptors');