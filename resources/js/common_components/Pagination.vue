<template>
<div class="mt-6 d-flex flex-wrap justify-content-between">
    <ul class="pagination">

            <!-- First & Previous Page -->
            <li class="page-item">
                <router-link :class="'page-link pagination-previous'" :to="{ path: path, query: query({ page: 1 })}" v-if="pagination.current_page > 1"><span aria-hidden="true"><i class="fa-solid fa-angles-left"></i> {{ trans('em.first') }}</span></router-link>
            </li>
            <li class="page-item">
                <router-link :class="'page-link  pagination-previous'" :to="{ path: path, query: query({ page: pagination.current_page - 1 })}" v-if="pagination.current_page > 1"><span aria-hidden="true"><i class="fa-solid fa-angle-left"></i> {{ trans('em.previous') }}</span></router-link>
            </li>

    </ul>

    <ul class="pagination d-flex flex-wrap">
        
        <li class="page-item" v-for="(page, index) in pagination.links" :key="index" >
            <router-link v-if="!isNaN(page.label)" class="page-link" :class="{ 'active': page.active }" :to="{ path: path, query: query({ page: page.label })}" >{{ page.label }} </router-link>
        </li>
        
    </ul>

    <ul class="pagination">
            
        <!-- Last & Next Page -->
        <li class="page-item">
            <router-link :class="'page-link pagination-next'" :to="{ path: path, query: query({ page: pagination.current_page + 1 })}" v-if="pagination.current_page < pagination.last_page"><span aria-hidden="true">{{ trans('em.next') }} <i class="fa-solid fa-angle-right"></i></span></router-link>
        </li>
        <li class="page-item">
            <router-link :class="'page-link pagination-next'" :to="{ path: path, query: query({ page: pagination.last_page })}" v-if="pagination.current_page < pagination.last_page"><span aria-hidden="true">{{ trans('em.last') }} <i class="fa-solid fa-angles-right"></i></span></router-link>
        </li>

    </ul>
</div>
</template>

<style>
    .pagination {
        margin-top: 1rem;
        margin-bottom: 1rem;
    }
</style>

<script>
export default {
    props: ['pagination', 'offset', 'path', 'page'],
    watch: {
        '$route' (to, from) {
            this.changePage(this.current_page);
        },
    },
    computed: {
        current_page() {
            // get page from route
            if(typeof this.page === "undefined")
                return 1;
            
            return this.page;
        },
    },
    methods: {
        isCurrentPage(p_page) {
            return this.pagination.current_page === p_page;
        },
        changePage(p_page) {
            if (p_page > this.pagination.last_page) {
                p_page = this.pagination.last_page;
            }
            this.pagination.current_page = p_page;
            this.$emit('paginate');
        },
        query(newQuery) {
            return {
            ...this.$route.query,
            ...newQuery
            }
        }
    },
    computed: {
        pages() {
            let pages = [];
            let from = this.pagination.current_page - Math.floor(this.offset / 2);
            if (from < 1) {
                from = 1;
            }
            let to = from + this.offset - 1;
            if (to > this.pagination.last_page) {
                to = this.pagination.last_page;
            }
            while (from <= to) {
                pages.push(from);
                from++;
            }
            return pages;
        }
    }
}
</script>