
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
Vue.component('Multiselect', require('vue-multiselect').default);
Vue.component('DatePicker', require('vue2-datepicker').default);

import VueConfirmDialog from 'vue-confirm-dialog'
Vue.use(VueConfirmDialog)
Vue.component('vue-confirm-dialog', VueConfirmDialog.default);

import Croppa from 'vue-croppa';
Vue.use(Croppa)

import CKEditor from 'ckeditor4-vue';
window.ckeditor = CKEditor.component;
Vue.component('ckeditor', window.ckeditor).default;


/**
 * Local Components 
 */
Vue.component('tabs-component', require('./components/Tabs.vue').default);
import Detail from './components/Detail';
import Media from './components/Media';
import Location from './components/Location';
import Timing from './components/Timing';
import Poweredby from './components/Poweredby';
import Seo from './components/Seo';


/**
 * Local Vuex Store 
 */
const store = new Vuex.Store({
    state: {
        event        : [],
        
        event_id     : null,
        is_dirty     : false,
        
        organiser_id        : null,

    },
    mutations: {
        add(state, {event_id, event, is_dirty}) {
            if(typeof event_id !== "undefined") {
                state.event_id   = event_id;
            }

            if(typeof event !== "undefined") {
                state.event = event;
            }
            
            if(typeof is_dirty !== "undefined") {
                state.is_dirty = is_dirty;
            }

            

        },
        update(state){
        },
    },
});

/**
 * Local Vue Routes 
 */
const routes = new VueRouter({
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            name: 'detail',
            component: Detail,
            props: true,
            beforeEnter(to, from, next) {
                routeBeforeEnter(to, from, next);
            },
        },
        {
            path: '/media',
            name: 'media',
            component: Media,
            props: true,
            beforeEnter(to, from, next) {
                routeBeforeEnter(to, from, next);
            },
        },
        {
            path: '/seo',
            name: 'seo',
            component: Seo,
            props: true,
            beforeEnter(to, from, next) {
                routeBeforeEnter(to, from, next);
            },
        },
        {
            path: '/location',
            name: 'location',
            component: Location,
            props: true,
            beforeEnter(to, from, next) {
                routeBeforeEnter(to, from, next);
            },
        },
        {
            path: '/timing',
            name: 'timing',
            component: Timing,
            props: true,
            beforeEnter(to, from, next) {
                routeBeforeEnter(to, from, next);
            },
        },
        {
            path: '/publish',
            name: 'publish',
            component: Poweredby,
            props: true,
            beforeEnter(to, from, next) {
                routeBeforeEnter(to, from, next);
            },
        },
    ],
});

/* Route configs */
function routeBeforeEnter(to, from, next) {
    // except refresh
    if(from.name !== null) {
        // don't switch if no is_event_id
        if(is_event_id == 0) {
            Vue.$confirm({
                title: trans('em.required'),
                message: trans('em.please_fill_details'),
                button: {
                    yes: trans('em.cancel'),
                },
                callback: confirm => {
                    next(false);
                }
            });
            
            next(false);

            // in case of force loading other than detail
            if(to.name == "detail") {
                window.location.href = route('eventmie.myevents_form');
            }
            
        } else {
            if(store.state.is_dirty) {
                Vue.$confirm({
                    title: trans('em.unsaved_changes'),
                    message: trans('em.save_before_switch_tab'),
                    button: {
                        yes: trans('em.switch_tab'),
                        no: trans('em.stay_here')
                    },
                    callback: confirm => {
                        if(confirm) next();
                        else next(false);
                    }
                });
            } else {
                next();
            }
        }
    } else {
        next();
    }
};

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