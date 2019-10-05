<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-3 mb-50 pl-30">
                
                <div class="form-group">
                    <label for="exampleFormControlSelect1">{{ trans('em.search') }} {{ trans('em.events') }}</label>
                    <input type="text" class="form-control" v-model="f_search" :placeholder="trans('em.type')+' '+trans('em.event')+' '+trans('em.name')+' or '+trans('em.venue')+' or '+trans('em.city')+' or '+trans('em.state')">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect1">{{ trans('em.category') }}</label>
                    <select class="form-control" name="state" v-model="f_category" >
                        <option  value="All">{{ trans('em.all') }} {{ trans('em.categories') }}</option>
                        <option v-for="(category, index) in categories" :key ="index" :value="category.name">{{category.name}} </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect1">{{ trans('em.date') }}</label>
                    <date-picker  class="form-control" :shortcuts="shortcuts" v-model="date_range" range  lang="en" format="YYYY-MM-DD "></date-picker>
                </div>

                <div class="form-group">
                    <button type="button" class="lgx-btn btn-block mt-2" @click="reset()"><i class="fas fa-redo"></i> {{ trans('em.reset') }} {{ trans('em.filters') }}</button>
                </div>
            </div>
        
            <div class="col-12 col-lg-9">
                <event-listing :events ="events"></event-listing>

                <hr>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <div class="column is-12" v-if="events.length > 0">
                            <pagination-component v-if="pagination.last_page > 1" :pagination="pagination" :offset="pagination.total" :path="'events'" @paginate="checkEvents()"></pagination-component>
                        </div>       
                    </div>
                </div>
            </div>
            
        </div>
    </div>
                            
</template>

<script>

import PaginationComponent from '../../common_components/Pagination'
import EventListing from '../../common_components/EventListing';

import mixinsFilters from '../../mixins.js';
import lodash from 'lodash';
import DatePicker from 'vue2-datepicker';

var moment = require('moment');

import { VueRouter } from 'vue-router';

export default {
    props: [
        // pagination query string
        'page',
        'category',
    ],

    components: {
        DatePicker,
        PaginationComponent,
        EventListing, 
    },
    
    mixins:[
        mixinsFilters
    ],

    data() {
        return {
            events           : [],
            categories       : [],
            pagination: {
                'current_page': 1
            },
            moment           : moment,
            date_range       : [],
            
            // filters
            f_category       : 'All',
            f_search         : '',

            // date shortucts like today, tommorrow
            shortcuts: [
                {
                    text: trans('em.today'),
                    onClick: () => {
                        this.date_range = [moment(), moment() ]
                    }
                },
                {
                    text: trans('em.tomorrow'),
                    onClick: () => {
                        this.date_range = [moment().add(1,'day'), moment().add(1,'day')]
                    }
                },
                {
                    text: trans('em.this')+' '+trans('em.weekend'),
                    onClick: () => {
                        this.date_range = [moment().endOf("week"), moment().endOf("week")]
                    }
                },
                {
                    text: trans('em.this')+' '+trans('em.week'),
                    onClick: () => {
                        this.date_range = [moment().startOf("week"), moment().endOf("week")]
                    }
                },
                {
                    text: trans('em.next')+' '+trans('em.week'),
                    onClick: () => {
                        this.date_range = [moment().add(1, 'weeks').startOf("week"), moment().add(1, 'weeks').endOf("week")]
                    }
                },
                {
                    text: trans('em.this')+' '+trans('em.month'),
                    onClick: () => {
                        this.date_range = [moment().startOf("month"), moment().endOf("month")]
                    }
                },
                {
                    text: trans('em.next')+' '+trans('em.month'),
                    onClick: () => {
                        this.date_range = [moment().add(1, 'months').startOf("month"), moment().add(1, 'months').endOf("month")]
                    }
                },
            ],
        }
    },
    watch: {
        '$route' (to, from) {
            this.debouncedgGetEvents();    
        },
    
        // filters

        // searching f_category 
        f_category: function () {
            if(this.f_category)
            {
                this.$router.push({ query: Object.assign({}, this.$route.query, { category: this.f_category, page: 1  }) });
            }
            else
            {
                let query = Object.assign({}, this.$route.query);
                delete query.category;
                this.$router.replace({ query });
            }
            
        },
        // seraching by f_search 
        f_search: function () {
            if(this.f_search)
            {
                this.$router.push({ query: Object.assign({}, this.$route.query, { search: this.f_search, page: 1  }) });
            }
            else
            {
                let query = Object.assign({}, this.$route.query);
                delete query.search;
                this.$router.replace({ query });
            }    
        },
        // searching by date 
        date_range: function () {
            var is_date_null = true;
            if(this.date_range)
            {
                // convert date range to server side date
                this.date_range.forEach(function(value, key) {
                    if(value != null) {
                        is_date_null = false;

                        if(key == 0)
                            this.start_date   =  this.convert_date(value); // convert local start_date to server date then searching by date
                        
                        if(key == 1)
                            this.end_date     =  this.convert_date(value); // convert local end_date to server date then searching by date
                    }
                }.bind(this));
                
                if(is_date_null == false) {
                    this.$router.push({ query: Object.assign({}, this.$route.query, { start_date: this.start_date, page: 1  }) });
                    this.$router.push({ query: Object.assign({}, this.$route.query, { end_date: this.end_date, page: 1  }) });
                } else {
                    this.start_date  = '';
                    this.end_date    = '';
                    let query        = Object.assign({}, this.$route.query);
                    delete query.start_date;
                    delete query.end_date;
                    this.$router.replace({ query });
                }
            }
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
        // get all events
        getEvents() {
            
            if(typeof this.start_date === "undefined") {
                this.start_date     = '';
            }
            if(typeof this.end_date === "undefined") {
                this.end_date     = '';
            }
            
            axios.get(route('eventmie.events')+'?page='+this.current_page+'&category='+encodeURIComponent(this.f_category)+'&search='+this.f_search+'&start_date='+this.start_date+'&end_date='+this.end_date)
            .then(res => {
                this.events     = res.data.events.data;
                this.pagination = {
                    'total' : res.data.events.total,
                    'per_page' : res.data.events.per_page,
                    'current_page' : res.data.events.current_page,
                    'last_page' : res.data.events.last_page,
                    'from' : res.data.events.from,
                    'to' : res.data.events.to
                };
                // events sorting funtion
                this.eventSorting();
            })
            .catch(error => {});
        },

        // get categories
        getCategories(){
            axios.get(route('eventmie.myevents_categories'))
            .then(res => {
                if(res.status)
                   this.categories  = res.data.categories;
            })
            .catch(error => {});
        },

        // serch event with 5 delay
        debouncedgGetEvents: _.debounce(function() {
            this.getEvents()     
        }, 1000),

        // reset searching fields
        reset(){
            this.$router.replace({});
            this.f_search        = '';
            this.f_category      = 'All';
            this.date_range      = '';
            this.start_date      = '';
            this.end_date        = '';
        },

        // events sorting
        eventSorting(){
            if(this.events.length > 0)
            {
                let events_started = [];
                let events_ended   = [];
                let $this          = this;
                this.events.forEach(function(v,k) {
                    if(moment().format('YYYY-MM-DD') < $this.convert_date_to_local(v.start_date, 'YYYY-MM-DD'))
                        events_started.push(v);
                    else 
                        events_ended.push(v);
                })
                this.events = [];
                this.events.push(...events_started);
                this.events.push(...events_ended);

                return this.events;
            }
        }

    },
    mounted() {

        // get category of title from welcome page's categories 
        this.f_category = this.category ? decodeURIComponent(this.category).replace(/\+/g, " ") : 'All';
            
        this.getEvents();
        this.getCategories();
        
    }
}
</script>