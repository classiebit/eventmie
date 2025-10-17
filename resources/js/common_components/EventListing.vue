<template>
    <div>
        <div class="row" v-if="events_slider == true">
            <VueSlickCarousel
                :autoplay="true"
                :autoplaySpeed="3000"
                :arrows="false" 
                :dots="false"
                :infinite="true"
                :paginationEnabled="false"
                :rtl="dir"
                :class="'custom-carousel px-1'"
                v-bind="settings"
            >
                <div
                    v-match-heights="{
                        el: ['h5.sub-title', 'div.thumb-img-bg'],  // Array of selectors to fix
                    }"
                    v-for="(event, index) in events" 
                    :key="index"
                    :class="'col-sm-4 col-md-3 col-lg-3 col-12'"
                >
                    <Event :event="event" :currency='currency' :date_format='date_format'/>

                </div>
            </VueSlickCarousel>
        </div>
         
        <div class="row" v-else>
            <div 
                class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-6 mb-2 px-0"
                    v-match-heights="{
                        el: ['h5.sub-title', 'div.thumb-img-bg'],  // Array of selectors to fix
                    }"
                    v-for="(event, index) in events" 
                    :key="index"
            >
                <Event :event="event" :currency='currency' :date_format='date_format'/>
            </div>    
        </div>

        <div class="row" v-if="not_found">
            <div class="col-12">
                <h4 class="heading text-center mt-30"><i class="fas fa-exclamation-triangle"></i> {{ trans('em.events_not_found') }}</h4>
            </div>
        </div>
    </div>
    
</template>

<script>

import mixinsFilters from '../mixins.js';

import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
// optional style for arrows & dots
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'

import Event from './Event.vue';

export default {
    
    props: ['events', 'date_format', 'item_count'],

    components: {
        VueSlickCarousel,
        Event
    },

    mixins:[
        mixinsFilters
    ],

    data() {
        return {
            not_found   : false,
            events_slider   : events_slider,
            dir         : false,
            local_item_count  : this.item_count,
            settings: {
                "dots": true,
                "infinite": false,
                "speed": 500,
                "slidesToShow": 4,
                "slidesToScroll": 4,
                "initialSlide": 0,
                "autoplay": true,
                "autoplaySpeed": 3000,
                "arrows": false,
                "responsive": [
                    {
                        "breakpoint": 1300,
                        "settings": {
                            "slidesToShow": 3,
                            "slidesToScroll": 3,
                            "infinite": true,
                            "dots": false
                        }
                    },
                    {
                        "breakpoint": 1024,
                        "settings": {
                            "slidesToShow": 2,
                            "slidesToScroll": 2,
                            "infinite": true,
                            "dots": false
                        }
                    },
                ]
            }
        }
    },

    methods:{
        
        // return route with event slug
        eventSlug: function eventSlug(slug) {
            return route('eventmie.events_show', [slug]);
        },

        getDirection(){
            document.documentElement.dir == 'rtl' ? this.dir = true : this.dir = false;
        },

        mobileView(){
            var androidMobile = window.matchMedia("(max-width: 768px)");
            if (androidMobile.matches)
                this.local_item_count = 1;
        }
  
    },


    watch: {
        events: function () {
            this.not_found = false;
            if(this.events.length <= 0)
                this.not_found = true;
        
        },
        
    },
    mounted(){    
        this.getDirection();
        this.mobileView();
    }

}
</script>