<template>
    <div>
        <!-- Infinite Auto-Scrolling Carousel -->
        <div class="infinite-carousel-wrapper" @mouseenter="pause" @mouseleave="resume">
            <div
                class="infinite-carousel-track"
                :style="{ animationPlayState: isPaused ? 'paused' : 'running' }"
                ref="track"
            >
                <div
                    v-for="(image, idx) in doubledImages"
                    :key="idx"
                    class="carousel-image"
                >
                    <img :src="image" class="w-100" @click="openGallery(idx % images.length)">
                </div>
            </div>
        </div>

        <!-- Custom Mobile-Friendly Gallery Modal -->
        <div v-if="index !== null" class="gallery-popup-overlay" @click="closeGallery">
            <div class="gallery-popup-content" @click.stop>
                <!-- Close Button -->
                <button class="gallery-close-btn" @click="closeGallery">
                    <i class="fas fa-times"></i>
                </button>
                <!-- Navigation Buttons -->
                <button v-if="images.length > 1" class="gallery-nav-btn gallery-prev-btn" @click="previousImage">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button v-if="images.length > 1" class="gallery-nav-btn gallery-next-btn" @click="nextImage">
                    <i class="fas fa-chevron-right"></i>
                </button>
                <!-- Main Image -->
                <div class="gallery-image-container">
                    <img :src="images[index]" class="gallery-main-image" @click="nextImage">
                </div>
                <!-- Image Counter -->
                <div class="gallery-counter">
                    {{ index + 1 }} / {{ images.length }}
                </div>
                <!-- Thumbnail Navigation -->
                <div v-if="images.length > 1" class="gallery-thumbnails">
                    <div 
                        v-for="(image, imageIndex) in images" 
                        :key="imageIndex"
                        class="gallery-thumbnail"
                        :class="{ 'active': imageIndex === index }"
                        @click="index = imageIndex"
                    >
                        <img :src="image" class="thumbnail-image">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import mixinsFilters from '../../mixins.js';
export default {
    mixins: [mixinsFilters],
    props: ['gimages'],
    data() {
        return {
            images: [],
            index: null,
            isPaused: false,
        };
    },
    computed: {
        doubledImages() {
            // Duplicate the images for seamless looping
            return [...this.images, ...this.images];
        },
    },
    mounted() {
        // Add url to images
        this.gimages.forEach((value) => {
            this.images.push(this.getImageUrl ? this.getImageUrl(value) : value);
        });
        // Add keyboard navigation
        this.addKeyboardListeners();
    },
    beforeDestroy() {
        this.removeKeyboardListeners();
    },
    methods: {
        pause() { this.isPaused = true; },
        resume() { this.isPaused = false; },
        openGallery(imageIndex) {
            this.index = imageIndex;
            document.body.style.overflow = 'hidden';
        },
        closeGallery() {
            this.index = null;
            document.body.style.overflow = '';
        },
        nextImage() {
            if (this.images.length > 1) {
                this.index = (this.index + 1) % this.images.length;
            }
        },
        previousImage() {
            if (this.images.length > 1) {
                this.index = this.index === 0 ? this.images.length - 1 : this.index - 1;
            }
        },
        addKeyboardListeners() {
            this.keydownHandler = (e) => {
                if (this.index !== null) {
                    switch(e.key) {
                        case 'Escape':
                            this.closeGallery();
                            break;
                        case 'ArrowRight':
                            this.nextImage();
                            break;
                        case 'ArrowLeft':
                            this.previousImage();
                            break;
                    }
                }
            };
            document.addEventListener('keydown', this.keydownHandler);
        },
        removeKeyboardListeners() {
            if (this.keydownHandler) {
                document.removeEventListener('keydown', this.keydownHandler);
            }
        },
    },
};
</script>