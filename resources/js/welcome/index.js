
/**
 * This is a page specific seperate vue instance initializer
 */

// include vue common libraries, plugins and components
require('../vue_common');

/**
 * Local Imports
*/
Vue.component('VueCarousel', require('vue-carousel').default);
Vue.component('VueMatchHeights', require('vue-match-heights').default);

/**
 * Local Components 
 */
Vue.component('event-listing', require('../common_components/EventListing').default);
Vue.component('banner-slider', require('./components/BannerSlider').default);


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
});