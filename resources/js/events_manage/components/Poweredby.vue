<template>
    <div>
        <div class="bg-light card shadow-sm mt-3">
            <!-- Card header -->
            <div class="card-header p-4 bg-white">
                <h3 class="mb-0">{{ trans('em.publish_event') }}</h3>
                <p class="mb-0">{{ trans('em.publish_event_ie') }}</p>
            </div>
            <!-- Card body -->
            <div class="card-body p-4">
                <div v-if="event.publish == 1">
                    <span class="text-danger h4">{{ trans('em.unpublish_event') }}</span>
                    <p class="text-danger">{{ trans('em.unpublish_event_ie') }}</p>
                </div>
                
                <button type="button" class="btn btn-outline-success btn-lg"
                    :disabled="(Object.keys(this.is_publishable).length != 4 && event.publish == 0) ? true : false" 
                    :class="{ 'btn-outline-danger': (event.publish == 1), 'btn-outline--success': (event.publish != 1) }"
                    @click="publishEvent()"
                >
                    <i v-if="!event.publish" class="fas fa-eye"></i> 
                    <i v-if="event.publish" class="fas fa-eye-slash"></i> 
                    {{ event.publish == 1 ? trans('em.unpublish_event') : trans('em.publish_event')}}
                </button>
            </div>
        </div>

        
    </div>
</template>

<script>
import _ from 'lodash';
import { mapState, mapMutations} from 'vuex';
import mixinsFilters from '../../mixins.js';

export default {

    mixins:[
        mixinsFilters
    ],

    data() {
        return {
            is_publishable   : [],

            isLoading        : false,
            disable          : false,


        }
    },

    computed: {
        ...mapState( ['event_id', 'event_step', 'event']),
    },

    methods: {
        ...mapMutations(['add', 'update']),

          

        // publish event
        publishEvent(){
            axios.post(route('eventmie.publish_myevent'),{
                event_id        : this.event_id,
            })
            .then(res => {
                if(res.data.status)
                {
                    if(this.event.publish == 1)
                        this.showNotification('success', trans('em.event_unpublished'));
                    else
                        this.showNotification('success', trans('em.event_published'));
                    
                    // reload page   
                    setTimeout(function() {
                        location.reload(true);
                    }, 1000);
                }
            })
            .catch(error => {
                Vue.helpers.axiosErrors(error);
            });
        },

    },
    
    mounted(){
        // if user have no event_id then redirect to details page
        // if user have no event_id then redirect to details page
        let event_step  = this.eventStep();
        
        if(event_step)
        {
            var $this = this;
            this.getMyEvent().then(function (response){
                $this.is_publishable = $this.event.is_publishable ? JSON.parse($this.event.is_publishable) : [] ; 
            });

        }
        
        
    }

}
</script>