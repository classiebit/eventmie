<template>
    <carousel 
        :autoplay="true"
        :autoplayTimeout="5000"
        :scrollPerPage="false"
        :perPage="1"
        :paginationEnabled="false"
        :rtl="dir"
    >
        <slide 
            v-for="(item, index) in banners"
            v-bind:item="item"
            v-bind:index="index"
            v-bind:key="index"
            :class="'lgx-item-common'"
        >
            <section>
                <div class="container-fluid p-0">
                    <div class="cover-img-bg" :style=" { backgroundImage: 'url(' + (`/storage/${item.image}`) + ')'} ">
                        <img class="cover-img" :src="'/storage/'+item.image" :alt="item.title" />
                        <div class="banner-slider-form">
                            <h1 class="text-white mb-0 fw-bold display-5">{{ item.title }}</h1>
                            <p class="fw-bold text-white">{{ item.subtitle }}</p>
                            <div class="d-flex justify-content-center mt-2">
                                <div v-if="demo_mode">
                                    <div class="px-2">
                                        <a class="btn btn-secondary" target="_blank" href="https://classiebit.com/eventmie"><i class="fas fa-cloud-download-alt"></i> Download FREE </a>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a class="btn btn-success text-white" target="_blank" href="https://classiebit.com/eventmie-pro"><i class="fas fa-shopping-cart"></i> Purchase PRO </a>
                                    </div>
                                </div>
                                <div v-else>
                                    <a class="btn btn-primary bg-gradient text-white" :href="getRoute('eventmie.events_index')"><i class="fas fa-calendar-day"></i> {{ trans('em.browse') }} {{ trans('em.events') }}</a>

                                    <!-- if guest -->
                                    <a class="btn btn-secondary text-white" :href="getRoute('eventmie.register')" v-if="!is_logged">
                                        <i class="fas fa-door-open"></i> {{ trans('em.register') }}
                                    </a>

                                    <!-- if admin -->
                                    <a class="btn btn-primary bg-gradient text-white" :href="getRoute('eventmie.myevents_form')" v-if="is_logged && is_admin">
                                        <i class="fas fa-calendar-plus"></i> {{ trans('em.create') }} {{ trans('em.event') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </slide>
    </carousel>
</template>

<script>
import { Carousel, Slide } from 'vue-carousel';
Vue.prototype.base_url = window.base_url;

export default {

    components: {
        Carousel,
        Slide
    },
    props: [
        'banners',
        'is_logged',
        'is_customer',
        'is_admin',
        'demo_mode',
    ],

    
    data() {
        return {
            check       : 0,
            dir         : false,

        }
    },    

    methods: {
        // return route with event slug
        getRoute(name){
            return route(name);
        },


    },

    mounted() {
        
    }
}
</script>