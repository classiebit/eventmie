
/**
 * This is a page specific seperate vue instance initializer
 */

// include vue common libraries, plugins and components
require('../vue_common.js');

/**
 * Local Third-party Lib Imports
*/
/* Instances */
import Vuex from 'vuex';
window.Vuex = Vuex;
Vue.use(Vuex);


import PersonalDetails from './components/PersonalDetails';

import Security from './components/Security';
import { mapState, mapMutations } from "vuex";

import Croppa from 'vue-croppa';
Vue.use(Croppa)

/**
 * Local Vuex Store 
 */

const store = new Vuex.Store({

    state: {
        personal_details    : [],
    },

    mutations: {
        add(state, { personal_details }) {

            if (typeof personal_details !== "undefined") {
                state.personal_details = personal_details;
            }
        }
    }

});



const routes = new VueRouter({
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            name: 'personal-details',
            props: {
                user: user,
                csrf_token: csrf_token,
            },
            component: PersonalDetails,
        },
        {
            path: '/userSecurity',
            name: 'security',
            props: {
                user: user,
                csrf_token: csrf_token,
            },
            component: Security,
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
    store: store,
    data() {
        return {
            store: store
        }
    },
    computed: {

        currentRouteName() {
            return this.$route.name;
        },
        ...mapState(["personal_details"])

    },
    methods: {
        ...mapMutations(["add"]),

        checkEmptyProfile() {
            if (
                user.name == "" ||
                user.email == ""
            ) {
                return false;
            }
            return true;
        },

        
    },
    mounted() {
        this.add({
            personal_details: this.checkEmptyProfile(),
        });
    }


});