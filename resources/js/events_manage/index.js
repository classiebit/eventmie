
/**
 * This is a page specific seperate vue instance initializer
 */

// include vue common libraries, plugins and components
require('../vue_common');

/**
 * Below are the page specific plugins and components
  */

// for using time
window.moment   = require('moment-timezone');

// add Veevalidate for auto validation
window.VeeValidate = require('vee-validate');
Vue.use(VeeValidate)

// add Vuex for global variables management across components
window.Vuex = require('vuex');
Vue.use(Vuex);

Vue.component('tabs-component', require('./components/Tabs.vue').default);

// import Vuerouter
import VueRouter from 'vue-router';
Vue.use(VueRouter);

// import component for vue routes
import Detail from './components/Detail';
import Media from './components/Media';
import Location from './components/Location';
import Timing from './components/Timing';
import Publish from './components/Publish';
import Seo from './components/Seo';

// vue routes
const routes = new VueRouter({
    // mode: 'history',
    // base: '/profile',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            name: 'detail',
            component: Detail,
            props: true,
        },
        {
            path: '/media',
            name: 'media',
            component: Media,
            props: true,
        },
        {
            path: '/seo',
            name: 'seo',
            component: Seo,
            props: true,
        },
        {
            path: '/location',
            name: 'location',
            component: Location,
            props: true,
        },
        {
            path: '/timing',
            name: 'timing',
            component: Timing,
            props: true,
        },
        {
            path: '/publish',
            name: 'publish',
            component: Publish,
            props: true,
        },
    ],
});


// declare a global store object
const store = new Vuex.Store({
    state: {
        event        : [],
        event_id     : null,
    },
    mutations: {
        add(state, {event_id, event}) {
            if(typeof event_id !== "undefined") {
                state.event_id   = event_id;
            }
            if(typeof event !== "undefined") {
                state.event = event;
            }
        },
    },
});

/**
 * This is where we finally create a page specific
 * vue instance with required configs
 * element=app will remain common for all vue instances
 * 
 */
window.app = new Vue({
    el: '#eventmie_app',
    store: store,
    router: routes

});