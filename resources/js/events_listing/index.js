
/**
 * This is a page specific seperate vue instance initializer
 */

// include vue common libraries, plugins and components
import "../vue_common.js"

/**
 * Local Imports
*/

import VueMatchHeights from 'vue-match-heights';

Vue.use(VueMatchHeights);


import DatePicker from 'vue2-datepicker';
Vue.use(DatePicker);
/**
 * Local Components 
 */
import Events from './components/Events.vue';


/**
 * Local Vue Routes 
 */
const routes = new VueRouter({
    mode: 'history',
    base: '/',
    linkExactActiveClass: 'there',
    routes: [
        {
            path: path ? '/'+path+'/events' : '/events',

            // Inject  props based on route.query values for pagination
            props: (route) => ({
                page: route.query.page,
                category: route.query.category,
                search: route.query.search,
                start_date: route.query.start_date,
                end_date: route.query.end_date,
                city: route.query.city,
                state: route.query.state,
                country: route.query.country,
                date_format: date_format
                
            }),
            name: 'events',
            component: Events,

        },
    ],
});


/**
 * This is where we finally create a page specific
 * vue instance with required configs
 * element=app will remain common for all vue instances
 *
 * make sure to use window.app to make new Vue instance
 * so that we can access vue instance from anywhere
 * e.g interceptors 
 */
window.app = new Vue({
    el: '#eventmie_app',
    router: routes,
});