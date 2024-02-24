
/**
 * This is a page specific seperate vue instance initializer
 */

// include vue common libraries, plugins and components
require('../vue_common');

/**
 * Local Imports
*/

/**
 * Local Components 
 */
import MyBooking from './components/MyBooking';


/**
 * Local Vue Routes 
 */
const routes = new VueRouter({
    mode: 'history',
    base: '/',
    linkExactActiveClass: 'there',
    routes: [
        {
            path: path ? '/'+path+'/mybookings' : '/mybookings',
            // Inject  props based on route.query values for pagination
            props: (route) => ({
                page: route.query.page,
                date_format: date_format,
            }),
            name: 'mybookings',
            component: MyBooking,

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