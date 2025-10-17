/**
 * This is a page-specific separate Vue instance initializer
 */

// Include Vue common libraries, plugins, and components
import "../vue_common.js";

// Local Imports
import VueMatchHeights from 'vue-match-heights';

Vue.use(VueMatchHeights);


// Local Components
import BannerSlider from "./components/BannerSlider.vue";
import EventListing from "../common_components/EventListing.vue";

/**
 * Initialize Vue instance
 * Make sure to use `window.app` to access it globally
 */
window.app = new Vue({
    el: "#eventmie_app",
     components: {
        EventListing,
        BannerSlider,
    },
});
