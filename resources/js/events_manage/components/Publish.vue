<template>
    <div class="tab-pane active">
        <div class="panel-group">
            <div class="panel panel-default lgx-panel">
                <div class="panel-heading">
        
                   <button type="button" class="btn lgx-btn btn-block"
                        :disabled="Object.keys(this.is_publishable).length != 4 ? true : false" 
                        :class="{ 'lgx-btn-danger': event.publish, 'lgx-btn-success': !event.publish }"
                        @click="publishEvent()"
                    >
                        <i v-if="!event.publish" class="fas fa-eye"></i> 
                        <i v-if="event.publish" class="fas fa-eye-slash"></i> 
                        {{ event.publish == 1 ? trans('em.unpublish') : trans('em.publish')}}
                    </button>
                
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
            is_publishable       : [],
        }
    },

    computed: {
        ...mapState( ['event_id', 'event_step', 'event']),
    },

    methods: {
        // update global variables
        ...mapMutations(['add']),
        // publish event
        publishEvent(){
            axios.post(route('eventmie.publish_myevent'),{
                event_id        : this.event_id,
            })
            .then(res => {
                if(res.data.status)
                {
                    if(this.event.publish == 1)
                        this.showNotification('success', trans('em.event')+' '+trans('em.unpublished')+' '+trans('em.successfully'));
                    else
                        this.showNotification('success', trans('em.event')+' '+trans('em.published')+' '+trans('em.successfully'));
                    
                    // reload page   
                    setTimeout(function() {
                        location.reload(true);
                    }, 1000);
                }
            })
            .catch(error => {});
        }

    },
    
    mounted(){
        // if user have no event_id then redirect to details page
        // if user have no event_id then redirect to details page
        let event_step  = this.eventStep();
        if(event_step) {
            var $this = this;
            this.getMyEvent().then(function (response){
                $this.is_publishable = $this.event.is_publishable ? JSON.parse($this.event.is_publishable) : [] ; 
            });
        }
        
    }

}
</script>