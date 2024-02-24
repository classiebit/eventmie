<template>
    <ul class="pagination d-flex flex-wrap justify-content-end mb-0">
        <!-- First & Previous Page -->
        <li class="page-item">
            <router-link :class="'page-link pagination-previous'" :to="{ path: path, query: query({ page: 1 })}" v-if="pagination.current_page > 1"><span>{{ trans('em.first') }}</span></router-link>
        </li>
        <li class="page-item">
            <router-link :class="'page-link  pagination-previous'" :to="{ path: path, query: query({ page: pagination.current_page - 1 })}" v-if="pagination.current_page > 1"><span>{{ trans('em.previous') }}</span></router-link>
        </li>

        <li class="page-item"
            v-for="(p_page, index) in pages"
            v-bind:item="p_page"
            v-bind:index="index"
            v-bind:key="index"
        >
            <router-link :class="(isCurrentPage(p_page) ? 'page-link active' : 'page-link')" :to="{ path: path, query: query({ page: p_page })}">{{ p_page }}</router-link>
        </li>

        <!-- Last & Next Page -->
        <li class="page-item">
            <router-link :class="'page-link pagination-next'" :to="{ path: path, query: query({ page: pagination.current_page + 1 })}" v-if="pagination.current_page < pagination.last_page"><span>{{ trans('em.next') }}</span></router-link>
        </li>
        <li class="page-item">
            <router-link :class="'page-link pagination-next'" :to="{ path: path, query: query({ page: pagination.last_page })}" v-if="pagination.current_page < pagination.last_page"><span>{{ trans('em.last') }}</span></router-link>
        </li>

    </ul>
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