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

/**
 * Vue Instance 
 */
import Vue from 'vue/dist/vue';
window.Vue = Vue;

/**
 * Global Constants 
 */
 window.trans                        = (string) => _.get(window.i18n, string);
 Vue.prototype.trans                 = string => _.get(window.i18n, string);
 Vue.prototype.base_url              = window.base_url;
 Vue.prototype.$vue2_datepicker_lang = {
    // vue2 datepicker lang
    formatLocale: {
        // MMMM
        months: [trans('em.january'), trans('em.february'), trans('em.march'), trans('em.april'), trans('em.may'), trans('em.june'), trans('em.july'), trans('em.august'), trans('em.september'), trans('em.october'), trans('em.november'), trans('em.december')],
        // MMM
        monthsShort: [trans('em.jan'), trans('em.feb'), trans('em.mar'), trans('em.apr'), trans('em.may'), trans('em.jun'), trans('em.jul'), trans('em.aug'), trans('em.sep'), trans('em.oct'), trans('em.nov'), trans('em.dec')],
        // dddd
        weekdays: [trans('em.sunday'), trans('em.monday'), trans('em.tuesday'), trans('em.wednesday'), trans('em.thursday'), trans('em.friday'), trans('em.saturday')],
        // ddd
        weekdaysShort: [trans('em.sun'), trans('em.mon'), trans('em.tue'), trans('em.wed'), trans('em.thu'), trans('em.fri'), trans('em.sat')],
        // dd
        weekdaysMin: [trans('em.su'), trans('em.mo'), trans('em.tu'), trans('em.we'), trans('em.th'), trans('em.fr'), trans('em.sa')],
        // format 'a', 'A'
        meridiem: (h, _, isLowercase) => {
            let word = h < 12 ? trans('em.am') : trans('em.pm');
            return isLowercase ? word.toLocaleLowerCase() : word;
        },
    },
};

/**
 * Global Javascript Libs Imports & Initializations
 * these packages will be available in all index.js 
 * don't import them in index.js again.
 * 
 * (need to be added in Vue.prototype instead of Vue.use)
 */
import moment from 'moment-timezone';
window.moment        = moment;
Vue.prototype.moment = window.moment;
moment.locale(my_lang);  // set language for moment


/**
 * Global VueJs Libs Imports & Initializations
 * these packages will be available in all index.js 
 * don't import them in index.js again.
 * 
 * (need to be added in Vue.use instead of Vue.prototype)
 */
import VueRouter from 'vue-router';
window.VueRouter = VueRouter;
Vue.use(VueRouter);



import VueProgressBar from 'vue-progressbar';
window.VueProgressBar = VueProgressBar;
Vue.use(VueProgressBar, {
    color: '#3490dc',
    failedColor: '#e62b4c',
    thickness: '3px',
    transition: {
        speed: '1s',
        opacity: '1s',
        termination: 900
    },
    autoRevert: true,
    location: 'top',
    inverse: false
});

import VeeValidate from 'vee-validate';
window.VeeValidate = VeeValidate;
Vue.use(VeeValidate);

/**
 * Axios Interceptors 
 * custom global config
 */
 require('./interceptors');

/**
 * Global Components 
 */
Vue.component('cookie-law', require('vue-cookie-law').default);
Vue.component('gdpr-message', require('./common_components/GdprComponent.vue').default);
Vue.component('alert-message', require('./common_components/AlertComponent.vue').default);

/**
 * Global Vue Config 
 */
Vue.config.productionTip = false;
Vue.config.devtools = false;
Vue.config.debug = false;
Vue.config.silent = true; 

/**
 * Custom Global Imports 
 */
import helpers from './helpers';
const plugin = {
    install () {
        Vue.helpers = helpers
        Vue.prototype.$helpers = helpers
    }
}
Vue.use(plugin);