<!-- Event schedules-->
<template>
    <div class="col-xs-12">
        <!-- Single day non-repetitive event -->
        <div class="single-schedule">
            <div class="schedule-row d-inline-flex align-items-center bg-primary flex-wrap gap-2" id="buy_ticket_btn"
                @click="(!(moment(event.end_date+' '+event.end_time,'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD HH:mm:ss') < moment().format('YYYY-MM-DD HH:mm:ss'))) ? singleEvent() : null"
            >
                <!-- DATE -->
                <div class="schedule-col schedule-date">
                    <div class="fw-bold text-light">
                        {{ convert_date_to_local_format(userTimezone(event.start_date+' '+event.start_time, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD') ) }}
                    </div>
                </div>

                <!-- STATUS BADGE -->
                <div class="schedule-col schedule-status text-center">
                    <div v-if="moment(event.end_date +' '+event.end_time, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD HH:mm:ss') < moment().format('YYYY-MM-DD HH:mm:ss')" class="badge bg-danger">{{ trans('em.ended') }}</div>
                </div>

                <!-- TIME -->
                <div class="schedule-col schedule-time text-end">
                    <div class="badge bg-light text-dark">
                        {{ userTimezone(event.start_date+' '+event.start_time, 'YYYY-MM-DD HH:mm:ss').format(date_format.vue_time_format) }} - {{ userTimezone(event.end_date+' '+event.end_time, 'YYYY-MM-DD HH:mm:ss').format(date_format.vue_time_format) }} {{ showTimezone()  }}
                    </div>
                </div>

            </div>
            
        </div>

        <ticket-component 
            v-if="booking_date && start_time && end_time" 
            :event="event" 
            :is_admin="is_admin"
            :is_customer="is_customer"
            :max_ticket_qty="max_ticket_qty"
        >
        </ticket-component>

        
    </div>
</template>


<script>
import moment from 'moment-timezone';

import { mapState, mapMutations} from 'vuex';
import mixinsFilters from '../../mixins.js';
import TicketComponent from './TicketList.vue';

export default {

    props: [
        'event', 'max_ticket_qty',
        'date_format', 'is_customer', 'is_admin'
    ],

    mixins:[
        mixinsFilters
    ],

     components: {
        'ticket-component'  : TicketComponent
    },

    data() {
        return {
            moment              : moment,
            
            //CUSTOM
            tab_active_index: 0, // Default index
            
            //CUSTOM
            is_mounted:true,
            is_first_time:true,
        }
    },

    computed: {
        // get global variables
        ...mapState( ['booking_date', 'start_time', 'end_time', 'booking_end_date', 'booked_date_server' ]),
        
    },

    methods: {

        // update global variables
        ...mapMutations(['add', 'update']),
    
        //single event
        singleEvent() {
            this.triggerSignleDay();
            this.add({
                booking_date: moment(this.event.start_date, "YYYY-MM-DD").locale("en").format("dddd LL"),
                start_time: this.userTimezone(moment(this.event.start_date, "YYYY-MM-DD").format("YYYY-MM-DD") +" " +this.event.start_time,"YYYY-MM-DD HH:mm:ss").locale("en").format("HH:mm:ss"),
                end_time: this.userTimezone(moment(this.event.end_date, "YYYY-MM-DD").format("YYYY-MM-DD") +" " +this.event.end_time,"YYYY-MM-DD HH:mm:ss").locale("en").format("HH:mm:ss"),
            });
        },
    
        //  Single day non-repetitive event
        triggerSignleDay() {
            const hash = location.hash;
            if (hash != '#/checkout') {
                parent.location.hash = "/checkout";
            }
        },

        triggerCheckout() {
            const hash = location.hash;
            if(hash){

                const [hash2, query] = hash.split('#')[1].split('?');
                const params = Object.fromEntries(new URLSearchParams(query));

                // hash checkout
                if (hash == '#/checkout')
                    document.getElementById('buy_ticket_btn').click();

                // Query string width date params
                if(hash2 == '/checkout' && Object.keys(params).length > 0)
                    this.selectDates(params.booking_date, params.booking_end_date, params.start_time, params.end_time);

                let _this = this;
                setTimeout(() => {
                    _this.is_mounted = false; // Set is_mounted to false after the initial mount
                }, 10000); // Adjust the timeout as needed
            } else {
                // If no hash, set is_mounted to false immediately
                this.is_mounted = false;
            }
        },

       
        singleDefaultDate() {

            const endDateTime = moment( this.event.end_date, 'YYYY-MM-DD').format('YYYY-MM-DD');
            const today = moment().format('YYYY-MM-DD');

            // Return true if date is valid: not expired, has seats, and end date is not in the past
            
            if(endDateTime < today)
                return ;

            this.singleEvent();
        }
    
    },
    mounted() {
        this.triggerCheckout();
        this.singleDefaultDate();
    },
}
</script>