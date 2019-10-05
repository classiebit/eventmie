// VueSweetalert2
window.Swal = require('sweetalert2');

// custom global helpers
export default {
    /**
     * serverMessage
     * shows server single success flash message
     */
    serverMessage(message) {
        // in case of unexpected condition
        if(typeof(message) === "undefined" || message === null)
            return false;
        
        // show message in toast
        Vue.helpers.showToast('success', message);
    },

    /**
     * serverErrors
     * shows server multiple validation errors
     */
    serverErrors(errors) {
        // in case of unexpected condition
        if(typeof(errors.length) === "undefined" || errors.length === null)
            return false;
        
        let allerrors = '';
        errors.forEach(function(value, key) {
            // to show all errors in single toast
            allerrors += '<p>';
            allerrors += value;
            allerrors += '</p>';    
        }.bind(this));
        
        // show error in toast
        Vue.helpers.showToast('error', allerrors);
    },

    /**
     * axiosErrors
     * shows server multiple validation errors
     * fetched (catch) from axios requests
     * 
     * return errors in key value pair
     */
    axiosErrors(error) {
        // in case of unexpected condition
        if(typeof(error.response) === "undefined" || error.response === null) {
            return false;
        }

        if (error.response.status !== 200) {
            let serrors = [];
            let allerrors = '';
            let i = 0;
            
            let errors = error.response.data.errors; 
            for (var key in errors) {
                if (errors.hasOwnProperty(key)) {
                    serrors[i] = {field: key, msg: ''};
                    errors[key].forEach(function(v, k) {
                        serrors[i].msg += v;

                        // to show all errors in single toast
                        allerrors += '<p>';
                        allerrors += v;
                        allerrors += '</p>';
                    });
                    i++;    
                }
            }
            
            // show error in toast
            Vue.helpers.showToast('error', allerrors);

            // return serrors for showing server error in vee-validate
            return serrors;
        }
        
        return true;
    },

    /**
     * showToast
     * popup sweetalert2 toast
     * dynamic errors- error, success, warning, info
     *
     */
    showToast(type, message) {
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

}