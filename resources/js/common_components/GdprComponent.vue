<template>
    <div>
        {{ trans('em.accept_cookie') }} <a :href="getRoute('eventmie.page')">{{ trans('em.privacy') }}</a>
    </div>
</template>

<script>
export default {
    methods: {
        getRoute(url) {
            return route(url,{'page': 'privacy'});
        },
    },
}
</script>