/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

/** 
 * This is the default file for auth and gdpr components
 * This file will be included as common vue instance for
 * login purposes
 */

require('../bootstrap');

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

// import GDPR 
window.CookieLaw = require('vue-cookie-law');
Vue.use(CookieLaw);

// import custom helpers
import helpers from '../helpers';
const plugin = {
    install () {
        Vue.helpers = helpers
        Vue.prototype.$helpers = helpers
    }
}
Vue.use(plugin)

// these are the common components that need to available in all vue instances
Vue.component('gdpr-message', require('./components/GdprComponent.vue').default);
Vue.component('alert-message', require('./components/AlertComponent.vue').default);

/**
 * Init auth instance
 * 
 * CookieLaw component need to be included in only in auth instance
 */
window.auth_app = new Vue({
    el: '#eventmie_auth_app',
    data() {
        return {
            lastScrollTop: 0
        }
    },
    components: { CookieLaw },
    methods: {
        handleScroll () {
            let el = document.getElementById('navbar_vue');

            let st = window.pageYOffset || document.documentElement.scrollTop;
            if (st > this.lastScrollTop){
                // scroll down
                
            } else {
                // scroll up
                
            }
            this.lastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling

            if(window.scrollY > 50) {
                el.classList.add('menu-onscroll');
            } else {
                el.classList.remove('menu-onscroll');
                

                if(el.classList.contains('is-active')) {
                    el.classList.add('is-mobile');
                }
            }
        },
        mobileMenu() {
            let el  = document.getElementById('navbar');
            let el2 = document.getElementById('mobile_menu_vue');
            let el3 = document.getElementById('navbar_vue');
            
            // burger button
            if(el.classList.contains('in'))
                el.classList.remove('in');
            else
                el.classList.add('in');
        },
    },
    created () {
        window.addEventListener('scroll', this.handleScroll);
    },
    destroyed () {
        window.removeEventListener('scroll', this.handleScroll);
    },
    mounted() {
    },
});