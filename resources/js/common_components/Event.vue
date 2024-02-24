<template>

    <div class="px-2 py-2 w-100">
        <!-- listing block -->
        <div>
            <div class="position-relative">
                <a  :href="eventSlug(event.slug)" class="text-inherit">
                    <div class="back-image rounded-3 img-hover" :style="{ 'background-image': 'url(/storage/' + event.thumbnail + ')' }"></div>
                </a>
                
                <!-- repetitive events who Upcoming  -->
                <span class="d-inline-flex badge bg-primary position-absolute top-0 ms-1 mt-2 start-0">
                    {{ changeDateFormat(userTimezone(event.start_date+' '+event.start_time, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD'), "YYYY-MM-DD") }}                        
                </span>
                    

            </div>
            <div class="rounded-bottom border-0 mb-lg-0">
                <div class="mt-3 mb-0">
                    <h5 class="text-left p-0 m-0">
                        <a  :href="eventSlug(event.slug)" class="text-inherit">
                        {{ event.title.substring(0, 30)+
                        `${event.title.length > 30 ? '...' : '' }`
                        }} 
                        </a>
                    </h5>
                </div>
                <div class="text-sm">
                    {{ event.category_name }}
                </div>  

                <div class="text-sm d-flex justify-content-between mt-2">
                    <div class="font-weight-semi-bold fw-light text-dark">
                        <span>
                            <i class="fas fa-map-marker-alt"></i>&nbsp;{{event.city}}
                        </span>
                    </div>
                    <div>
                        <span class="h6">{{ trans('em.free') }}</span>
                    </div>
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