<template>
    <div>
        <div class="row" v-if="events_slider == true">
            <carousel 
                :autoplay="true"
                :autoplayTimeout="3000"
                :scrollPerPage="false"
                :paginationEnabled="false"
                :autoplayHoverPause="true"
                :perPage="local_item_count"
                :rtl="dir"
                :class="'custom-carousel px-1'"
            >
                <slide
                    v-match-heights="{
                        el: ['h5.sub-title'],  // Array of selectors to fix
                    }"
                    v-for="(event, index) in events" 
                    :key="index"
                    :class="'col-md-6 col-lg-4 col-12'"
                >
                    <Event :event="event" :currency='currency' :date_format='date_format'/>

                </slide>
            </carousel>
        </div>
         
        <div class="row" v-else>
            <div 
                class="col-md-4 col-12 mb-4 px-0"
                    v-match-heights="{
                        el: ['h5.sub-title'],  // Array of selectors to fix
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

import { Carousel, Slide } from 'vue-carousel';

import Event from './Event.vue';

export default {
    
    props: ['events', 'date_format', 'item_count'],

    components: {
        Carousel,
        Slide,
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