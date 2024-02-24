var local_tz     = Intl.DateTimeFormat().resolvedOptions().timeZone;

if(timezone_conversion <= 0 && timezone_default != undefined)
    local_tz = timezone_default;


export default{
    
    methods: {
        // make slug
        sanitizeTitle: function(title) {
            var slug = "";
            // Change to lower case
            slug = title.toLowerCase().trim();
            
            // Change whitespace to "-"
            slug = slug.replace(/\s+/g, '-');
            slug = slug.replace('/', '-');
            
            return slug;
        },

        //==== Server Timezone Helpers start====

        // convert local date to server date
        convert_date(date){
            
            var default_tz          = timezone_default; // server timezone
            
            if(typeof(date) == 'undefined' || date == null)
                return null;

            if(timezone_conversion <= 0) {
                    
                if(moment(date,"dddd LL").isValid())
                    return moment(date, "dddd LL").format('YYYY-MM-DD');
            } else {

                if(moment(date,"dddd LL").isValid())
                    return moment(date, "dddd LL").tz(default_tz).format('YYYY-MM-DD');
            }


            return null;    
        },

        // convert local time to server time
        convert_time(time) {
            var default_tz          = timezone_default; // server timezone
            
            if(typeof(time) == 'undefined' || time == null)
                return null;

            if(timezone_conversion <= 0) {
                    
                if(moment(time).isValid())
                    return moment(time).format('HH:mm:ss');
            } else {

                if(moment(time).isValid())
                 return moment(time).tz(default_tz).format('HH:mm:ss');
            }

            return null;        
        },

        //==== Server Timezone Helpers end====




        //==== Local Timezone Helpers start====

        // server date convert into local date
        convert_date_to_local(date) {
            if(typeof(date) == 'undefined' || date == null)
                return null;
            
            if(timezone_conversion <= 0) {
                return moment(date).format('YYYY-MM-DD');
            } else {
                return moment(date).tz(local_tz).format('YYYY-MM-DD');
            }
            
        },

        // server date convert into local date
        convert_date_to_local_format(date) {
            
            if(typeof(date) == 'undefined' || date == null)
                return null;

            if(timezone_conversion <= 0)
                return moment(date).format(date_format.vue_date_format);
            else
                return moment(date).tz(local_tz).format(date_format.vue_date_format);
        },

        // convert server time to local time into moment object
        convert_time_to_local(date, time, format) {
            
            
            if(typeof(date) == 'undefined' || date == null)
                return null;

            date             = moment(date).format("YYYY-MM-DD")

            if(timezone_conversion <= 0) {
                // return format
                if(typeof format !== "undefined")
                    return moment(date+' '+time).format(date_format.vue_time_format);

                return moment(date+' '+time);

            } else {
                // return format
                if(typeof format !== "undefined")
                    return moment(date+' '+time).tz(local_tz).format(date_format.vue_time_format);

                return moment(date+' '+time).tz(local_tz);
            }
            
        },

        // convert server time to local time into moment object
        convert_time_to_local_real(date, time, format) {
            
            
            if(typeof(date) == 'undefined' || date == null)
                return null;

            date             = moment(date).format("YYYY-MM-DD")

            if(timezone_conversion <= 0) {
                // return format
                if(typeof format !== "undefined")
                    return moment(date+' '+time).format(format);

                return moment(date+' '+time);
            } else {
                // return format
                if(typeof format !== "undefined")
                    return moment(date+' '+time).tz(local_tz).format(format);

                return moment(date+' '+time).tz(local_tz);
            }
            
        },

        // count day between two dates
        countDays(start_date, end_date){
            var start_date = moment(start_date,"YYYY-MM-DD");
            var end_date   = moment(end_date,"YYYY-MM-DD");
            return end_date.diff(start_date, 'days')+1 ;  
        },

        // count hours between two dates for simple event 
        // and count hours between two time for repetitive schedule
        counthours(start_time, end_time, repetitive){
            
            var minutes_diff = moment(end_time, "YYYY-MM-DD HH:mm:ss").diff(moment(start_time, "YYYY-MM-DD HH:mm:ss"),'minute');
            var hours        = this.convertMinsToHrsMins(minutes_diff);
        
            if(repetitive != null && typeof(repetitive) != 'undefined')
                hours = moment.utc(moment(end_time,"YYYY-MM-DD HH:mm:ss").diff(moment(start_time,"YYYY-MM-DD HH:mm:ss"))).format("HH:mm");
            
            return hours;  
        },

        convertMinsToHrsMins(mins) {
            let h = Math.floor(mins / 60);
            let m = mins % 60;
            h = h < 10 ? '0' + h : h;
            m = m < 10 ? '0' + m : m;
            return `${h}:${m}`;
        },

        // it use only change date format
        changeDateFormat(date, format){
            return moment(date, format).format(date_format.vue_date_format);
        },

        // it use only change time format
        changeTimeFormat(time){
            return moment(time, date_format.vue_time_format).format(date_format.vue_time_format);
        },

        // convert single date to full date DD-MM-YYYY
        dateToFullDate(date, monthYear) {
            return moment(moment(monthYear).format("YYYY-MM")+'-'+date).format("dddd LL")
        },

        dateToShortDate(date, monthYear) {
            return moment(moment(monthYear).format("YYYY-MM")+'-'+date).format(date_format.vue_date_format)
        },


        // count months
        countMonth(dateStart, dateEnd) {
            
     // convert dates to moment object
            if(timezone_conversion <= 0) {
                dateStart   = moment(dateStart);
                dateEnd     = moment(dateEnd);
            } else {
                dateStart   = moment(dateStart).tz(local_tz);
                dateEnd     = moment(dateEnd).tz(local_tz);
            }

            
            var temp_months = [];
            while (dateEnd > dateStart || dateStart.format('M') === dateEnd.format('M')) {
                temp_months.push(dateStart.format('YYYY-MM'));
                dateStart.add(1,'month');
            }

            return temp_months;
        },

        // check date valid or not
        check_date(date){
            
            if(typeof(date) == 'undefined' || date == null)
                return false;
                
            return moment(date, 'YYYY-MM-DD').isValid();
        },

        // check time valid or not
        check_time(time){

            if(typeof(time) == 'undefined' || time == null)
                return false;

            return moment(time, 'HH:mm:ss').isValid();
        },

        //==== Local Timezone Helpers end====


        // booking cancel confirm or not 
        showConfirm(text = null) {
            return new Promise((resolve) => {
                Swal.fire({
                    title: trans('em.are_you_sure'),
                    text: text,
                    type: 'error',
                    showCancelButton: true,
                    confirmButtonText: trans('em.yes'),
                    cancelButtonText: trans('em.no'),
                    showCloseButton: true,
                    showLoaderOnConfirm: true,
                    timer: 4000,
                    customClass: {
                        container: 'custom-swal-container',
                        popup: 'custom-swal-popup custom-swal-popup-error',
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
                }).then((result) => {
                    if(result.value) 
                        resolve(true);
                    else
                        resolve(false);
                })
            })
        },

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

        // show loader with notification
        showLoaderNotification(message) {
            
            Swal.fire ({
                title: message,
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                customClass: {
                    container: 'custom-swal-container',
                    popup: 'custom-swal-popup',
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
                },
                onBeforeOpen: () => {
                    Swal.showLoading ()
                }
            })
        },

        // check event step
        eventStep(){
            if(!this.event_id)
            {
                this.showNotification('error',  trans('em.please_fill_details'));
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

            promise = new Promise(function(resolve, reject) { 
                // axios post request
                axios.post(post_url,{
                    event_id        : $this.event_id,
                    organiser_id    : $this.organiser_id,
                })
                .then(res => {
                    
                        if(res.data.status)
                        {
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

        // set date in vue2-datepicker update version
        setDateTime(date = null){
            return date ? moment(date).toDate() : ''

        },

        // check if value is positive integer 
        positiveInteger(value = null) {
            if(value > 0 && Number.isInteger(value) == true)
                return value;

            return false;
        },

        //change time into user timezone
        userTimezone(date = null, format = null){
            
            if(timezone_conversion <= 0)
                return moment(date, format);
            else
                return moment.tz(date, format, timezone_default).tz(local_tz);

        },
        userTimezone1(date = null, format = null){

            return moment(date, format);

        },

        //server timezone
        serverTimezone(date = null, format = null){
            if(timezone_conversion <= 0)
                return moment(date, format);
            else
                return moment.tz(date, format, local_tz).tz(timezone_default);

        },

        //show timezone
        showTimezone(){
            if(timezone_conversion > 0)
                return '('+ moment.tz(local_tz).zoneAbbr() + ')';

        },

        

    }
  }