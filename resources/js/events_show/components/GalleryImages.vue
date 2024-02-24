<template>
    <div>
        <gallery :images="images" :index="index" @close="index = null"></gallery>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12 col-12" v-for="(image, imageIndex) in images" :key="imageIndex">
                <div class="mb-5">
                    <img :src="image" class="w-100 rounded-3 img-hover" @click="index = imageIndex">
                </div>
            </div>    
        </div>
    </div>
</template>

<script>
import VueGallery from 'vue-gallery';

export default {
    props: [
        'gimages'
    ],
    data: function () {
        return {
            images: [],
            index: null
        };
    },

    components: {
        'gallery': VueGallery
    },

    mounted() {
        // add url to images
        this.gimages.forEach(function(value, key) {
            this.images.push('/storage/'+value);
        }.bind(this));    
    }, 
}
</script> 
