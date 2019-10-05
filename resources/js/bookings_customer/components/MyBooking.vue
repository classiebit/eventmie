<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 table-responsive">
                <table class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th class="col-xs-3">{{ trans('em.event') }}</th>
                            <th class="col-xs-2">{{ trans('em.ticket') }}</th>
                            <th class="col-xs-2">{{ trans('em.paid') }}</th>
                            <th class="col-xs-3">{{ trans('em.event') }} {{ trans('em.timings') }} </th>
                            <th class="col-xs-2">{{ trans('em.booked') }} {{ trans('em.on') }} </th>
                            <th class="col-xs-2">{{ trans('em.status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                        <tr v-for="(booking, index) in bookings" :key="index" >
                            <td><a :href="eventSlug(booking.event_slug)">{{ booking.event_title+' ('+booking.event_category+')' }}</a></td>
                            <td><strong>{{ ' x '+booking.quantity }}</strong></td>
                            <td>{{ trans('em.free') }}</td>
                            <td>
                                <p>{{
                                     moment(convert_date_to_local(booking.event_start_date)).format('MMM DD,YYYY')+' - '+moment(convert_date_to_local(booking.event_end_date)).format('MMM DD,YYYY')  
                                     }}
                                </p>
                                <p>{{ convert_time_to_local(booking.event_start_date, booking.event_start_time, 'hh:mm A')+' - '+convert_time_to_local(booking.event_end_date, booking.event_end_time, 'hh:mm A') }}</p>
                            </td>
                            <td>{{ moment(convert_date_to_local(booking.updated_at)).format('MMM DD,YYYY') }}</td>
                            <td>
                                <span class="lgx-badge" v-if="booking.status == 1">{{ trans('em.enabled') }}</span>
                                <span class="lgx-badge lgx-badge-danger" v-else>{{ trans('em.disabled') }}</span>
                            </td>
                        </tr>
                
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row" v-if="bookings.length > 0">
            <div class="col-md-12 text-center">
                <pagination-component v-if="pagination.last_page > 1" :pagination="pagination" :offset="pagination.total" :path="'/mybookings'" @paginate="getMyBookings()">
                </pagination-component>
            </div>
        </div>
    </div>
</template>


<script>

import PaginationComponent from '../../common_components/Pagination'
import mixinsFilters from '../../mixins.js';
var moment = require('moment');

export default {
    mixins:[
        mixinsFilters
    ],
    props: [
        // pagination query string
        'page',
    ],
    components: {
        PaginationComponent,
    },
    data() {
        return {
            bookings : [],
            moment   : moment,
            pagination: {
                'current_page': 1
            },
        }
    },
    computed: {
        current_page() {
            // get page from route
            if(typeof this.page === "undefined")
                return 1;
            return this.page;
        },
    },

    methods:{
          // get all events
        getMyBookings() {
            axios.get(route('eventmie.mybookings')+'?page='+this.current_page)
            .then(res => {
                this.bookings   = res.data.bookings.data;
                this.pagination = {
                    'total' : res.data.bookings.total,
                    'per_page' : res.data.bookings.per_page,
                    'current_page' : res.data.bookings.current_page,
                    'last_page' : res.data.bookings.last_page,
                    'from' : res.data.bookings.from,
                    'to' : res.data.bookings.to
                };
            })
            .catch(error => {});
        },

        // return route with event slug
        eventSlug(slug) {
            if(slug) 
                return route('eventmie.events_show',[slug]);
        }
    },
    mounted() {
        this.getMyBookings();
    }
}
</script>


