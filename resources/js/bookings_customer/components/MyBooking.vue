<template>
    <div class="container-fluid">
        <div class="row py-5">
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header p-4 bg-white border-bottom-0"></div>
                    <div class="table-responsive">
                        <table class="table text-wrap table-hover">
                            <thead class="table-light text-nowrap">
                                <tr>
                                    <th class="border-top-0 border-bottom-0">{{ trans('em.event') }}</th>
                                    <th class="border-top-0 border-bottom-0">{{ trans('em.ticket') }}</th>
                                    <th class="border-top-0 border-bottom-0">{{ trans('em.paid') }} </th>
                                    <th class="border-top-0 border-bottom-0">{{ trans('em.booked_on') }} </th>
                                    <th class="border-top-0 border-bottom-0">{{ trans('em.status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(booking, index) in bookings" :key="index" >
                                    <td :data-title="trans('em.event')">
                                        <div class="d-flex align-items-center">
                                            <a :href="eventSlug(booking.event_slug)"> 
                                                <img :src="'/storage/'+booking.event_thumbnail" :alt="booking.event_title" class="rounded img-4by3-md ">
                                            </a>
                                            <div class="ms-3 lh-1">
                                                <h5 class="mb-1"> 
                                                    <a :href="eventSlug(booking.event_slug)" class="text-inherit text-wrap">{{ booking.event_title }}</a>
                                                </h5>
                                                <p class="text-mute">
                                                    <small class="text-muted" v-if="booking.event_start_date != booking.event_end_date">
                                                        {{ moment(userTimezone(booking.event_start_date+' '+booking.event_start_time, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD')).format(date_format.vue_date_format) }}
                                                    </small>
                                                    <small class="text-muted" v-else>
                                                        {{ moment(userTimezone(booking.event_start_date+' '+booking.event_start_time,'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD')).format(date_format.vue_date_format) }}
                                                    </small>
                                                    
                                                    <small class="text-muted">
                                                        {{ userTimezone(booking.event_start_date+' '+booking.event_start_time, 'YYYY-MM-DD HH:mm:ss').format(date_format.vue_time_format) }}
                                                    </small>
                                                    <small class="text-muted"> 
                                                        {{ showTimezone() }}
                                                    </small>
                                                </p>

                                                <p>
                                                    <small class="text-success fw-bold">{{ trans('em.order_id') }}: #{{ booking.order_number }}</small>
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td class="align-middle" :data-title="trans('em.ticket')"><i class="fas fa-ticket"></i> {{ booking.event_title }} <strong>{{ ' x '+booking.quantity }}</strong></td>
                                    <td class="align-middle" :data-title="trans('em.order_total')">{{ trans('em.free') }} </td>
                                    <td class="align-middle" :data-title="trans('em.booked_on')">{{ moment(userTimezone(booking.created_at, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD')).format(date_format.vue_date_format) }} {{ showTimezone() }}</td>
                                    <td class="align-middle" :data-title="trans('em.status')">
                                        <span class="badge bg-success text-white" v-if="booking.status == 1 && booking.expired == 0">{{ trans('em.active') }}</span>
                                        <span class="badge bg-danger text-white" v-else>{{ trans('em.inactive') }}</span>
                                    </td>
                                </tr>

                                <tr v-if="bookings.length <= 0">
                                    <td colspan="10" class="text-center align-middle">{{ trans('em.no_bookings') }}</td>
                                </tr>
                        
                            </tbody>
                        </table>
                    </div>
                    <div class="px-4 pb-4" v-if="bookings.length > 0">
                
                        <pagination-component v-if="pagination.last_page > 1" :pagination="pagination" :offset="pagination.total" :path="'/mybookings'" @paginate="getMyBookings()">
                        </pagination-component>
            
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>

import PaginationComponent from '../../common_components/Pagination'
import mixinsFilters from '../../mixins.js';

export default {
    
    mixins:[
        mixinsFilters
    ],

    props: [
        // pagination query string
        'page',
        'is_success',
        'date_format',
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
            .catch(error => {
                
            });
        },

        // return route with event slug
        eventSlug(slug) {
            if(slug) {
                return route('eventmie.events_show',[slug]);
            }
        },
       
    },
    mounted() {
        this.getMyBookings();
    }
}
</script>


