<template>
<div>
    <!-- Button trigger modal -->
    <div class="d-grid">
        <button class="btn btn-primary btn-lg" type="button" @click="openModal = true"><i class="fas fa-ticket-alt"></i> {{ trans('em.get_tickets') }}</button>
    </div>
    <div class="custom_model">
        <div class="modal show" v-if="openModal">
            <div class="modal-dialog modal-xl model-extra-large">
                
                <div class="modal-content">
                    <div class="modal-header text-center border-0">
                        <div class="modal-title w-100">
                            <div>
                                <h5 class="mb-0 h3">{{ event.title }}</h5>

                                <ul class="list-group list-group-horizontal list-group-flush justify-content-center">
                                    <li class="list-group-item text-sm border-0 px-0 pe-sm-3">
                                        <small><i class="fas fa-location-dot text-primary"></i> {{ event.venue }}</small>
                                        &nbsp;
                                    </li>
                                    <li class="list-group-item text-sm border-0 px-0 pe-sm-3">
                                        <small><i class="fas fa-calendar-day text-primary"></i> {{ serverTimezone(moment(booking_date).format('dddd LL')+' '+start_time, 'dddd LL HH:mm a').locale('en').format('Y-MM-DD') }}</small>
                                        &nbsp;
                                    </li>
                                    <li class="list-group-item text-sm border-0 px-0 pe-sm-3">
                                        <small><i class="fas fa-clock text-primary"></i> {{ changeTimeFormat(start_time) }} {{ showTimezone() }}</small>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close" @click="close()"></button>
                    </div>
                    
                    <div class="modal-body">
                        <form ref="form" @submit.prevent="validateForm" method="POST" >
                            
                            <input type="hidden" class="form-control" name="event_id" :value="event.id" >
                            <input type="hidden" class="form-control" name="booking_date" :value="serverTimezone(booking_date+' '+start_time, 'dddd LL HH:mm a').format('YYYY-MM-DD')" >
                            <input type="hidden" name="customer_id" v-model="customer_id" v-validate="'required'" >

                            <div class="px-lg-3">
                                <!-- only for admin -->
                                <div class="row" v-if="is_admin > 0">
                                    <div class="col-md-4 mb-3">
                                        <div>
                                            <label class="form-label h6" for="customer_id">{{ trans('em.select_customer') }}</label>
                                            <v-select 
                                                label="name" 
                                                class="form-control px-0 py-0 border-0 mb-2" 
                                                :placeholder="trans('em.search_customer_email')"
                                                v-model="customer" 
                                                :required="!customer" 
                                                :filterable="false" 
                                                :options="options" 
                                                @search="onSearch" 
                                            ><div slot="no-options">{{ trans('em.customer_not_found') }}</div></v-select>
                                            <div class="invalid-feedback danger" v-show="errors.has('customer_id')">{{ errors.first('customer_id') }}</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tickets -->
                                <div class="row">
                                    <div class="col-6">
                                        <h4 class="mb-2 h4">{{ trans('em.free') }} {{ trans('em.ticket') }}</h4>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group text-left">
                                            <select class="form-control form-control-lg" name="quantity" v-model="quantity">
                                                <option value="0" selected>--{{ trans('em.select_tickets') }}--</option>
                                                <option :value="itm" v-for=" (itm, ind) in max_ticket_qty"  :key="ind">{{itm }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <p class="mb-2 h6">{{ trans('em.cart') }}</p>
                                        <ul class="list-group">
                                            <li class="list-group-item mb-3 rounded border-2">
                                                <div class="d-flex justify-content-between">
                                                    <h6 class="my-0"><strong>{{ trans('em.total_tickets') }}</strong></h6>
                                                    <strong :class="{'ticket-selected-text': quantity > 0 }">{{ quantity }}</strong>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <h6 class="my-0"><strong>{{ trans('em.total_order') }}</strong></h6>
                                                    <strong> 0 </strong>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                

                                <!-- Payment -->
                                <div class="row" v-if="quantity > 0">
                                    <div class="col-12">
                                        <p class="mb-2 h6">{{ trans('em.payment')+' '+trans('em.free') }}</p>
                                    </div>
                                    <div class="col-12 mt-2 pb-4">
                                        <div class="d-grid">
                                            <div class="btn-group btn-group-md btn-block  btn-group-justified">
                                                <button :class="{ 'disabled' : disable }" :disabled="disable" type="button" class="btn btn-primary btn-lg btn-block text-white" @click="bookTickets()"><i class="fas fa-cash-register"></i> {{ trans('em.checkout') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </form>
                        
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</template>

<script>

import { mapState} from 'vuex';
import mixinsFilters from '../../mixins.js';
import _ from 'lodash';

export default {
    
    mixins:[
        mixinsFilters
    ],
    props : [
        'max_ticket_qty', 
        'event', 
        'customer', 
        'is_customer', 
        'is_admin', 
        
    ],

    data() {
        return {
            openModal           : false,
            moment              : moment,
            quantity            : 0,
            customer_id         : 0,
            options             : [],
        }
    },

    computed: {
        // get global variables
        ...mapState( ['booking_date', 'start_time', 'end_time']),
    },

    methods: {
        // reset form and close modal
        close: function () {    
            this.quantity       = 1;
            this.openModal      = false;
        },

        bookTickets(){
            // show loader
            this.showLoaderNotification(trans('em.processing'));

            // prepare form data for post request
            this.disable = true;

            let post_url = route('eventmie.bookings_book_tickets');
            let post_data = new FormData(this.$refs.form);
            
            // axios post request
            axios.post(post_url, post_data)
            .then(res => {
                
                if(res.data.status && res.data.message != ''  && typeof(res.data.message) != "undefined") {
                   
                    // hide loader
                    Swal.hideLoading();

                    // close popup
                    this.close();
                    this.showNotification('success', res.data.message);
                    
                }
                else if(!res.data.status && res.data.message != '' && res.data.url != ''  && typeof(res.data.url) != "undefined"){
                    
                    // hide loader
                    Swal.hideLoading();
                    
                    // close popup
                    this.close();
                    this.showNotification('error', res.data.message);
                    
                    setTimeout(() => {
                        window.location.href = res.data.url;    
                    }, 1000);
                }

                if(res.data.url != '' && res.data.status  && typeof(res.data.url) != "undefined") {
                    
                    // hide loader
                    Swal.hideLoading();

                    setTimeout(() => {
                        window.location.href = res.data.url;    
                    }, 1000);
                }

                if(!res.data.status && res.data.message != ''  && typeof(res.data.message) != "undefined") {
                   
                    // hide loader
                    Swal.hideLoading();

                    // close popup
                    this.close();
                    this.showNotification('error', res.data.message);
                    
                }

            })
            .catch(error => {
                this.disable = false;
                let serrors = Vue.helpers.axiosErrors(error);
                if (serrors.length) {
                    
                    this.serverValidate(serrors);
                    
                }
            });
        },
        

        // validate data on form submit
        validateForm(e) {
            this.$validator.validateAll().then((result) => {
                if (result) {
                    this.disable = true;
                    this.formSubmit(e);
                }
                else{
                    this.disable = false;
                }
            });
        },

        // show server validation errors
        serverValidate(serrors) {
            this.disable = false;
            this.$validator.validateAll().then((result) => {
                this.$validator.errors.add(serrors);
            });
        },

        // get customers

        getCustomers(loading, search = null){
            var postUrl     = route('eventmie.get_customers');
            var _this       = this;
            axios.post(postUrl,{
                'search' :search,
            }).then(res => {
                
                var promise = new Promise(function(resolve, reject) { 
                    
                    _this.options = res.data.customers;
                    
                    resolve(true);
                }) 
                
                promise 
                    .then(function(successMessage) { 
                        loading(false);
                    }, function(errorMessage) { 
                    //error handler function is invoked 
                        console.log(errorMessage); 
                    }) 
            })
            .catch(error => {
                let serrors = Vue.helpers.axiosErrors(error);
                if (serrors.length) {
                    this.serverValidate(serrors);
                }
            });
        },
        
        // v-select methods
        onSearch(search, loading) {
            loading(true);
            this.search(loading, search, this);
        },

        // v-select methods
        search: _.debounce((loading, search, vm) => {
            
            if(vm.validateEmail(search))
                vm.getCustomers(loading, search);
            else
                loading(false);    
            
        }, 350),

        validateEmail(email) {
            const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        },
        scrollToBottom() {
            this.$refs["bottom-down"].scrollIntoView({ block: "end", inline: "nearest" })
        },

    },

    watch: {
        // active when customer search 
        customer: function () {
            this.customer_id = this.customer != null ?  this.customer.id : null;
        },
    
    },
}
</script>