<template>
    <plans v-if="this.plan === null" :parent="this"/>
    <!--    <plans v-if="false" :parent="this"/>-->
    <div v-else class="container">
        <div class="row m-0 h-100">
            <div class="col-md-7 align-self-center image-column">
                <h1>If You Don't Love It</h1>
                <h1 class="blue-text mb-5">Cancel With No <br>Strings Attached.</h1>
                <img src="/images/register-image.png" alt="">
            </div>
            <div class="col-md-5 align-self-center">
                <!--                <jet-authentication-card>-->

                <div class="card-body">
                    <jet-validation-errors class="mb-3"/>
                    <div class="logo text-center my-5">
                        <p class="trial mb-5">7 Day Free Trial</p>
                    </div>
                    <form @submit.prevent="submit">
                        <div class="form-group">
                            <jet-input id="name" type="text" v-model="form.name" required autofocus
                                       autocomplete="name" placeholder="Enter Your Full Name"/>
                        </div>

                        <div class="form-group">
                            <jet-input id="email" type="email" v-model="form.email" required
                                       placeholder="Enter Your Email"/>
                            <svg width="24" height="15" viewBox="0 0 24 15" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M20.6138 0.531738H3.47429C2.57861 0.532795 1.71998 0.820714 1.08658 1.33239C0.453187 1.84408 0.096686 2.53778 0.0952148 3.26147V11.8546C0.0963595 12.5784 0.452736 13.2723 1.08619 13.7841C1.71964 14.296 2.57845 14.5839 3.47429 14.5848H20.6138C21.5093 14.5836 22.3678 14.2956 23.0008 13.7838C23.6339 13.272 23.99 12.5782 23.991 11.8546V3.26147C23.9897 2.538 23.6335 1.84444 23.0004 1.33278C22.3674 0.82111 21.5092 0.533059 20.6138 0.531738ZM19.5743 4.39391L13.4459 7.55105C13.0268 7.76598 12.5407 7.88012 12.0443 7.88012C11.548 7.88012 11.0618 7.76598 10.6428 7.55105L4.51434 4.39391C4.4288 4.34991 4.35483 4.29273 4.29664 4.22563C4.23846 4.15854 4.1972 4.08284 4.17522 4.00286C4.15324 3.92288 4.15098 3.84018 4.16855 3.7595C4.18613 3.67881 4.2232 3.60171 4.27765 3.53259C4.33211 3.46348 4.40288 3.40372 4.48592 3.3567C4.56896 3.30969 4.66265 3.27635 4.76164 3.25859C4.86062 3.24084 4.96297 3.23901 5.06283 3.25321C5.1627 3.26741 5.25812 3.29736 5.34366 3.34136L11.4721 6.4985C11.6432 6.58609 11.8415 6.63259 12.044 6.63259C12.2465 6.63259 12.4449 6.58609 12.616 6.4985L18.7444 3.34136C18.9171 3.2565 19.124 3.22968 19.3208 3.26667C19.5177 3.30366 19.6887 3.40151 19.7973 3.53923C19.9059 3.67694 19.9434 3.84356 19.9017 4.00334C19.86 4.16312 19.7425 4.30333 19.5743 4.39391Z"
                                    fill="#ABB3BB"/>
                            </svg>
                        </div>

                        <div class="form-group">
                            <jet-input id="password" type="password" v-model="form.password" required
                                       autocomplete="new-password" placeholder="Enter Your Password"/>
                            <svg width="20" height="18" viewBox="0 0 20 18" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16.6833 7.83187V5.29802C16.6833 3.94949 15.9893 2.65619 14.754 1.70264C13.5186 0.749081 11.8431 0.213379 10.096 0.213379C8.34893 0.213379 6.67342 0.749081 5.43805 1.70264C4.20269 2.65619 3.50866 3.94949 3.50866 5.29802V7.83187C2.77789 7.93073 2.1155 8.22494 1.63754 8.66294C1.15959 9.10093 0.896553 9.65478 0.894531 10.2274V15.0133C0.895296 15.6602 1.22863 16.2805 1.82135 16.7379C2.41407 17.1953 3.21772 17.4525 4.05588 17.453H16.139C16.9767 17.4523 17.7798 17.1951 18.3722 16.7379C18.9645 16.2807 19.2977 15.6608 19.2986 15.0142V10.2274C19.2967 9.65463 19.0335 9.10063 18.5553 8.6626C18.0771 8.22456 17.4144 7.93046 16.6833 7.83187ZM11.0003 12.3599V14.0632C11.0034 14.1562 10.9823 14.2488 10.9383 14.3354C10.8943 14.422 10.8282 14.5009 10.7441 14.5675C10.66 14.6341 10.5594 14.6871 10.4483 14.7232C10.3373 14.7594 10.218 14.778 10.0974 14.778C9.97692 14.778 9.85761 14.7594 9.74655 14.7232C9.63549 14.6871 9.53493 14.6341 9.45079 14.5675C9.36665 14.5009 9.30063 14.422 9.25663 14.3354C9.21263 14.2488 9.19153 14.1562 9.19458 14.0632V12.3603C9.0205 12.2576 8.879 12.1256 8.78079 11.9743C8.68258 11.8231 8.63024 11.6566 8.62772 11.4875C8.63535 11.1906 8.79348 10.9079 9.06817 10.7C9.34286 10.4922 9.7122 10.3757 10.0969 10.3757C10.4815 10.3757 10.8509 10.4922 11.1256 10.7C11.4003 10.9079 11.5584 11.1906 11.566 11.4875C11.5635 11.6565 11.5113 11.8228 11.4133 11.974C11.3153 12.1251 11.1741 12.2571 11.0003 12.3599ZM14.2761 7.7895H5.91767V5.29802C5.91116 4.87121 6.01446 4.44764 6.22157 4.05186C6.42867 3.65608 6.73548 3.29596 7.1242 2.99236C7.51292 2.68877 7.97583 2.44774 8.4861 2.28323C8.99638 2.11872 9.54387 2.03402 10.0969 2.03402C10.6499 2.03402 11.1974 2.11872 11.7076 2.28323C12.2179 2.44774 12.6808 2.68877 13.0695 2.99236C13.4583 3.29596 13.7651 3.65608 13.9722 4.05186C14.1793 4.44764 14.2826 4.87121 14.2761 5.29802V7.7895Z"
                                    fill="#ABB3BB"/>
                            </svg>
                        </div>

                        <div class="form-group">
                            <jet-input id="password_confirmation" type="password" placeholder="Confirm Password"
                                       v-model="form.password_confirmation"
                                       required
                                       autocomplete="new-password"/>
                            <svg width="20" height="18" viewBox="0 0 20 18" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16.6833 7.83187V5.29802C16.6833 3.94949 15.9893 2.65619 14.754 1.70264C13.5186 0.749081 11.8431 0.213379 10.096 0.213379C8.34893 0.213379 6.67342 0.749081 5.43805 1.70264C4.20269 2.65619 3.50866 3.94949 3.50866 5.29802V7.83187C2.77789 7.93073 2.1155 8.22494 1.63754 8.66294C1.15959 9.10093 0.896553 9.65478 0.894531 10.2274V15.0133C0.895296 15.6602 1.22863 16.2805 1.82135 16.7379C2.41407 17.1953 3.21772 17.4525 4.05588 17.453H16.139C16.9767 17.4523 17.7798 17.1951 18.3722 16.7379C18.9645 16.2807 19.2977 15.6608 19.2986 15.0142V10.2274C19.2967 9.65463 19.0335 9.10063 18.5553 8.6626C18.0771 8.22456 17.4144 7.93046 16.6833 7.83187ZM11.0003 12.3599V14.0632C11.0034 14.1562 10.9823 14.2488 10.9383 14.3354C10.8943 14.422 10.8282 14.5009 10.7441 14.5675C10.66 14.6341 10.5594 14.6871 10.4483 14.7232C10.3373 14.7594 10.218 14.778 10.0974 14.778C9.97692 14.778 9.85761 14.7594 9.74655 14.7232C9.63549 14.6871 9.53493 14.6341 9.45079 14.5675C9.36665 14.5009 9.30063 14.422 9.25663 14.3354C9.21263 14.2488 9.19153 14.1562 9.19458 14.0632V12.3603C9.0205 12.2576 8.879 12.1256 8.78079 11.9743C8.68258 11.8231 8.63024 11.6566 8.62772 11.4875C8.63535 11.1906 8.79348 10.9079 9.06817 10.7C9.34286 10.4922 9.7122 10.3757 10.0969 10.3757C10.4815 10.3757 10.8509 10.4922 11.1256 10.7C11.4003 10.9079 11.5584 11.1906 11.566 11.4875C11.5635 11.6565 11.5113 11.8228 11.4133 11.974C11.3153 12.1251 11.1741 12.2571 11.0003 12.3599ZM14.2761 7.7895H5.91767V5.29802C5.91116 4.87121 6.01446 4.44764 6.22157 4.05186C6.42867 3.65608 6.73548 3.29596 7.1242 2.99236C7.51292 2.68877 7.97583 2.44774 8.4861 2.28323C8.99638 2.11872 9.54387 2.03402 10.0969 2.03402C10.6499 2.03402 11.1974 2.11872 11.7076 2.28323C12.2179 2.44774 12.6808 2.68877 13.0695 2.99236C13.4583 3.29596 13.7651 3.65608 13.9722 4.05186C14.1793 4.44764 14.2826 4.87121 14.2761 5.29802V7.7895Z"
                                    fill="#ABB3BB"/>
                            </svg>
                        </div>

                        <div class="form-group" v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
                            <div class="custom-control custom-checkbox">
                                <jet-checkbox name="terms" id="terms" v-model:checked="form.terms"/>

                                <label class="custom-control-label" for="terms">
                                    I agree to the <a target="_blank" :href="route('terms.show')">Terms of
                                    Service</a>
                                    and <a
                                    target="_blank" :href="route('policy.show')">Privacy Policy</a>
                                </label>
                            </div>
                        </div>

                        <div class="mb-0">
                            <div class="align-items-baseline">
                                <loading-button :loading="form.processing" class="ml-4 register-button"
                                                :class="{ 'text-white-50': form.processing }" type="submit">Sign Up
                                </loading-button>
                                <inertia-link :href="route('login')" class="text-muted mr-3 text-decoration-none">
                                    Already registered?
                                </inertia-link>
                            </div>
                        </div>
                    </form>
                </div>
                <!--                </jet-authentication-card>-->
            </div>
        </div>
    </div>


</template>

<script>
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
import JetButton from '@/Jetstream/Button'
import JetInput from '@/Jetstream/Input'
import JetCheckbox from "@/Jetstream/Checkbox";
import JetLabel from '@/Jetstream/Label'
import JetValidationErrors from '@/Jetstream/ValidationErrors'
import LoadingButton from "@/Jetstream/LoadingButton";
import Plans from "@/Pages/Auth/Plans";

export default {
    components: {
        JetAuthenticationCard,
        JetAuthenticationCardLogo,
        JetButton,
        JetInput,
        JetCheckbox,
        JetLabel,
        JetValidationErrors,
        LoadingButton,
        'plans': Plans
    },

    data() {
        return {
            form: this.$inertia.form({
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                terms: false,
            }),
            plan: null,
            plans: ['basic', 'support', 'support+']
        }
    },

    methods: {
        submit() {
            if (this.plans.includes(localStorage.getItem('plan'))) {
                this.form.post(this.route('register'), {
                    onFinish: () => this.form.reset('password', 'password_confirmation'),
                })
            } else {
                this.toast.error('You need to select one plan')
            }
        }
    }
}
</script>
<style scoped>
.container {
    height: 100vh;
}

h1 {
    font-size: 50px;
    font-style: normal;
    font-weight: bold;
}

@media (max-width: 767.98px) {
    .image-column {
        display: none;
    }
}

p.trial {
    font-size: 20px;
    text-align: center;
    text-decoration: underline;
}

.register-button {
    width: 100%;
    margin: 0 !important;
    background: rgba(76, 110, 215, 0.9);
    border-radius: 5px;
    padding: 10px;
    text-transform: none !important;
}

.form-group {
    position: relative;
}

svg {
    position: absolute;
    top: 15px;
    left: 13px;
}

</style>
