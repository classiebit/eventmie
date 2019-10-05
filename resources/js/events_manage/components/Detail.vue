<template>
    <div class="tab-pane active">
        <div class="panel-group">
            <div class="panel panel-default lgx-panel">
                <div class="panel-heading">
                    <form ref="form" @submit.prevent="validateForm" method="POST" enctype="multipart/form-data" class="lgx-contactform">
                        <input type="hidden" name="event_id" v-model="event_id">

                        <div class="form-group">
                            <label>{{ trans('em.select') }} {{ trans('em.category') }}</label>
                            <select name="category_id" class="form-control" v-model="category_id" v-validate="'required|decimal|is_not:0'">
                                <option value="0">-- {{ trans('em.category') }} --</option>
                                <option v-for="(category, index) in categories" :key = "index" :value="category.id">{{category.name}}</option>
                            </select>
                            <span v-show="errors.has('category_id')" class="help text-danger">{{ errors.first('category_id') }}</span>    
                        </div>
                        
                        <div class="form-group">
                            <label>{{ trans('em.event') }} {{ trans('em.name') }}</label>
                            <input type="text" class="form-control"  name="title" v-model="title" v-validate="'required'">
                            <span v-show="errors.has('title')" class="help text-danger">{{ errors.first('title') }}</span>
                        </div>

                        
                        <div class="form-group">
                            <label>{{ trans('em.event') }} {{ trans('em.url') }}</label>
                            <input type="hidden" name="slug" v-model="slug" v-validate="'required'">
                            <p class="help">{{ slugUrl() }}</p>
                        </div>

                        <div class="form-group">
                            <label>{{ trans('em.description') }}</label>
                            <textarea class="form-control"  rows="3" name="description" :value="description" v-validate="'required'" style="display:none;"></textarea>
                            <ckeditor :editor="editor" v-model="description" :config="editorConfig"></ckeditor>
                            <span v-show="errors.has('description')" class="help text-danger">{{ errors.first('description') }}</span>
                        </div>

                        <div class="form-group">
                            <label>{{ trans('em.more') }} {{ trans('em.info') }} ( {{ trans('em.why_attend') }} )</label>
                            <textarea class="form-control" rows="3" name="faq" :value="faq" v-validate="'required'" style="display:none;"></textarea>
                            <ckeditor :editor="editor" v-model="faq" id="faq" :config="editorConfig" @ready="editEvent" ></ckeditor>
                            <span v-show="errors.has('faq')" class="help text-danger">{{ errors.first('faq') }}</span>
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

import CKEditor from '@ckeditor/ckeditor5-vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import mixinsFilters from '../../mixins.js';


export default {
    props: [
        'is_admin'
    ],
    mixins:[
        mixinsFilters
    ],
    components: {
        ckeditor: CKEditor.component
    },
    data() {
        return {
            title           : null,
            categories      : [],
            description     : '',   // for description
            faq             : '',   // for faq
            category_id     : 0,
            editor      : ClassicEditor,
            editorConfig: {
                // The configuration of the editor.
                toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
            },
        }
    },

    computed: {
        // get global variables
        ...mapState( ['event_id', 'event']),
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
        ...mapMutations(['add']),

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
                    this.add({  
                        event_id        : res.data.id,
                    });
                    this.showNotification('success', trans('em.event')+' '+trans('em.saved')+' '+trans('em.successfully'));
                    
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
                return route('eventmie.events_index').url()+'/'+this.slug;

            return '';
        },

        // get myevent
       
    },

    mounted(){
        
        if(this.categories.length == 0)
            this.getCategories();
        
        if(this.event_id)
        {
            var $this = this;
            
            this.getMyEvent().then(function (response){
                console.log(response);
                $this.editEvent();  
            });
            
        }
        
    },

    
}
</script>