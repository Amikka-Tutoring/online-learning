<template>
    <jet-authentication-card>
        <template #logo>
            <jet-authentication-card-logo/>
        </template>

        <div class="card-body">

            <!--            <jet-validation-errors class="mb-3"/>-->

            <div v-if="status" class="alert alert-success mb-3 rounded-0" role="alert">
                {{ status }}
            </div>
            <h1 class="blue-text my-4 text-center login-title">Amikka</h1>

            <form @submit.prevent="submit">
                <div class="form-group">
                    <jet-label for="email" value="Email"/>
                    <jet-input id="email" type="email" v-model="form.email" required autofocus/>
                </div>

                <div class="form-group">
                    <jet-label for="password" value="Password"/>
                    <jet-input id="password" type="password" v-model="form.password" required
                               autocomplete="current-password"/>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <jet-checkbox id="remember_me" name="remember" v-model:checked="form.remember"/>

                        <label class="custom-control-label" for="remember_me">
                            Remember Me
                        </label>
                    </div>
                </div>

                <div class="mb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <inertia-link v-if="canResetPassword" :href="route('password.request')"
                                      class="text-muted mr-3">
                            Forgot your password?
                        </inertia-link>
                        <div class="d-flex align-items-center">
                            <a :href="route('register')" class="text-muted mr-3">
                                Register
                            </a>
                            <loading-button :loading="form.processing" class="ml-0 ml-lg-4" id="loginBtn"
                                            :class="{ 'text-white-50': form.processing }" type="submit">Log in
                            </loading-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </jet-authentication-card>
</template>

<script>
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
import JetButton from '@/Jetstream/Button'
import JetInput from '@/Jetstream/Input'
import JetCheckbox from '@/Jetstream/Checkbox'
import JetLabel from '@/Jetstream/Label'
import JetValidationErrors from '@/Jetstream/ValidationErrors'
import LoadingButton from "@/Jetstream/LoadingButton";

export default {
    components: {
        JetAuthenticationCard,
        JetAuthenticationCardLogo,
        JetButton,
        JetInput,
        JetCheckbox,
        JetLabel,
        JetValidationErrors,
        LoadingButton
    },

    props: {
        canResetPassword: Boolean,
        status: String
    },

    data() {
        return {
            form: this.$inertia.form({
                email: '',
                password: '',
                remember: false
            })
        }
    },

    methods: {
        submit() {
            this.form
                .transform(data => ({
                    ...data,
                    remember: this.form.remember ? 'on' : ''
                }))
                .post(this.route('login'), {
                    onFinish: () => this.form.reset('password'),
                    onError: () => Object.values(this.$page.props.errors).flat().forEach(element => this.toast.error(element))
                })
        }
    }
}
</script>
