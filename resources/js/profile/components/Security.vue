<template>
    <div>
        <div id="security" class="tab-pane">
            <div class="panel-group">
                <div class="panel panel-default lgx-panel">
                    <div class="panel-heading px-5">
                        <form
                            id="updatePasswordUser"
                            class="form-horizontal"
                            ref="form"
                            :action="submitUrl()"
                            @submit.prevent="validateForm"
                            method="POST"
                        >
                            <input
                                type="hidden"
                                name="_token"
                                id="csrf-token"
                                :value="csrf_token"
                            />

                            <div class="form-group row mt-3">
                                <label class="col-md-3 form-label">{{
                                    trans("em.current_password")
                                }}</label>
                                <div class="col-md-9">
                                    <input
                                        class="form-control"
                                        name="current"
                                        type="password"
                                        v-validate="'required'"
                                        v-model="current"
                                    />
                                    <span
                                        v-show="errors.has('current')"
                                        class="help text-danger"
                                        >{{ errors.first("current") }}</span
                                    >
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label class="col-md-3 form-label"
                                    >{{ trans("em.new") }}
                                    {{ trans("em.password") }}</label
                                >
                                <div class="col-md-9">
                                    <input
                                        class="form-control"
                                        name="password"
                                        type="password"
                                        v-model="password"
                                    />
                                    <span
                                        v-show="errors.has('password')"
                                        class="help text-danger"
                                        >{{ errors.first("password") }}</span
                                    >
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label class="col-md-3 form-label">{{
                                    trans("em.confirm_password")
                                }}</label>
                                <div class="col-md-9">
                                    <input
                                        class="form-control"
                                        name="password_confirmation"
                                        type="password"
                                        v-model="password_confirmation"
                                    />
                                    <span
                                        v-show="
                                            errors.has('password_confirmation')
                                        "
                                        class="help text-danger"
                                        >{{
                                            errors.first(
                                                "password_confirmation"
                                            )
                                        }}</span
                                    >
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
            current: null,
            password: null,
            password_confirmation: null
        };
    },

    methods: {
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

        formSubmit() {
            this.$refs.form.submit();
        },

        submitUrl() {
            return route("eventmie.updatePasswordUser");
        }
    },
    mounted() {}
};
</script>
