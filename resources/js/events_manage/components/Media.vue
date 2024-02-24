<template>
    <div class="tab-pane active">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <form ref="form" @submit.prevent="cropThumbnailPoster" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="event_id" v-model="event_id">
                        <input type="hidden" v-model="thumbnail" name="thumbnail">
                        <input type="hidden" v-model="poster" name="poster">

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label mb-0">{{ trans('em.thumbnail_image') }}</label>

                                <p class="mb-2 mt-0"><small class="text-muted">{{ trans('em.zoom_info') }} {{ trans('em.drag_info') }}</small></p>
                                <croppa v-model="thumbnail_croppa"
                                    :placeholder="trans('em.drag_drop')+' '+trans('em.or')+' '+trans('em.browse')+' '+trans('em.thumbnail')"
                                    :placeholder-font-size="16"
                                    :placeholder-color="'#000'"
                                    :class="'croppa-thumbnail '"
                                    :quality="1"
                                    :width="854"
                                    :height="480"

                                    :prevent-white-space="true"
                                    :show-remove-button="true"
                                    :zoom-speed="1"
                                    :file-size-limit="10485760" 
                                    accept=".jpg,.jpeg,.png"
                                    @file-type-mismatch="onFileTypeMismatch"
                                    @file-size-exceed="onFileSizeExceed"
                                    
                                    :initial-image="thumbnail_preview"

                                    @file-choose="isDirty()"
                                >
                                    <img crossOrigin="anonymous" :src="thumbnail_preview" slot="initial" :class="' p-2'">
                                </croppa>
                                <span v-show="errors.has('thumbnail')" class="help-block text-danger">{{ errors.first('thumbnail') }}</span>

                                <p class="mb-0 text-muted">{{ trans('em.thumbnail_info') }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label mb-0">{{ trans('em.poster_image') }}</label>

                                <p class="mb-2 mt-0"><small class="text-muted">{{ trans('em.zoom_info') }} {{ trans('em.drag_info') }}</small></p>
                                <croppa v-model="poster_croppa"
                                    :placeholder="trans('em.drag_drop')+' '+trans('em.or')+' '+trans('em.browse')+' '+trans('em.poster')"
                                    :placeholder-font-size="16"
                                    :placeholder-color="'#000'"
                                    :class="'croppa-cover  p-2'"

                                    :quality="1"
                                    :width="1280"
                                    :height="720"

                                    :prevent-white-space="true"
                                    :show-remove-button="true"
                                    :zoom-speed="1"
                                    :file-size-limit="10485760" 
                                    accept=".jpg,.jpeg,.png"
                                    @file-type-mismatch="onFileTypeMismatch"
                                    @file-size-exceed="onFileSizeExceed"

                                    :initial-image="poster_preview"

                                    @file-choose="isDirty()"
                                >
                                    <img crossOrigin="anonymous" :src="poster_preview"
                                    slot="initial" :class="''">
                                </croppa>
                                <span v-show="errors.has('poster')" class="help text-danger">{{ errors.first('poster') }}</span>

                                <p class="mb-0 text-muted">{{ trans('em.poster_info') }}</p>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ trans('em.images_gallery') }}</label>
                            <div class="col-md-12 mb-3">
                                <input multiple="multiple" type="file" class="form-control" ref="images" name="images[]" @change="isDirty()">
                                <span class="text-muted">{{ trans('em.gallery_info') }}</span>
                                <span v-show="errors.has('images')" class="help text-danger">{{ errors.first('images') }}</span>
                            </div>
                            <div class="w-100">
                                <div class="row" v-if="multiple_images.length > 0">
                                    <div class="col-md-2"
                                        v-for="(image,index) in multiple_images" 
                                        :key="index">
                                        
                                        <button type="button" class="btn-sm btn-remove-image bg-light-danger text-danger" @click="deleteGalleryImages(image)">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <img :src="'/storage/'+image" class="rounded img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-sd-card"></i> {{ trans('em.save') }}</button>
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

import mixinsFilters from '../../mixins.js';


export default {

    mixins:[
        mixinsFilters
    ],
    data() {
        return {
            // thumbnail
            thumbnail           : null,
            thumbnail_preview   : '',
            thumbnail_croppa    : null,

            // poster
            poster              : null,
            poster_preview      : '',
            poster_croppa       : null,
            
            images              : [],
            multiple_images     : [],
        }
    },

    computed: {
        // get global variables
        ...mapState( ['event_id', 'event']),
    },

    methods: {
        // update global variables
        ...mapMutations(['add', 'update']),

        // ======================CROPPER METHODS==================
        // cropper validation error
        onFileTypeMismatch (file) {
            Vue.helpers.showToast('error', trans('em.invalid_file'));
        },
        onFileSizeExceed (file) {
            Vue.helpers.showToast('error', trans('em.max_file')+' 10MB');
        },
        // ======================CROPPER METHODS==================

        

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

        async cropThumbnailPoster() {
            // first crop images
            if(this.thumbnail_croppa === null) {
                Vue.helpers.showToast('error', trans('em.thumbnail')+' '+trans('em.image')+' '+trans('em.required'));
                return false;
            }
            if(this.thumbnail_poster === null) {
                Vue.helpers.showToast('error', trans('em.poster')+' '+trans('em.image')+' '+trans('em.required'));
                return false;
            }
 
            this.thumbnail  = await this.thumbnail_croppa.generateDataUrl('image/jpeg');
            this.poster     = await this.poster_croppa.generateDataUrl('image/jpeg');
            
            // once after we get cropped images
            // proceed to form submit
            this.validateForm();
        },

        // submit form
        formSubmit(event) {

            // crop thumbnail

            // prepare form data for post request
            let post_url = route('eventmie.myevents_store_media');
            let post_data = new FormData(this.$refs.form);
            
            // axios post request
            axios.post(post_url, post_data)
            .then(res => {
                // on success
                // use vuex to update global sponsors array
                if(res.data.status)
                {
                    // res.data.data
                    this.images  = res.data.images;
                    this.multiple_images = this.images.images ? JSON.parse(this.images.images) : [];
                    this.showNotification('success', trans('em.event_save_success'));
                    // reload page   
                    setTimeout(function() {
                        location.reload(true);
                    }, 1000);
                }    
            })
            .catch(error => {
                let serrors = Vue.helpers.axiosErrors(error);
                if (serrors.length) {
                    this.serverValidate(serrors);
                }
            });
        },

        // set default value in case of edit
        editMedia(){
            
            if(Object.keys(this.event).length > 0)
            {
                this.thumbnail_preview         = this.event.thumbnail ? ('/storage/'+this.event.thumbnail) : null;
                this.poster_preview            = this.event.poster ? ('/storage/'+this.event.poster) : null;
                this.multiple_images           = this.event.images ? JSON.parse(this.event.images) : [];
            }    
        },

        //delete 
        deleteGalleryImages(image = null){
               this.showConfirm(trans('em.delete')).then((res) => {
                if(res) {
                    // prepare form data for post request
                    let post_url = route('eventmie.delete_image');
                    let post_data = {
                        'event_id' : this.event.id,
                        'image'    : image,
                        'organiser_id'     : this.organiser_id
                    };
                    
                    // axios post request
                    axios.post(post_url, post_data)
                    .then(res => {
                        // on success
                        // use vuex to update global sponsors array
                        if(res.data.status)
                        {
                            this.images           = res.data.images;
                            
                            this.multiple_images  = this.images.images ? JSON.parse(this.images.images) : [];

                            this.showNotification('success', trans('em.event_save_success'));
                        }    
                    })
                    .catch(error => {
                        let serrors = Vue.helpers.axiosErrors(error);
                        if (serrors.length) {
                            this.serverValidate(serrors);
                        }
                    });
                }
            })

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
        // Vue.component('croppa', Croppa.component);  
        if(event_step)
        {
            // just to show images in case of edit
            var $this = this;
            this.getMyEvent().then(function (response){
                $this.editMedia();
            });
        }    
    }  
    
}
</script>