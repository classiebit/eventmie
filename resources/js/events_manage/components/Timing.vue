<template>
    <div class="tab-pane active">
        <div class="panel-group">
            <div class="panel panel-default lgx-panel">
                <div class="panel-heading">
                    <form ref="form" @submit.prevent="validateForm" method="POST" enctype="multipart/form-data"  class="lgx-contactform">
                        <input type="hidden" name="event_id" v-model="event_id">
                        
                        <div class="row">

                            <div class="col-xs-12 col-sm-4 col-md-6">
                                <div class="form-group">
                                    <label for="start_date">{{ trans('em.start') }} {{ trans('em.date') }}</label>
                                    <date-picker 
                                        v-model="start_date" 
                                        lang="en" 
                                        type="date" 
                                        format="YYYY-MM-DD" 
                                        placeholder="Select Start Date"
                                        :class="'form-control'"
                                        
                                    ></date-picker>
                                    <input type="hidden" class="form-control"  :value="convert_date(start_date)" name="start_date"  v-validate="'required'">
                                    <span v-show="errors.has('start_date')" class="help text-danger">{{ errors.first('start_date') }}</span>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-4 col-md-6">
                                <div class="form-group">
                                    <label for="start_time">{{ trans('em.start') }} {{ trans('em.time') }}</label>
                                    <date-picker 
                                        v-model="start_time" 
                                        lang="en" 
                                        type="time" 
                                        format="HH:mm:ss" 
                                        placeholder="Select Start Time" 
                                        :class="'form-control'"
                                    ></date-picker>
                                    <input type="hidden" class="form-control"  :value="convert_time(start_time)" name="start_time"  v-validate="'required'">
                                    <span v-show="errors.has('start_time')" class="help text-danger">{{ errors.first('start_time') }}</span>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-4 col-md-6">
                                <div class="form-group">
                                    <label for="end_date">{{ trans('em.end') }} {{ trans('em.date') }}</label>
                                    <date-picker 
                                        v-model="end_date" 
                                        lang="en" 
                                        type="date" 
                                        format="YYYY-MM-DD"
                                        placeholder="Select End Date" 
                                        :class="'form-control'"
                                    ></date-picker>
                                    <input type="hidden" class="form-control"  :value="convert_date(end_date)" name="end_date"  v-validate="'required'">
                                    <span v-show="errors.has('end_date')" class="help text-danger">{{ errors.first('end_date') }}</span>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-4 col-md-6">
                                <div class="form-group">
                                    <label for="end_time">{{ trans('em.end') }} {{ trans('em.time') }}</label>
                                    <date-picker 
                                        v-model="end_time" 
                                        lang="en" 
                                        type="time" 
                                        format="HH:mm:ss" 
                                        placeholder="Select End Time" 
                                        :class="'form-control'"
                                    ></date-picker>
                                    <input type="hidden" class="form-control"  :value="convert_time(end_time)" name="end_time" 	 v-validate="'required'">
                                    <span v-show="errors.has('end_time')" class="help text-danger">{{ errors.first('end_time') }}</span> 
                                </div>
                            </div>

                        </div>

                        <div v-if="moment(start_date).format('YYYY-MM-DD') <= moment().format('YYYY-MM-DD') ||
                            moment(start_date).format('YYYY-MM-DD') > moment(end_date).format('YYYY-MM-DD') "
                         >
                            <hr><label class="text-info"> {{ trans('em.date_info') }}</label><hr>
                        </div>

                        <div class="row">
                            <div class="col-md-12" 
                                v-if="check_date(start_date) && check_date(end_date) && check_time(start_time) && check_time(end_time)"
                            >
                                <p class="text">{{ trans('em.start') }} {{ changeDateFormat(start_date, "YYYY-MM-DD") }} {{ trans('em.till') }} {{ changeDateFormat(end_date, "YYYY-MM-DD") }}</p>
                                
                                <!-- In case of simple : total hours (from start date to end date) -->
                                <h4 class="location">
                                    <strong>{{ trans('em.duration') }} </strong> 
                                    {{ 
                                        countDays(start_date, end_date) + 
                                        (countDays(start_date, end_date) > 1 ? ' days' : ' day')  
                                    }}
                                </h4>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn lgx-btn btn-block"><i class="fas fa-sd-card"></i> {{ trans('em.save') }}</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState, mapMutations} from 'vuex';
import DatePicker from 'vue2-datepicker';

import mixinsFilters from '../../mixins.js';

var moment = require('moment');

DatePicker.methods.displayPopup = function () {
  this.position = {
    left: 0,
    top: '100%'
  }
}

export default {
    props: [],
    mixins:[
        mixinsFilters
    ],
    components: {
        DatePicker, 
    },
    data() {
        return {
            moment              : moment,

            // important!!! declare all form fields
            start_time          : null,
            end_time            : null,
            start_date          : null,
            end_date            : null,
            
            //local timezone
            local_start_date   : null,
            local_end_date     : null,
            local_start_time   : null,
            local_end_time     : null,
        }
    },
    computed: {
        // get global variables
        ...mapState( ['event_id', 'event']),
    },

    methods: {
        // update global variables
        ...mapMutations(['add']),

        // reset form and close modal
        close: function () {
            this.$refs.form.reset();
        },
        editEvent() {
            // server timezone change to local timezone
            this.convert_to_local_tz();

            this.start_date  = this.local_start_date;
            this.end_date    = this.local_end_date;
            this.start_time  = this.local_start_time;
            this.end_time    = this.local_end_time;
        },
        // validate data on form submit
        validateForm(event) {
            this.$validator.validateAll().then((result) => {
                if (result) {
                    this.formSubmit(event);            
                }
            });
        },
        // show server validation errors
        serverValidate(serrors) {
            this.$validator.validateAll().then((result) => {
                this.$validator.errors.add(serrors);
            });
        },

        // submit form
        formSubmit(event) {
            // prepare form data for post request
            let post_url = route('eventmie.myevents_store_timing');
   
            let post_data = {
                // start_date
                'start_date'       : this.convert_date(this.start_date),
                'end_date'         : this.convert_date(this.end_date),
                'start_time'       : this.convert_time(this.start_time),
                'end_time'         : this.convert_time(this.end_time),
                'event_id'         : this.event_id,
            };
            
            // axios post request
            axios.post(post_url, post_data)
            .then(res => {
                
                if(res.data.status) {
                    this.showNotification('success', trans('em.timings')+' '+trans('em.saved')+' '+trans('em.successfully'));
                }
                // reload page   
                setTimeout(function() {
                    location.reload(true);
                }, 1000);
                
            })
            .catch(error => {
                // only in case or serverValidate
                if (error.length) {
                    this.serverValidate(error);
                }
            });
        },

        // server time convert into local timezone
        convert_to_local_tz(){
            this.local_start_date   = this.convert_date_to_local(this.event.start_date);
            this.local_end_date     = this.convert_date_to_local(this.event.end_date);
            this.local_start_time   = this.convert_time_to_local(this.event.start_date, this.event.start_time);
            this.local_end_time     = this.convert_time_to_local(this.event.end_date, this.event.end_time);
        },
    },
    mounted(){
        // if user have no event_id then redirect to details page
        let event_step  = this.eventStep();
        if(event_step)
        {
            var $this = this;
            this.getMyEvent().then(function (response){
                if(Object.keys($this.event).length) {
                    $this.editEvent();
                }
            });
        }

    }
    
}
</script>