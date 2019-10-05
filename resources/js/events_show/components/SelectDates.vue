<template>
    <div class="col-xs-12">
        <div class="row">
            <div class="col-md-12 text-center">
                <ticket-component 
                    :event="event" 
                    :customers="customers" 
                    :max_ticket_qty="max_ticket_qty" 
                >
                </ticket-component>
            </div>
        </div>
    </div>
</template>


<script>

import TicketComponent from './TicketList.vue';

export default {
    props: [
        'event' ,'max_ticket_qty'
    ],
    components: {
        'ticket-component'  : TicketComponent
    },
    data() {
        return {
            modal_active        : 0,
            customers          : [],
        }
    },
    methods: {
        // get customers for admin
        getCustomers(){
            axios.post(route('eventmie.bookings_get_customers'), {
                'event_id' : this.event.id,
            })
            .then(res => {
                if(res.data.status)
                    this.customers   = res.data.customers;
            })
            .catch(error => {});
        },
    },
    mounted() {
        this.getCustomers();
    },  
}
</script>