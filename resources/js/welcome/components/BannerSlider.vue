<template>
    <VueSlickCarousel 
        :autoplay="true"
        :autoplaySpeed="3000"
        :arrows="true" 
        :dots="true"
        :infinite="true"
        :slidesToShow="1"
        :paginationEnabled="false"
        :rtl="dir"
    >
        <div 
            v-for="(item, index) in banners"
            v-bind:item="item"
            v-bind:index="index"
            v-bind:key="index"
            :class="'lgx-item-common'"
        >
            <section>
                <div class="container-fluid p-0">
                    <div class="cover-img-bg" :style="{ backgroundImage: `url(${getImageUrl(item.image)})` }">
                        <a v-if="item.button_url != null" :href="item.button_url">
                            <img class="cover-img prevent_draggable" :src="getImageUrl(item.image)" :alt="item.title" />
                        </a>
                        
                        <img v-else class="cover-img prevent_draggable" :src="getImageUrl(item.image)" :alt="item.title" />

                        <div class="banner-slider-form" v-if="demo_mode">
                            <h1 class="text-white mb-0 fw-bold display-5">Eventmie Lite 3.0</h1>
                            <p class="fw-bold text-white">Open-source Event management for Free Events</p>
                            <div class="d-flex mt-2">
                                <a class="btn btn-dark border border-1" target="_blank" href="https://classiebit.com/eventmie"><i class="fas fa-cloud-download-alt"></i> Download FREE </a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a class="btn btn-success text-white" target="_blank" href="https://classiebit.com/eventmie-pro"><i class="fas fa-shopping-cart"></i> Purchase PRO </a>
                            </div>
                            <div class="d-flex mt-2 d-none d-sm-block">
                                <a class="btn btn-info text-white border border-1" target="_blank" href="https://eventmie-docs.classiebit.com/"><i class="fas fa-book"></i> Get Started</a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </section>
        </div>
    </VueSlickCarousel>
</template>

<script>
import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
// optional style for arrows & dots
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'

Vue.prototype.base_url = window.base_url;

import mixinsFilters from '../../mixins';

export default {

    mixins:[
        mixinsFilters
    ],


    components: {
        VueSlickCarousel
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
            route       : route,
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