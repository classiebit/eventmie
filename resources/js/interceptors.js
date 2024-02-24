
// Add a request interceptor
window.axios.interceptors.request.use(function (config) {
    window.app.$Progress.start(); // for every request start the progress
    return config;
}, function (error) {
    return Promise.reject(error);
});

// Add a response interceptor
window.axios.interceptors.response.use(function (response) {
    hideSkeleton();    

    window.app.$Progress.finish(); // finish when a response is received

    return response;
}, function (error) {
    hideSkeleton();    
    
    window.app.$Progress.finish(); // finish when a response is received

    if (error.response.status === 401) {
        window.location.href = route('eventmie.login');
        Vue.helpers.showToast('error', trans('em.please_login'));
        return false;
    }

    return Promise.reject(Vue.helpers.axiosErrors(error));
});

function hideSkeleton() {
    [].forEach.call(document.querySelectorAll('.skeleton-loader'), function (el) {
        el.style.display = 'none';
    });
}