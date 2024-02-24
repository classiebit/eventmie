<template>
    <div>
   
        <form ref="form" @submit.prevent="validateForm" method="POST" enctype="multipart/form-data" class="lgx-contactform">
            <input type="hidden" name="event_id" v-model="event_id">
            
            <div class="mb-2">
                <label class="form-label">{{ trans('em.meta_title') }}</label>
                <input type="text" class="form-control"  name="meta_title" v-model="meta_title" @change="isDirty()">
                <span v-show="errors.has('meta_title')" class="help text-danger">{{ errors.first('meta_title') }}</span>
            </div>

            <div class="mb-2">
                <label class="form-label">{{ trans('em.meta_tags') }}</label>
                <input type="text" class="form-control" name="meta_keywords" v-model="meta_keywords" @change="isDirty()">
                <span v-show="errors.has('meta_keywords')" class="help text-danger">{{ errors.first('meta_keywords') }}</span>
            </div>

            <div class="mb-2">
                <label class="form-label">{{ trans('em.meta_description') }}</label>
                <input type="text" class="form-control" name="meta_description" v-model="meta_description" @change="isDirty()">
                <span v-show="errors.has('meta_description')" class="help text-danger">{{ errors.first('meta_description') }}</span>
            </div>

            <button type="submit" class="btn btn-primary btn-lg mt-2"><i class="fas fa-sd-card"></i> {{ trans('em.save') }}</button>
        </form>                
                    
    </div>
</template>

<script>
import { mapState, mapMutations} from 'vuex';
import mixinsFilters from '../../mixins.js';

export default {
    props: [
        'event_prop',
    ],

    mixins:[
        mixinsFilters
    ],

    data() {
        return {
            meta_title       : null,
            meta_description : null,
            meta_keywords   : null,
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
            
            // axios post request
            axios.post(post_url, post_data)
            .then(res => {
                // on success
                // use vuex to update global sponsors array
                if(res.data.status)
                {
                    this.showNotification('success', trans('em.seo_saved_successfully'));
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
                this.meta_keywords      =  this.event.meta_keywords;
                this.meta_description   =  this.event.meta_description;
              
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
            var $this = this;
            this.getMyEvent().then(function (response){
                $this.edit_seo();
            });

        }
    }


}
</script>