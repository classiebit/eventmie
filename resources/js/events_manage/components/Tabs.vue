<template>
    <ul class="nav nav-pills lgx-nav lgx-nav-nogap">  <!--lgx-nav-nogap lgx-nav-colorful-->
        <li>
            <router-link :to="{ name: 'detail' }">
                <h3>{{ trans('em.details') }}</h3>
                <p>{{ trans('em.title') }} & {{ trans('em.description') }}</p>
            </router-link>
        </li>
        <li>
            <router-link :to="{ name: 'timing' }">
                <h3>{{ trans('em.timings') }}</h3>
                <p>{{ trans('em.event') }} {{ trans('em.dates') }}</p>
            </router-link>
        </li>
        <li>
            <router-link :to="{ name: 'location' }">
                <h3>{{ trans('em.location') }}</h3>
                <p>{{ trans('em.venue') }} & {{ trans('em.address') }}</p>
            </router-link>
        </li>
        <li>
            <router-link :to="{ name: 'media' }">
                <h3>{{ trans('em.media') }}</h3>
                <p>{{ trans('em.thumbnail') }} & {{ trans('em.poster') }}</p>
            </router-link>
        </li>
        <li>
            <router-link :to="{ name: 'seo' }">
                <h3>{{ trans('em.seo') }}</h3>
                <p>{{ trans('em.meta') }} {{ trans('em.info') }}</p>
            </router-link>
        </li>
        <li>
            <router-link :to="{ name: 'publish' }">
                <h3>{{ trans('em.publish') }}</h3>
                <p>{{ trans('em.publish') }} {{ trans('em.event') }}</p>
            </router-link>
        </li>
    </ul>
</template>

<script>

import { mapMutations } from 'vuex';
import { VueRouter } from 'vue-router';

export default {
    props: [
        'event_id',
    ],
    methods: {
        // update global variables
        ...mapMutations(['add']),

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