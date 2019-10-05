<template>
    <div class="tab-pane active">
        <div class="panel-group">
            <div class="panel panel-default lgx-panel">
                <div class="panel-heading">
                    <form ref="form" @submit.prevent="validateForm" method="POST" enctype="multipart/form-data" class="lgx-contactform">
                        <input type="hidden" name="event_id" v-model="event_id">
                        
                        <div class="form-group">
                            <label>{{ trans('em.meta') }} {{ trans('em.title') }}</label>
                            <input type="text" class="form-control"  name="meta_title" v-model="meta_title" v-validate="'required'">
                            <span v-show="errors.has('meta_title')" class="help text-danger">{{ errors.first('meta_title') }}</span>
                        </div>
        
                        <div class="form-group">
                            <label>{{ trans('em.meta') }} {{ trans('em.tags') }}</label>
                            <input type="text" class="form-control" name="meta_keywords" v-model="meta_keywords">
                            <span v-show="errors.has('meta_keywords')" class="help text-danger">{{ errors.first('meta_keywords') }}</span>
                        </div>

                        <div class="form-group">
                            <label>{{ trans('em.meta') }} {{ trans('em.description') }}</label>
                            <input type="text" class="form-control" name="meta_description" v-model="meta_description" v-validate="'required'">
                            <span v-show="errors.has('meta_description')" class="help text-danger">{{ errors.first('meta_description') }}</span>
                        </div>

                        <button type="submit" class="btn lgx-btn btn-block"><i class="fas fa-sd-card"></i> {{ trans('em.save') }}</button>
                    </form>                
                    
                </div>
            </div>
        </div>

        
        
    </div>
</template>

<script>
import { mapState, mapMutations} from 'vuex';
import mixinsFilters from '../../mixins.js';
import Vue from 'vue';

export default {
    mixins:[
        mixinsFilters
    ],
    data() {
        return {
            meta_title       : null,
            meta_keywords    : null,
            meta_description : null,
            
        }
    },

    computed: {
        // get global variables
        ...mapState( ['event_id', 'event']),
    },

    methods: {
        // update global variables
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
            
            // prepare form data for post request
            let post_url = route('eventmie.myevents_store_seo');
            let post_data = new FormData(this.$refs.form);
            let post_progress = {
                onUploadProgress: uploadEvent => {
                    // console.log('Upload progress: '+ Math.round(uploadEvent.loaded / uploadEvent.total * 100)+ '%');
                }
            };
            // axios post request
            axios.post(post_url, post_data, post_progress)
            .then(res => {
                // on success
                if(res.data.status)
                {
                    this.showNotification('success', trans('em.seo')+' '+trans('em.saved')+' '+trans('em.successfully'));
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

        //edit seo
        edit_seo(){
            
            if(Object.keys(this.event).length > 0)
            {
                this.meta_title         =  this.event.meta_title;
                this.meta_keywords          =  this.event.meta_keywords;
                this.meta_description   =  this.event.meta_description;
              
            }    
        },
    },
    
    mounted(){
        // if user have no event_id then redirect to details page
        let event_step     = this.eventStep();
        
        if(event_step)
        {
            var $this = this;
            this.getMyEvent().then(function (response){
                $this.edit_seo();
            });

        }
    }


}
</script>