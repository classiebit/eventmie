export default{
    
    methods: {
        // make slug
        sanitizeTitle(title) {
            var slug = "";
            // Change to lower case
            slug = title.toLowerCase().trim();
            
            // Change whitespace to "-"
            slug = slug.replace(/\s+/g, '-');
            
            return slug;
        },

        /*  ==== Server Timezone Functions Start ====  */

        // convert local date to server date
        convert_date(date) {
            var default_tz          = timezone_default; // server timezone
            if(moment(date).isValid())
                return moment(date).tz(default_tz).format('YYYY-MM-DD');

            return null;    
        },

        // convert local time to server time
        convert_time(time) {
            var default_tz          = timezone_default; // server timezone
            if(moment(time).isValid())
                return moment(time).tz(default_tz).format('HH:mm:ss');

            return null;        
        },

        /*  ==== Server Timezone Functions End ====  */


        /*  ==== Local Timezone Functions Start ====  */

        // server date convert into local date
        convert_date_to_local(date) {
            var local_tz          = Intl.DateTimeFormat().resolvedOptions().timeZone; // local timezone

            return moment(date).tz(local_tz).format('YYYY-MM-DD');
        },

        // convert server time to local time into moment object
        convert_time_to_local(date, time, format) {
            var local_tz     = Intl.DateTimeFormat().resolvedOptions().timeZone;
            date             = moment(date).format("YYYY-MM-DD")
            // return format
            if(typeof format !== "undefined")
                return moment(date+' '+time).tz(local_tz).format(format);

            return moment(date+' '+time).tz(local_tz);
        },

        // count day between two dates
        countDays(start_date, end_date){
            var start_date = moment(start_date,"YYYY-MM-DD");
            var end_date   = moment(end_date,"YYYY-MM-DD");
            return end_date.diff(start_date, 'days')+1 ;  
        },

        // it use only change date format
        changeDateFormat(date, format){
            return moment(date, format).format('ll');
        },

        // check date valid or not
        check_date(date) {
            return moment(date, 'YYYY-MM-DD').isValid();
        },

        // check time valid or not
        check_time(time){
            return moment(time, 'HH:mm:ss').isValid();
        },

        /*  ==== Local Timezone Functions End ====  */

        // show notification
        showNotification(type, message) {
            
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-right',
                showConfirmButton: false,
                timer: 4000,
                customClass: {
                    container: 'custom-swal-container',
                    popup: 'custom-swal-popup custom-swal-popup-'+type,
                    header: 'custom-swal-header',
                    title: 'custom-swal-title',
                    closeButton: 'custom-swal-close-button',
                    image: 'custom-swal-image',
                    content: 'custom-swal-content',
                    input: 'custom-swal-input',
                    actions: 'custom-swal-actions',
                    confirmButton: 'custom-swal-confirm-button',
                    cancelButton: 'custom-swal-cancel-button',
                    footer: 'custom-swal-footer'
                }
            });
            Toast.fire({
                type: type,
                html: message
            })
        },

        // check event step
        eventStep(){
            if(!this.event_id)
            {
                this.showNotification('error', trans('em.please_fill_details'))
                this.$router.push({name: 'detail'});
                return false
            }

            return true;
        },

        // set event variable
        getMyEvent() {
            let promise  = null;    
            let post_url = route('eventmie.get_myevent');
            let $this    = this;

            promise = new Promise(function(resolve) { 
                // axios post request
                axios.post(post_url,{
                    event_id        : $this.event_id,
                })
                .then(res => {
                    if(res.data.status) {
                        $this.add({
                            event : res.data.event,
                        }); 
                        
                        resolve(true); 
                    }
                })
                .catch(error => {
                    let serrors = Vue.helpers.axiosErrors(error);
                    if (serrors.length) {
                        this.serverValidate(serrors);
                    }
                });

            });

            return promise;
            
            
        },

    }
  }