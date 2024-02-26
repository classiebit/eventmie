<!-- Event schedules-->
<template>
    <div class="col-xs-12">
        <div class="row">
            <div class="col-md-12">
                <ticket-component 
                    :event="event" 
                    :is_customer="is_customer"
                    :is_admin="is_admin"
                    :max_ticket_qty="max_ticket_qty" 
                >
                </ticket-component>
            </div>
        </div>
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
            modal_active        : 0,
        }
    },

    computed: {
        // get global variables
        ...mapState( ['booking_date', 'start_time', 'end_time']),
        
    },

    methods: {

          // update global variables
        ...mapMutations(['add', 'update']),

        //single event
        singleEvent(){
            console.log('hello world');
            this.add({
                booking_date        : moment(this.event.start_date, "YYYY-MM-DD").format('dddd LL'),
                start_time          : this.userTimezone(this.event.start_date+' '+this.event.start_time, 'YYYY-MM-DD HH:mm:ss').format('HH:mm:ss'),
                end_time            : this.userTimezone(this.event.end_date+' '+this.event.end_time, 'YYYY-MM-DD HH:mm:ss').format('HH:mm:ss'),
            })
            console.log('hello world start', this.start_time);
            console.log('hello world end', this.end_time);
        },
    },
    mounted() {
        this.singleEvent();
    },  
}
</script>