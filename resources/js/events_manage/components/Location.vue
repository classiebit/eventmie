<template>
    <div class="tab-pane active">
        <div class="panel-group">
            <div class="panel panel-default lgx-panel">
                <div class="panel-heading">
                    <form ref="form" @submit.prevent="validateForm" method="POST" enctype="multipart/form-data" class="lgx-contactform">
                        <input type="hidden" name="event_id" v-model="event_id">

                        <div class="mb-3">
                            <label class="form-label" for="venue">{{ trans('em.venue') }}</label>
                            <input type="text" class="form-control" name="venue" v-validate="'required'" v-model="venue">
                            <span v-show="errors.has('venue')" class="help text-danger">{{ errors.first('venue') }}</span>
                        </div>   
                        
                        <div class="mb-3">
                            <label class="form-label">{{ trans('em.address') }}</label>
                            <textarea class="form-control" rows="3" name="address" v-validate="'required'" v-model="address"></textarea>
                            <span v-show="errors.has('address')" class="help text-danger">{{ errors.first('address') }}</span>
                        </div>   

                        <div class="mb-3">
                            <label class="form-label"  for="city">{{ trans('em.city') }}</label>
                            <input type="text" class="form-control"  name="city" v-validate="'required'" v-model="city">
                            <span v-show="errors.has('city')" class="help text-danger">{{ errors.first('city') }}</span>
                        </div>     
                        
                        <div class="mb-3">
                            <label class="form-label" for="state">{{ trans('em.state') }}</label>
                            <input type="text" class="form-control"  name="state" v-validate="'required'" v-model="state">
                            <span v-show="errors.has('state')" class="help text-danger">{{ errors.first('state') }}</span>
                        </div>     
                        
                        <div class="mb-3">
                            <label class="form-label" for="zipcode">{{ trans('em.zipcode') }}</label>
                            <input type="text" class="form-control"  name="zipcode" v-validate="'required'" v-model="zipcode">
                            <span v-show="errors.has('zipcode')" class="help text-danger">{{ errors.first('zipcode') }}</span>
                        </div>     
                            
                        <div class="mb-3">
                            <label class="form-label" for="country_id">{{ trans('em.select') }} {{ trans('em.country') }}</label>
                            <select name="country_id" class="form-control" v-model="country_id" v-validate="'required|decimal|is_not:0'" >
                                <option value="0">-- {{ trans('em.country') }} --</option>
                                <option  v-for="(country, index) in countries" :key = "index" :value="country.id">{{country.country_name}}</option>
                            </select>
                            <span v-show="errors.has('country_id')" class="help text-danger">{{ errors.first('country_id') }}</span>
                        </div>     
                        
                        <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-sd-card"></i> {{ trans('em.save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState, mapMutations} from 'vuex';
import mixinsFilters from '../../mixins.js';


export default {
    props: [
        'event_prop',
        'event_ck',
    ],

    mixins:[
        mixinsFilters
    ],

    data() {
        return {
            venue       : null,
            address     : null,
            city        : null,
            state       : null,
            zipcode     : null,
            countries   : [],
            country_id  : 0,
            isLoading: false
            
        }
    },

    computed: {
        // get global variables
        ...mapState( ['event_id', 'event']),
    },

    methods: {
        // update global variables
        ...mapMutations(['add', 'update']),

        get_countries(){
            axios.get(route('eventmie.myevents_countries'))
            .then(res => {
                if(res.data.countries)
                {
                   this.countries = res.data.countries
                }
            })
            .catch(error => {
                let serrors = Vue.helpers.axiosErrors(error);
                if (serrors.length) {
                    this.serverValidate(serrors);
                }
            });
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
            let post_url = route('eventmie.myevents_store_location');
            let post_data = new FormData(this.$refs.form);
            // axios post request
            axios.post(post_url, post_data)
            .then(res => {
                // on success
                // use vuex to update global sponsors array
                if(res.data.status)
                {
                    this.showNotification('success', trans('em.event_save_success'));
                    // reload page   
                    setTimeout(function() {
                        location.reload(true);
                    }, 1000);
                }

            })
            .catch(error => {
                // only in case or serverValidate
                if (error.length) {
                    this.serverValidate(error);
                }
            });
                
        },

        //edit location
        edit_location(){
            
            if(Object.keys(this.event).length > 0)
            {
                this.venue       =  this.event.venue;
                this.address     =  this.event.address;
                this.city        =  this.event.city;
                this.state       =  this.event.state;
                this.zipcode     =  this.event.zipcode;
                this.country_id  =  this.event.country_id ? this.event.country_id : 0;
            }    
        },

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
        let event_step     = this.eventStep();
        
        if(event_step)
        {
            this.get_countries();

            var $this = this;
            this.getMyEvent().then(function (response){
                $this.edit_location();
            });
        }
    },

    
}
</script>