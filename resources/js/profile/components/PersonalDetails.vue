<template>
    <div>
        <div class="tab-pane">
            <div class="panel-group">
                <div class="panel panel-default lgx-panel">
                    <div class="panel-heading px-5">
                        <form id="form" class="form-horizontal" ref="form" :action="submitUrl()"
                            @submit.prevent="validateForm" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" id="csrf-token" :value="csrf_token" />
                            
                            <div class="col-md-12 mb-5 text-center">
                                <img id="preview-image-before-upload" :src="'storage/'+ user.avatar"
                                    alt="profile-pic" style="max-height: 128px;border-radius: 50%;">
                            </div>

                            <div class="form-group row mt-3 mt-5">
                                <label class="form-label col-md-3 form-label">{{ this.is_organiser == true ? trans('em.organisation_logo') : trans('em.avatar') }}</label>
                                <div class="col-md-9">
                                    <input @change="imagePreview" class="form-control" id="avatar" name="avatar" type="file"  >
                                    
                                    <span v-show="errors.has('avatar')" class="help text-danger">{{ errors.first("avatar")}}</span>
                                </div>
                            </div>
           

                            <div class="form-group row mt-3 mt-3">
                                <label class="col-md-3 form-label">{{
                                trans("em.name")
                                }}</label>
                                <div class="col-md-9">
                                    <input class="form-control" name="name" type="text" v-model="name"
                                        v-validate="'required'" />
                                    <span v-show="errors.has('name')" class="help text-danger">{{ errors.first("name")
                                    }}</span>
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label class="col-md-3 form-label">{{ trans("em.email") }}*</label>
                                <div class="col-md-9">
                                    <input class="form-control" name="email" type="email" v-model="email"
                                        v-validate="'required'" />
                                    <span v-show="errors.has('email')" class="help text-danger">{{ errors.first("email")
                                    }}</span>
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <div class="col-md-9 offset-md-3">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-sd-card"></i>
                                        {{ trans("em.save") }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import mixinsFilters from "../../mixins.js";
export default {
    props: ["user", "csrf_token"],
    mixins: [mixinsFilters],
    data() {
        return {
            name: null,
            email: null,
            avatar : null,
        };
    },

    methods: {
        // ...mapMutations(["add"]),

        editProfile() {
            this.name = this.user.name;
            this.email = this.user.email;
        },

        // validate data on form submit
        validateForm(event) {
            this.$validator.validateAll().then(result => {
                if (result) {
                    this.formSubmit(event);
                }
            });
        },

        // show server validation errors
        serverValidate(serrors) {
            this.$validator.validateAll().then(result => {
                this.$validator.errors.add(serrors);
            });
        },

        // submit form
        async formSubmit(event) {
           
            this.$refs.form.submit();
        },

        submitUrl() {
            return route("eventmie.updateAuthUser");
        },

        imagePreview(e) {

            const file = e.target.files[0];
            let url = URL.createObjectURL(file);

            $('#preview-image-before-upload').attr('src', url); 
           
        }

    },
    mounted() {
        this.editProfile();
    }
};
</script>
