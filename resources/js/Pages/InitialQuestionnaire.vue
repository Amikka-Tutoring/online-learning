<template>
    <app-layout>
        <div class="container">


            <!--            <div  class="d-flex justify-content-center">-->
            <div v-if="form.currentstep != 1 && form.currentstep !=8"
                 class="row justify-content-center align-items-center" style="margin-bottom: 70px">
                <div class="progress" style="height: 5px; width: 370px; margin-right: 20px">
                    <div style="background: #56C880;" :style="{width: form.progress_value +'%'}" class="progress-bar"
                         role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <!--                <div class="blue-text">Skip</div>-->
            </div>

            <!--            </div>-->
            <div v-if="form.errors.length">
                <div class="alert alert-danger" v-for="error in form.errors">{{ error }}</div>
            </div>
            <div>
                <form class="form">
                    <div v-if="form.currentstep === 1" class="first-step">
                        <h1 class="blue-text">Initial Questionnaire</h1>
                        <div class="row" style="margin-left: 100px">
                            <ol>
                                <li>
                                    The initial questionnaire helps us understand which
                                    courses you want to <strong>improve on, your goals, and your availability.</strong>
                                </li>
                                <li>
                                    Based on your responses we build you a personalized
                                    course with email and text reminders so that you don’t ever miss a lesson.
                                </li>
                                <li>
                                    <div class="button-row row">
                                        <button v-if="form.currentstep === 1" @click.prevent="next()"
                                                class="blue-button">
                                            Start
                                        </button>
                                    </div>

                                </li>

                            </ol>

                        </div>
                    </div>
                    <div v-if="form.currentstep === 2">
                        <p class="question-box">
                            Choose one or more of our available courses below. The first course you choose will be
                            covered by your subscription, any additonal courses will cost $30/month extra.
                        </p>
                        <div class="row">
                            <div class="col-lg-3 col-12">
                                <div class="input-cards">
                                    <img class="w-100" :src="'images/course-img.png'">
                                    <div class="row">
                                        <div class="col-9">
                                            <h4>SAT</h4>
                                        </div>
                                        <div class="col-3">
                                            <label for="check-box"></label>
                                            <input id="check-box" type="checkbox" :value="0"
                                                   v-model="form.courses">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-12" v-for="c in courses_data">
                                <div class="input-cards">
                                    <img class="w-100" :src="'images/course-img.png'">
                                    <div class="row">
                                        <div class="col-9">
                                            <h4>{{ c.name }}</h4>
                                        </div>
                                        <div class="col-3">
                                            <label for="check-box"></label>
                                            <input id="check-box" type="checkbox" :value="c.plan_id"
                                                   v-model="form.courses">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="third-step" v-if="form.currentstep === 3">
                        <div class="row justify-content-center align-items-center">
                            <p class="question-box">
                                What is your desired score on the SAT?
                            </p>
                        </div>
                        <div class="row justify-content-center align-items-center">
                            <input placeholder="ex. 87" type="number" name="desire_score" min="1"
                                   v-model="form.desire_score">
                        </div>

                    </div>
                    <div v-if="form.currentstep === 4">
                        <div class="row justify-content-center align-items-center">
                            <p class="question-box">
                                When is your SAT exam?
                            </p>
                        </div>
                        <div class="row justify-content-center align-items-center">
                            <input type="date" id="date" class="datepicker" v-model="form.exam_date">
                        </div>
                    </div>
                    <div v-if="form.currentstep === 5">
                        <div class="row justify-content-center align-items-center">
                            <p class="question-box">
                                We recommend two 1.5 hour sessions per week to start off. What two days work best for
                                you?
                            </p>
                        </div>
                        <div class="row justify-content-center align-items-center">
                            <div class="days-box week-days">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-7">
                                            <label for="monday">Monday</label>
                                        </div>
                                        <div class="col-5">
                                            <input type="checkbox" id="monday" name="monday" value="Monday"
                                                   :value="n"
                                                   :disabled="form.days.length >= 2 "
                                                   v-model="form.days">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-7">
                                            <label for="tuesday">Tuesday</label>
                                        </div>
                                        <div class="col-5">
                                            <input type="checkbox" id="tuesday" name="tuesday" value="Tuesday"
                                                   :disabled="form.days.length >= 2 "
                                                   v-model="form.days">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-7">
                                            <label for="wednesday">Wednesday</label>
                                        </div>
                                        <div class="col-5">
                                            <input type="checkbox" id="wednesday" name="wednesday" value="Wednesday"
                                                   :disabled="form.days.length >= 2 "
                                                   v-model="form.days">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-7">
                                            <label for="thursday">Thursday</label>
                                        </div>
                                        <div class="col-5">
                                            <input type="checkbox" id="thursday" value="Thursday" name="thursday"
                                                   :disabled="form.days.length >= 2 "
                                                   v-model="form.days">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-7">
                                            <label for="friday">Friday</label>
                                        </div>
                                        <div class="col-5">
                                            <input type="checkbox" id="friday"
                                                   :disabled="form.days.length >= 2 "
                                                   name="friday" v-model="form.days" value="Friday">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-7">
                                            <label for="saturday">Saturday</label>
                                        </div>
                                        <div class="col-5">
                                            <input type="checkbox" id="saturday" name="saturday" value="Saturday"
                                                   :disabled="form.days.length >= 2 "
                                                   v-model="form.days">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-7">
                                            <label for="sunday">Sunday</label>
                                        </div>
                                        <div class="col-5">
                                            <input type="checkbox" id="sunday" value="Sunday"
                                                   :disabled="form.days.length >= 2 "
                                                   name="sunday" v-model="form.days">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="form.currentstep === 6">
                        <div class="row justify-content-center align-items-center">
                            <p class="question-box">
                                What times work for you on <span>{{ form.days[0] }}</span> and
                                <span>{{ form.days[1] }}</span>?
                            </p>
                        </div>
                        <div class="row justify-content-center align-items-center">
                            <div class="days-box work-times">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="monday-time">{{ form.days[0] }}</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="time" id="monday-time" name="first_day_time"
                                               v-model="form.first_day_time">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="friday-time">{{ form.days[1] }}</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="time" id="friday-time" name="second_day_time"
                                               v-model="form.second_day_time">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="form.currentstep === 7">
                        <div class="row justify-content-center align-items-center">
                            <p class="question-box">
                                Please provide the best phone number and email to send you lesson reminders.
                            </p>
                        </div>
                        <div class="row justify-content-center align-items-center">
                            <div class="days-box email-box">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="email">Email</label>
                                    </div>
                                    <div class="col-7">
                                        <input placeholder="test@gmail.com" type="email" id="email" name="email"
                                               v-model="form.email">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="phone">Phone Number</label>
                                    </div>
                                    <div class="col-7">
                                        <input v-mask="['(###) ###-####']" type="text" id="phone" name="tel"
                                               v-model="form.tel" placeholder="(123) 456-7890">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center align-items-center">
                        <button v-if="form.currentstep!=7 && form.currentstep!=1" @click.prevent="next()"
                                class="blue-button" style="font-size: 24px">Next
                        </button>
                        <button :disabled="form.submitLoading" v-if="form.currentstep==7" @click.prevent="submit()"
                                class="blue-button"
                                style="font-size: 24px">Finish <span v-if="form.submitLoading"
                                                                     class="spinner-border ml-2"
                                                                     style="width: 1.5rem; height: 1.5rem"></span>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import {ref} from 'vue'
import {reactive} from 'vue'
import {mask} from 'vue-the-mask'
import {useToast} from "vue-toastification";

import {Inertia} from '@inertiajs/inertia'

export default {
    directives: {mask},
    components: {
        AppLayout,
        mask,
    },
    props: ['courses_data'],
    mount() {
        // $("#date").data("DateTimePicker").show();
    },

    data() {
        return {
            currenstep: 1,
        }
    },

    setup() {
        const form = reactive({
            errors: [],
            courses: [],
            desire_score: null,
            days: [],
            exam_date: null,
            first_day_time: null,
            second_day_time: null,
            email: null,
            tel: null,
            progress_value: 0,
            currentstep: 1,
            plan: localStorage.getItem('plan'),
            submitLoading: false
        })

        function next() {
            const toast = useToast();
            if (form.currentstep === 2 && !form.courses.length) {
                return toast.error('Course is required');
            }
            if (form.currentstep === 3 && (!form.desire_score || validateNumber(form.desire_score))) {
                return toast.error('Desired Score is required (Number only)');
            }
            if (form.currentstep === 4) {
                if (!form.exam_date)
                    return toast.error('Exam Date is required');
                if (moment().diff(moment(form.exam_date)) >= 0)
                    return toast.error('Date cannot be in the past');
            }
            if (form.currentstep === 5 && (!form.days.length || form.days.length !== 2)) {
                return toast.error('You must select 2 days');
            }
            if (form.currentstep === 6 && (!form.first_day_time || !form.second_day_time)) {
                return toast.error(this.form.days + ' Times are required');
            } else {
                form.currentstep++
                form.progress_value = form.progress_value + 15
            }
        }

        function validEmail(email) {
            var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }

        function submit() {
            const toast = useToast();
            if (form.currentstep === 7 && (!form.email || !form.tel)) {
                form.errors = []
                return toast.error('Email and Phone Number are required')
            } else if (!validEmail(form.email)) {
                form.errors = []
                return toast.error('Valid email required')
            } else {
                form.errors = []
                form.progress_value = 100
                form.submitLoading = true
                axios.post(route('user.initial'), form).then(response => {
                    window.location.href = '/dashboard';
                }).catch(error => {
                    Object.values(error.response.data.errors).flat().forEach(element => toast.error(element))
                }).finally(() => {
                    form.submitLoading = false
                });
            }
        }

        function validateNumber(e) {
            let keyCode = e.keyCode;
            if (keyCode < 48 || keyCode > 57) {
                e.preventDefault();
                return true
            }
            return false
        }

        return {form, submit, next, validEmail}
    }
}
</script>
