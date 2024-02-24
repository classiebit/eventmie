<template>
    <div>
        <form ref="form" @submit.prevent="validateForm" method="POST" enctype="multipart/form-data" class="lgx-contactform">
            <!-- add tags directly from this page -->

            <div>
                <button :disabled="disable" type="submit" class="btn btn-primary btn-lg mt-3"><i class="fas fa-sd-card"></i> {{ trans('em.save') }}</button>
            </div>
        </form>

        <hr />

        <div class="bg-light card shadow-sm mt-3">
            <!-- Card header -->
            <div class="card-header p-4 bg-white">
                <h3 class="mb-0">{{ trans('em.publish_event') }}</h3>
                <p class="mb-0">{{ trans('em.publish_event_ie') }}</p>
            </div>
            <!-- Card body -->
            <div class="card-body p-4">
                <div v-if="event.publish == 1">
                    <span class="text-danger h4">{{ trans('em.unpublish_event') }}</span>
                    <p class="text-danger">{{ trans('em.unpublish_event_ie') }}</p>
                </div>
                
                <button type="button" class="btn btn-outline-success btn-lg"
                    :disabled="(Object.keys(this.is_publishable).length != 4 && event.publish == 0) ? true : false" 
                    :class="{ 'btn-outline-danger': (event.publish == 1), 'btn-outline--success': (event.publish != 1) }"
                    @click="publishEvent()"
                >
                    <i v-if="!event.publish" class="fas fa-eye"></i> 
                    <i v-if="event.publish" class="fas fa-eye-slash"></i> 
                    {{ event.publish == 1 ? trans('em.unpublish_event') : trans('em.publish_event')}}
                </button>
            </div>
        </div>

        
    </div>
</template>

<script>
import _ from 'lodash';
import { mapState, mapMutations} from 'vuex';
import mixinsFilters from '../../mixins.js';

export default {

    mixins:[
        mixinsFilters
    ],

    data() {
        return {
            is_publishable   : [],

            isLoading        : false,
            disable          : false,


        }
    },

    computed: {
        ...mapState( ['event_id', 'event_step', 'event']),
    },

    methods: {
        ...mapMutations(['add', 'update']),

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
             // show loader
            this.showLoaderNotification(trans('em.processing'));

            // prepare form data for post request
            this.disable = true;

            // prepare form data for post request
            let post_url    = route('eventmie.myevents_store_event_tags');
            
            let post_data   = {
                'event_id'     : this.event_id,
            };
            
            // axios post request
            axios.post(post_url, post_data)
            .then(res => {

                if(res.data.status)
                {
                    this.showNotification('success', trans('em.event_save_success'));
                    // reload page   
                    // setTimeout(function() {
                    //     location.reload(true);
                    // }, 1000);


                }
                this.disable = false;
                Swal.hideLoading();
            })
            .catch(error => {
                this.disable = false;
                Swal.hideLoading();
                let serrors = Vue.helpers.axiosErrors(error);
                if (serrors.length) {
                    this.serverValidate(serrors);
                }
            });
        },

        // publish event
        publishEvent(){
            axios.post(route('eventmie.publish_myevent'),{
                event_id        : this.event_id,
            })
            .then(res => {
                if(res.data.status)
                {
                    if(this.event.publish == 1)
                        this.showNotification('success', trans('em.event_unpublished'));
                    else
                        this.showNotification('success', trans('em.event_published'));
                    
                    // reload page   
                    setTimeout(function() {
                        location.reload(true);
                    }, 1000);
                }
            })
            .catch(error => {
                Vue.helpers.axiosErrors(error);
            });
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
        // if user have no event_id then redirect to details page
        let event_step  = this.eventStep();
        
        if(event_step)
        {
            var $this = this;
            this.getMyEvent().then(function (response){
                $this.is_publishable = $this.event.is_publishable ? JSON.parse($this.event.is_publishable) : [] ; 
            });

        }
        
        
    }

}
</script>