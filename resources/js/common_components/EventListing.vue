<template>
    <div class="row">
                    
        <div class="col-12 col-sm-6 col-lg-4" 
            v-match-heights="{
                el: ['h5.sub-title'],  // Array of selectors to fix
            }"
            v-for="(event, index) in events" 
            :key="index"
        >
            <div class="lgx-event">
                <a :href="eventSlug(event.slug)" >

                    <!-- Upcomming -->
                    <div class="lgx-event__tag" 
                        v-if="moment().format('YYYY-MM-DD') < convert_date_to_local(event.start_date, 'YYYY-MM-DD')"
                    >
                        <span>{{ trans('em.upcoming') }}</span>
                        <span>{{countDays(moment().format("YYYY-MM-DD"), convert_date_to_local(event.start_date, "YYYY-MM-DD"))-1}} {{ trans('em.days') }}</span>
                    </div>

                    <!-- today-->
                    <div class="lgx-event__tag" 
                        v-if="moment().format('YYYY-MM-DD') == convert_date_to_local(event.start_date, 'YYYY-MM-DD') "
                    >
                        <span>{{ trans('em.event') }}</span>
                        <span>{{ trans('em.today') }}</span>
                    </div>

                     <!-- ended -->
                    <div class="lgx-event__tag" 
                        v-if="moment().format('YYYY-MM-DD') > convert_date_to_local(event.start_date,'YYYY-MM-DD')"
                    >
                        <span>{{ trans('em.event') }}</span>
                        <span>{{ trans('em.ended') }}</span>
                    </div>

                    <div class="lgx-event__image">
                        <img :src="'/storage/'+event.thumbnail" alt="">
                    </div>

                    <div class="lgx-event__info">
                        <div class="lgx-event__featured-left">
                            <span>{{ trans('em.free') }}</span>
                        </div>

                        <div class="meta-wrapper">
                            <span> {{changeDateFormat(convert_date_to_local(event.start_date), "YYYY-MM-DD")}}</span> 
                            <span>{{ changeDateFormat(convert_date_to_local(event.end_date), "YYYY-MM-DD")}} </span>
                            <span>{{event.city}}</span>
                        </div>
                        
                        <h3 class="title">{{ event.title }}</h3>
                        <h5 class="sub-title">{{ event.venue}}</h5>
                    </div>

                    <div class="lgx-event__footer">
                        <div>Free</div>
                    </div>

                    <div class="lgx-event__category">
                        <span>{{ event.category_name }}</span>
                    </div>
                </a>
            </div>
        </div>
        
    </div>
</template>

<script>
import VueMatchHeights from 'vue-match-heights';
 
Vue.use(VueMatchHeights);

import mixinsFilters from '../mixins.js';
var moment = require('moment');
export default {
    props: ['events'],
    mixins:[
        mixinsFilters
    ],
    data() {
        return {
            moment : moment,
        }
    },
    methods: {
    // return route with event slug
        eventSlug(slug){
            return route('eventmie.events_show',[slug]);
        }
    }
}
</script>