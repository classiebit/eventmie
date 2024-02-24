<template>
    <div>
                    
        <form ref="form" @submit.prevent="validateForm" method="POST" enctype="multipart/form-data"  class="lgx-contactform">
            <input type="hidden" name="event_id" v-model="event_id">
            
            <div class="row">

                <div class="col-xs-12 col-sm-4 col-md-6">
                    <div class="form-group mb-3">
                        <label class="form-label" for="start_date">{{ trans('em.start_date') }}</label>
                        <date-picker 
                            v-model="start_date" 
                            type="date" 
                            format="YYYY-MM-DD" 
                            :placeholder="trans('em.start_date')"
                            class="form-control"
                            :lang="$vue2_datepicker_lang"
                        ></date-picker>
                        <input type="hidden" class="form-control"  :value="convert_date(start_date)" name="start_date"  v-validate="'required'">
                        <span v-show="errors.has('start_date')" class="help text-danger">{{ errors.first('start_date') }}</span>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-4 col-md-6">
                    <div class="form-group mb-3">
                        <label class="form-label" for="start_time">{{ trans('em.start_time') }}</label>
                        <date-picker 
                            v-model="start_time" 
                            type="time" 
                            format="HH:mm" 
                            :placeholder="trans('em.start_time')"
                            class="form-control"
                            :lang="$vue2_datepicker_lang"
                        ></date-picker>
                        <input type="hidden" class="form-control"  :value="convert_time(start_time)" name="start_time"  v-validate="'required'">
                        <span v-show="errors.has('start_time')" class="help text-danger">{{ errors.first('start_time') }}</span>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-4 col-md-6">
                    <div class="form-group mb-3">
                        <label class="form-label" for="end_date">{{ trans('em.end_date') }}</label>
                        <date-picker 
                            v-model="end_date" 
                            type="date" 
                            format="YYYY-MM-DD"
                            :placeholder="trans('em.end_date')"
                            class="form-control"
                            :lang="$vue2_datepicker_lang"
                        ></date-picker>
                        <input type="hidden" class="form-control"  :value="convert_date(end_date)" name="end_date"  v-validate="'required'">
                        <span v-show="errors.has('end_date')" class="help text-danger">{{ errors.first('end_date') }}</span>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-4 col-md-6">
                    <div class="form-group mb-3">
                        <label class="form-label" for="end_time">{{ trans('em.end_time') }}</label>
                        <date-picker 
                            v-model="end_time" 
                            type="time" 
                            format="HH:mm" 
                            :placeholder="trans('em.end_time')"
                            class="form-control"
                            :lang="$vue2_datepicker_lang"
                        ></date-picker>
                        <input type="hidden" class="form-control"  :value="convert_time(end_time)" name="end_time" 	 v-validate="'required'">
                        <span v-show="errors.has('end_time')" class="help text-danger">{{ errors.first('end_time') }}</span> 
                    </div>
                </div>

            </div>

            <div class="alert alert-danger" v-if="moment(start_date).format('YYYY-MM-DD') <= moment().format('YYYY-MM-DD') ||
                moment(start_date).format('YYYY-MM-DD') > moment(end_date).format('YYYY-MM-DD') "
                >
                <span class="text-danger"> {{ trans('em.date_info') }}</span>
            </div>

            <div class="row">
                <div class="col-md-12" 
                    v-if="check_date(start_date) && check_date(end_date) && check_time(start_time) && check_time(end_time)"
                >
                    <div class="alert alert-primary">
                        <p class="text-primary fw-bold">{{ trans('em.start') }} {{ changeDateFormat(start_date, "YYYY-MM-DD") }} {{ trans('em.till') }} {{ changeDateFormat(end_date, "YYYY-MM-DD") }}</p>
                        <hr>
                        <!-- In case of simple : total hours (from start date to end date) -->
                        <p class="mb-0">
                            <strong>{{ trans('em.duration') }} </strong> 
                            {{ countDays(start_date, end_date)+(countDays(start_date, end_date) > 1 ? ' days' : ' day')  }}
                            &nbsp;|&nbsp;
                            
                            {{ 
                                counthours(moment(start_date).format('YYYY-MM-DD') +' '+ moment(start_time).format('HH:mm:ss '),
                                        moment(end_date).format('YYYY-MM-DD')+' '+ moment(end_time).format('HH:mm:ss ')) + 
                                (counthours(moment(start_date).format('YYYY-MM-DD') +' '+ moment(start_time).format('HH:mm:ss '),
                                        moment(end_date).format('YYYY-MM-DD')+' '+ moment(end_time).format('HH:mm:ss ')) > 1 ? ' hours' : ' hour')
                            }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary mt-2 btn-lg"><i class="fas fa-sd-card"></i> {{ trans('em.save') }}</button>
                </div>
            </div>
            
        </form>
                
    </div>
</template>

<script>
import { mapState, mapMutations} from 'vuex';
import mixinsFilters from '../../mixins.js';

export default {

    props: [
        'server_timezone'
    ],

    mixins:[
        mixinsFilters
    ],

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
        ...mapState( ['event_id', 'event', 'is_dirty']),
    },

    methods: {
        // update global variables
        ...mapMutations(['add', 'update']),

        // reset form and close modal
        close: function () {
            this.$refs.form.reset();
        },
        editEvent() {
            // server timezone change to local timezone
            this.convert_to_local_tz();

            this.start_date  = this.setDateTime(this.local_start_date);
            this.end_date    = this.setDateTime(this.local_end_date);
            this.start_time  = this.setDateTime(this.local_start_time);
            this.end_time    = this.setDateTime(this.local_end_time);
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
                'start_date'       : moment(this.start_date,"YYYY-MM-DD").locale('en').format('YYYY-MM-DD'),
                'end_date'         : moment(this.end_date,"YYYY-MM-DD").locale('en').format('YYYY-MM-DD'),
                'start_time'       : moment(this.start_time).locale('en').format('HH:mm:ss'),
                'end_time'         : moment(this.end_time).locale('en').format('HH:mm:ss'),
                'event_id'         : this.event_id,
            };
            
            // axios post request
            axios.post(post_url, post_data)
            .then(res => {
                
                if(res.data.status)
                {
                    this.showNotification('success', trans('em.timings')+' '+trans('em.event_save_success'));
                }
                // reload page   
                setTimeout(function() {
                    location.reload(true);
                }, 1000);
                
            })
            .catch(error => {
                let serrors = Vue.helpers.axiosErrors(error);
                if (serrors.length) {
                    this.serverValidate(serrors);
                }
            });
        },

        // server time convert into local timezone
        convert_to_local_tz(){
            this.local_start_date   = this.userTimezone(this.event.start_date+' '+this.event.start_time, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD');
            this.local_end_date     = this.userTimezone(this.event.end_date+' '+this.event.end_time, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD');
            this.local_start_time   = this.userTimezone(this.event.start_date+' '+this.event.start_time, 'YYYY-MM-DD HH:mm:ss');
            this.local_end_time     = this.userTimezone(this.event.end_date+' '+this.event.end_time, 'YYYY-MM-DD HH:mm:ss');
        },

        // check valid date 
        isDirty() {
            this.add({is_dirty: true});
        },
        isDirtyReset() {
            this.add({is_dirty: false});
        },


    },
    
    mounted(){
        this.isDirtyReset();
        // if user have no event_id then redirect to details page
        let event_step  = this.eventStep();
        
        if(event_step)
        {
            var $this = this;
            this.getMyEvent().then(function (response){
                if(Object.keys($this.event).length)
                    $this.editEvent();
            });
        }

    }
    
}
</script>