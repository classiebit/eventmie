<template>
    <div>
        <vue-confirm-dialog></vue-confirm-dialog>
        <ul class="nav nav-lb-tab text-center w-space">
            <li class="nav-item">
                <router-link :to="{ name: 'detail' }" class="nav-link">
                    {{ trans('em.details') }}
                    <i class="fas fa-exclamation-circle text-danger" v-if="!is_publishable.detail"></i>
                    <i class="fas fa-check-circle text-success" v-else></i>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{ name: 'timing' }" class="nav-link">
                    {{ trans('em.timings') }}
                    <i class="fas fa-exclamation-circle text-danger" v-if="!is_publishable.timing"></i>
                    <i class="fas fa-check-circle text-success" v-else></i>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{ name: 'location' }" class="nav-link">
                    {{ trans('em.location') }}
                    <i class="fas fa-exclamation-circle text-danger" v-if="!is_publishable.location"></i>
                    <i class="fas fa-check-circle text-success" v-else></i>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{ name: 'media' }" class="nav-link">
                    {{ trans('em.media') }}
                    <i class="fas fa-exclamation-circle text-danger" v-if="!is_publishable.media"></i>
                    <i class="fas fa-check-circle text-success" v-else></i>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{ name: 'seo' }" class="nav-link">
                    {{ trans('em.seo') }}
                    <i class="fas fa-check-circle text-success"></i>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{ name: 'publish' }" class="nav-link">
                    {{ trans('em.publish') }}
                    <i class="fas fa-exclamation-circle text-danger" v-if="!event_ck.publish"></i>
                    <i class="fas fa-check-circle text-success" v-else></i>
                </router-link>
            </li>
        </ul>

    </div>
</template>

<script>

import { mapMutations } from 'vuex';

export default {
    props: [
        'event_id',
        'is_publishable',
        'event_ck',
    ],

    computed: {
        currentRouteName() {
            return this.$route.name;
        }
    },

    
    methods: {
        // update global variables
        ...mapMutations(['add', 'update']),

        updateEventId() {
            
            this.add({  
                event_id        : this.event_id,
            });
        },

    },  
    mounted() {
        this.updateEventId();
    }
}
</script>