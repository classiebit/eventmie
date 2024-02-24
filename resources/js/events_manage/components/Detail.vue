<template>
    <div>

        <form ref="form" @submit.prevent="validateForm" method="POST" enctype="multipart/form-data" class="lgx-contactform">
            <input type="hidden" name="event_id" v-model="event_id">
            
            <div class="mb-3">
                <label class="form-label">{{ trans('em.select_category') }}</label>
                <select name="category_id" class="form-control" v-model="category_id" v-validate="'required|decimal|is_not:0'" @change="isDirty()">
                    <option value="0">-- {{ trans('em.category') }} --</option>
                    <option v-for="(category, index) in categories" :key = "index" :value="category.id">{{category.name}}</option>
                </select>
                <span v-show="errors.has('category_id')" class="help text-danger">{{ errors.first('category_id') }}</span>    
            </div>
            
            <div class="mb-3">
                <label class="form-label">{{ trans('em.event_name') }}</label>
                <input type="text" class="form-control"  name="title" v-model="title" v-validate="'required'" @change="isDirty()">
                <span v-show="errors.has('title')" class="help text-danger">{{ errors.first('title') }}</span>
            </div>

            <div class="mb-3">
                <label class="form-label">{{ trans('em.event_url') }}</label>
                <input type="hidden" name="slug" v-model="slug" v-validate="'required'" @change="isDirty()">
                <p><a target="_blank" :href="slugUrl()">{{ slugUrl() }}</a></p>
            </div>

            <div class="mb-3">
                <label class="form-label">{{ trans('em.description') }}</label>
                <textarea class="form-control"  rows="3" name="description" :value="description" v-validate="'required'" style="display:none;"></textarea>
                <ckeditor  v-model="description"></ckeditor>
                <span v-show="errors.has('description')" class="help text-danger">{{ errors.first('description') }}</span>
            </div>

            <div class="mb-3">
                <label class="form-label">{{ trans('em.more_event_info') }} </label>
                <textarea class="form-control" rows="3" name="faq" :value="faq" style="display:none;"></textarea>
                <ckeditor v-model="faq"></ckeditor>
                <span v-show="errors.has('faq')" class="help text-danger">{{ errors.first('faq') }}</span>
            </div>

            <button type="submit" class="btn btn-primary btn-lg mt-2"><i class="fas fa-sd-card"></i> {{ trans('em.save') }}</button>
        </form>                
        
    </div>
</template>

<script>

import _ from 'lodash';
import { mapState, mapMutations} from 'vuex';
import mixinsFilters from '../../mixins.js';


export default {
    props: [
        'is_admin', 'event_ck'
    ],
    
    mixins:[
        mixinsFilters
    ],

    data() {
        return {

            title           : null,
            categories      : [],
            description     : this.event_ck.description,
            faq             : this.event_ck.faq,
            category_id     : 0,
        }
    },

    computed: {
        // get global variables
        ...mapState( ['event_id', 'event', 'is_dirty']),
        
        slug: function() {
            if(this.title != null)
            {
                var slug = this.sanitizeTitle(this.title);
                return slug;
            }
        }
    },

    methods: {

        // update global variables
        ...mapMutations(['add', 'update']),

        editEvent( editor ) {
            
            if(Object.keys(this.event).length > 0)
            {
                this.title          = this.event.title;
                this.description    = this.event.description;
                this.faq            = this.event.faq;
                this.category_id    = this.event.category_id;
            }    
            
            
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
            let post_url = route('eventmie.myevents_store');
            let post_data = new FormData(this.$refs.form);
            
            // axios post request
            axios.post(post_url, post_data)
            .then(res => {
                // on success
                // use vuex to update global sponsors array
                if(res.data.status)
                {
                    // fill data to global sponsors array
                    this.add({  
                        event_id        : res.data.id,
                    });
                    this.showNotification('success', trans('em.event_save_success'));
                    
                    if(res.data.slug)
                    {   
                        //create case redirect with slug
                        setTimeout(function() {
                            window.location = route('eventmie.myevents_form',[res.data.slug]);
                        }, 1000);
                    }
                }    

            })
            .catch(error => {
                let serrors = Vue.helpers.axiosErrors(error);
                if (serrors.length) {
                    this.serverValidate(serrors);
                }
            });
        },

        getCategories(){
            let post_url = route('eventmie.myevents_categories');
            
            // axios post request
            axios.get(post_url)
            .then(res => {
                
                if(res.data.status)
                {
                    this.categories = res.data.categories;
                }
                
            })
            .catch(error => {
                let serrors = Vue.helpers.axiosErrors(error);
                if (serrors.length) {
                    this.serverValidate(serrors);
                }
            });
        },

        // slug route
        slugUrl(){
            if(this.slug != null)
                return route('eventmie.events_index')+'/'+this.slug;

            return '';
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
        if(this.categories.length == 0)
            this.getCategories();
        
        if(this.event_id) {
            var $this = this;
            
            this.getMyEvent().then(function (response){
                $this.editEvent();  
            });
            
        };
    },

    
}
</script>