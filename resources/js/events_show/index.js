
/**
 * This is a page specific seperate vue instance initializer
 */

// include vue common libraries, plugins and components
require('../vue_common');

/**
 * Local Third-party Lib Imports
*/
/* Instances */
import Vuex from 'vuex';
window.Vuex = Vuex;
Vue.use(Vuex);

/* Components */
Vue.component('v-select', require('vue-select').default);

/**
 * Local Components 
 */
Vue.component('select-dates', require('./components/SelectDates.vue').default);
Vue.component('gallery-images', require('./components/GalleryImages.vue').default);

/**
 * Local Vuex Store 
 */
const store = new Vuex.Store({
    state: {
        booking_date        : null,
        start_time          : null,
        end_time            : null,
    },
    mutations: {
        add(state, {booking_date, start_time, end_time}) {

            if(typeof booking_date !== "undefined") {
                state.booking_date   = booking_date;
            }

            if(typeof start_time !== "undefined") {
                state.start_time  = start_time;
            } 
            
            if(typeof end_time !== "undefined") {
                state.end_time   = end_time;
            }
        },
        update(state){
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
});