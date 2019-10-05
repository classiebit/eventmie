<template>
    <div>
        <!-- Button trigger modal -->
        <button class="lgx-btn lgx-btn-success text-center" type="button" @click="openModal = true"><i class="fas fa-ticket-alt"></i> {{ trans('em.get') }} {{ trans('em.tickets') }}</button>

        <div class="modal modal-mask" v-if="openModal">
            <div class="modal-dialog modal-container modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" @click="close()"><span aria-hidden="true">&times;</span></button>
                        <h3 class="title text-uppercase">{{ trans('em.booking') }}: {{ event.title }}</h3>
                    </div>

                    <form ref="form" @submit.prevent="validateForm" method="POST" >
                        <input type="hidden" class="form-control" name="event_id" :value="event.id" >
                        
                        <!-- only for admin -->
                        <div class="row ml-1" v-if="customers.length > 0">
                            <div class="col-md-4">
                                <div class="form-group text-left">
                                    <label class="text-left">{{ trans('em.select') }} {{ trans('em.customer') }}</label>
                                
                                    <select class="form-control" name="customer_id" v-model="customer_id"  v-validate="'required|decimal|is_not:0'">
                                        <option value="0">-- {{ trans('em.customer') }} --</option>
                                        <option :value="customer.id" v-for=" (customer, index) in customers" :key="index">{{customer.name }}</option>
                                    </select>
                                    <span v-show="errors.has('customer_id')" class="danger">
                                            {{ errors.first('customer_id') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        

                        <div class="row">
                            <div class="col-xs-12">
                                <ul class="list-group">
                                    <li class="list-group-item" >
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h3>{{ trans('em.free') }} {{ trans('em.ticket') }}</h3>
                                                <div class="form-group text-left">
                                                    <label class="text-left">{{ trans('em.select') }} {{ trans('em.quantity') }}</label>
                                                    <select class="form-control" name="quantity" v-model="quantity">
                                                        <option value="0" selected>0</option>
                                                        <option :value="itm" v-for=" (itm, ind) in max_ticket_qty"  :key="ind">{{itm }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <span class="badge bg-green"><strong>{{ quantity }}</strong></span>
                                        <h4>{{ trans('em.total') }} {{ trans('em.tickets') }}</h4>
                                    </li>
                                    <li class="list-group-item">
                                        <span class="badge bg-green"><strong>0</strong></span>
                                        <h4>{{ trans('em.order') }} {{ trans('em.total') }}</h4>
                                    </li>
                                    <li class="list-group-item">
                                        <span class="badge bg-blue"><strong>{{ trans('em.free') }} </strong></span>
                                        <h4>{{ trans('em.payment') }} {{ trans('em.method') }}</h4>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="row mt-2">
                            <div class="col-xs-12">
                                <button type="button" class="lgx-btn lgx-btn-red btn-block" @click="bookTickets()"><i class="fas fa-cash-register"></i> {{ trans('em.checkout') }}</button>
                            </div>
                        </div>
                        
                    </form>

                </div>
            </div>
        </div>

    </div>
</template>

<script>

import mixinsFilters from '../../mixins.js';

export default {
    mixins:[
        mixinsFilters
    ],
    props : [
        'customers', 'max_ticket_qty', 'event'
    ],
    data() {
        return {
            openModal           : false,
            quantity            : 1,
            customer_id         : 0,
        }
    },
    methods: {
        // reset form and close modal
        close: function () {    
            this.quantity       = 1;
            this.openModal      = false;
        },
        bookTickets(){
            // prepare form data for post request
            let post_url = route('eventmie.bookings_book_tickets');
            let post_data = new FormData(this.$refs.form);
            
            // axios post request
            axios.post(post_url, post_data)
            .then(res => {
                // if booking success
                if(res.data.status && res.data.message != '' && res.data.url != '') {
                    // close popup
                    this.close();
                    
                    this.showNotification('success', trans('em.congrats')+' '+trans('em.booking')+' '+trans('em.successful'));
                    setTimeout(() => {
                        window.location.href = res.data.url;    
                    }, 2000);
                }
            })
            .catch(error => {
                // only in case or serverValidate
                if (error.length) {
                    this.serverValidate(error);
                }
            });
        },
        // validate data on form submit
        validateForm(e) {
            this.$validator.validateAll().then((result) => {
                if (result) {
                    this.formSubmit(e);
                }
            });
        },
        // show server validation errors
        serverValidate(serrors) {
            this.$validator.validateAll().then((result) => {
                this.$validator.errors.add(serrors);
            });
        },
    },
}
</script>