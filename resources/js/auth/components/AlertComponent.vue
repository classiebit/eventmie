<script>
export default {
    props: ['errors', 'message'],
    methods: {
        showErrors() {
            // show server errors in toast
            Vue.helpers.serverErrors(this.errors);
        },
        showMessage() {
            // show server message in toast
            Vue.helpers.serverMessage(this.message);
        }
    },
    mounted() {
        if(this.message != null)
            this.showMessage();
        else
            this.showErrors();
    },
}
</script>