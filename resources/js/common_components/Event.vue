<template>

    <div class="px-2 px-lg-3 py-2 w-100">
        <!-- listing block -->
        <div>
            <div class="position-relative">
                <div class="card-top d-flex justify-content-between align-items-center py-1 rounded-3 rounded-bs-0 rounded-be-0">
                    <!-- repetitive events who Upcoming top-left -->
                    <span class="badge text-white">
                        {{ changeDateFormat(userTimezone(event.start_date+' '+event.start_time, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD'), "YYYY-MM-DD") }}
                    </span>

                    <!-- event ended -->
                    <span class="d-inline-flex badge bg-danger" 
                        v-if="moment().format('YYYY-MM-DD') > userTimezone(event.end_date+' '+event.end_time, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD')">
                        <i class="fas fa-ban"></i> &nbsp;{{ trans('em.ended') }}
                    </span>
                </div>

                <a  :href="eventSlug(event.slug)" class="text-inherit">
                    <div class="thumb-img-bg rounded-3 prevent_draggable rounded-ts-0 rounded-te-0" 
                         :style="{ 'background-image': `url(${getImageUrl(event.thumbnail)})`}" >
                        <img class="thumb-img prevent_draggable" :src="getImageUrl(event.thumbnail)" :alt="event.title" />
                    </div>
                </a>
                
                
            </div>
            <div class="rounded-bottom border-0 mb-lg-0">
                <div class="d-flex justify-content-between">
                    <div class="card-category text-gray-700">
                        <small>{{ event.category_name }}</small>
                    </div>  
                </div>
                
                <div>
                    <h2 class="h6 text-left p-0 m-0 fw-bold lh-p2">
                        <a  :href="eventSlug(event.slug)" class="text-inherit">
                        {{ event.title.substring(0, 76) }} 
                        </a>
                    </h2>
                </div>
                
                <div class="card-venue">
                    <span><i class="fas fa-map-marker-alt"></i>&nbsp;{{event.city}}</span>
                </div>
                
                <hr class="card-hr">
                <div class="d-flex justify-content-between" >
                    <span class="h6 lh-p2 fw-semibold">{{ trans('em.free') }}</span>
                </div>    
                
            </div>
        </div>
        <!-- listing block -->
    </div>
           
   
</template>

<script>

import mixinsFilters from '../mixins.js';

export default {
    
    props: ['event', 'date_format'],


    mixins:[
        mixinsFilters
    ],

    data() {
        return {
        }
    },

    methods:{
        
        // return route with event slug
        eventSlug: function eventSlug(slug) {
            return route('eventmie.events_show', [slug]);
        }

  
    },

    mounted(){      
    }

}
</script>