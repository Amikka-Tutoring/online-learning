<template>
    <app-layout>
<!--            <div  class="d-flex justify-content-center">-->
                <div v-if="form.currentstep != 1 && form.currentstep !=8" class="row justify-content-center align-items-center" style="margin-bottom: 70px">
                        <div class="progress" style="height: 5px; width: 370px; margin-right: 20px">
                            <div style="background: #56C880;" :style="{width: form.progress_value +'%'}" class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    <div class="blue-text">Skip</div>
                    </div>

<!--            </div>-->
            <p v-if="form.errors.length">
                <b>Please correct the following error(s):</b>
                <ul>
                    <li class="red-text" v-for="error in form.errors">{{ error }}</li>
                </ul>
            </p>
        <div>
            <form class="form">
                <div v-if="form.currentstep === 1" class="first-step">
                    <h1><span class="blue-text">Initial</span> Questionnaire</h1>
                    <div class="row">
                        <div class="col-2">

                        </div>
                        <div class="col-10">
                            <ul>
                                <li>
                                    The <span class="blue-text">initial questionnaire</span> helps us understand which courses you want to <span class="blue-text">improve on, your goals,</span> and <span class="blue-text">your availability.</span>
                                </li>
                                <li>
                                    Based on your <span class="blue-text">responses</span> we build you a personalized course with <span class="blue-text">email</span> and <span class="blue-text">text reminders</span> so that you don’t ever miss a lesson.
                                </li>
                            </ul>
                            <button v-if="form.currentstep === 1" @click.prevent="next()" class="blue-button">Start</button>
<!--                            <div class="row">-->

<!--                            </div>-->
                        </div>
                    </div>
                </div>
                <div v-if="form.currentstep === 2">
                    <p class="question-box">
                        Choose one or more of our available courses below. The first course you choose will be covered by your subscription, any additonal courses will cost $30/month extra.
                    </p>
                    <div class="row">
                        <div class="col-lg-3 col-12">
                            <div class="input-cards">
                                <img class="w-100" :src="'images/course-img.png'">
                                <div class="row">
                                    <div class="col-9">
                                        <h4>SAT Self-Paced</h4>
                                    </div>
                                    <div class="col-3">
                                        <label for="check-box"></label>
                                        <input id="check-box" type="checkbox" name="course-0" value="sat-self-paced" v-model="form.course">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-12">
                            <div class="input-cards">
                                <img class="w-100" :src="'images/course-img.png'">
                                <div class="row">
                                    <div class="col-9">
                                        <h4>Algebra 1 Self-Paced</h4>
                                    </div>
                                    <div class="col-3">
                                        <label for="check-box-0"></label>
                                        <input id="check-box-0" type="checkbox" name="course-1" value="algebra1-self-paced" v-model="form.course">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-12">
                            <div class="input-cards">
                                <img class="w-100" :src="'images/course-img.png'">
                                <div class="row">
                                    <div class="col-9">
                                        <h4>Algebra 2 Self-Paced</h4>
                                    </div>
                                    <div class="col-3">
                                        <label for="check-box-1"></label>
                                        <input id="check-box-1" type="checkbox" name="course-2" value="algebra2-self-paced" v-model="form.course">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-12">
                            <div class="input-cards">
                                <img class="w-100" :src="'images/course-img.png'">
                                <div class="row">
                                    <div class="col-9">
                                        <h4>Pre-Calculus Self Paced</h4>
                                    </div>
                                    <div class="col-3">
                                        <label for="check-box-2"></label>
                                        <input id="check-box-2" type="checkbox" name="course-3" value="calculus-self-paced" v-model="form.course">
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
                        <input type="text" name="desire_score" v-model="form.desire_score">
                    </div>

                </div>
                <div v-if="form.currentstep === 4">
                    <div class="row justify-content-center align-items-center">
                        <p class="question-box">
                            What is your SAT exam?
                        </p>
                    </div>
                    <div class="row justify-content-center align-items-center">
                        <img :src="'/images/calendar.png'">
                        <input type="checkbox" name="calendar" v-model="form.calendar">
                    </div>
                </div>
                <div v-if="form.currentstep === 5">
                    <div class="row justify-content-center align-items-center">
                        <p class="question-box">
                            We recommend two 1.5 hour sessions per week to start off. What two days work best for you?
                        </p>
                    </div>
                    <div class="row justify-content-center align-items-center">
                        <div class="days-box">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-7">
                                        <label for="monday">Monday</label>
                                    </div>
                                    <div class="col-5">
                                        <input type="checkbox" id="monday" name="days" v-model="form.days">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-7">
                                        <label for="tuesday">Tuesday</label>
                                    </div>
                                    <div class="col-5">
                                        <input type="checkbox" id="tuesday" name="days" v-model="form.days">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-7">
                                        <label for="wednesday">Wednesday</label>
                                    </div>
                                    <div class="col-5">
                                        <input type="checkbox" id="wednesday" name="days" v-model="form.days">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-7">
                                        <label for="thursday">Thursday</label>
                                    </div>
                                    <div class="col-5">
                                        <input type="checkbox" id="thursday" name="days" v-model="form.days">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-7">
                                        <label for="friday">Friday</label>
                                    </div>
                                    <div class="col-5">
                                        <input type="checkbox" id="friday" name="days" v-model="form.days">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-7">
                                        <label for="saturday">Saturday</label>
                                    </div>
                                    <div class="col-5">
                                        <input type="checkbox" id="saturday" name="days" v-model="form.days">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-7">
                                        <label for="sunday">Sunday</label>
                                    </div>
                                    <div class="col-5">
                                        <input type="checkbox" id="sunday" name="days" v-model="form.days">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="form.currentstep === 6">
                    <div class="row justify-content-center align-items-center">
                        <p class="question-box">
                            What times work for you on Monday and Friday?
                        </p>
                    </div>
                    <div class="row justify-content-center align-items-center">
                        <div class="days-box">
                            <div class="row">
                                <div class="col-6">
                                    <label for="monday-time">Monday</label>
                                </div>
                                <div class="col-6">
                                    <input type="time" id="monday-time" name="start_time" v-model="form.start_time">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="friday-time">Friday</label>
                                </div>
                                <div class="col-6">
                                    <input type="time" id="friday-time" name="end_time" v-model="form.end_time">
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
                        <div class="days-box">
                            <div class="row">
                                <div class="col-5">
                                    <label for="email">Email</label>
                                </div>
                                <div class="col-7">
                                    <input type="email" id="email" name="email" v-model="form.email">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <label for="phone">Phone Number</label>
                                </div>
                                <div class="col-7">
                                    <input type="text" id="phone" name="tel" v-model="form.tel">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="form.currentstep === 8">
                    <label for="first_name">First name:</label>
                    <input name="firstname" required id="first_name" v-model="form.first_name" />
                    <label for="last_name">Last name:</label>
                    <input name="lastname" id="last_name" v-model="form.last_name" />
                </div>
                <div v-if="form.currentstep === 9">
                    <label>Email:</label>
                    <input name="email" v-model="form.email" />
                </div>
                <div v-if="form.currentstep === 10">
                    <label for="test">Test:</label>
                    <input id="test" v-model="form.test" />
                </div>

                <div class="row justify-content-center align-items-center">
                    <button v-if="form.currentstep!=7 && form.currentstep!=1" @click.prevent="next()" class="blue-button" style="font-size: 24px">Next</button>
                    <button v-if="form.currentstep==7" @click.prevent="submit()" class="blue-button" style="font-size: 24px">Finish</button>
                </div>

            </form>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import { ref } from 'vue'
import { reactive } from 'vue'

import { Inertia } from '@inertiajs/inertia'

export default {
    components: {
        AppLayout,
    },
    data() {
      return {
          currenstep: 1
      }
    },

    setup () {
        const form = reactive({
            errors:[],
            course: [],
            desire_score: null,
            days: [],
            calendar: null,
            start_time: null,
            end_time: null,
            email: null,
            tel: null,
            progress_value: 0,
            currentstep: 1,
        })


        function next () {

            // console.log(form.currentstep)
            // if(form.currentstep === 2 && !form.course){
            //    return form.errors.push('Course is required')
            // }
            // if(form.currentstep === 3 && !form.desire_score){
            //     return form.errors.push('Desire Score is required')
            // }
            // if(form.currentstep === 4 && !form.calendar){
            //     return form.errors.push('Calendar required')
            // }
            // if(form.currentstep === 5 && !form.days){
            //     return form.errors.push('Days required')
            // }
            // if(form.currentstep === 6 && (!form.start_time || !form.end_time)){
            //     return form.errors.push('Start end End Time are required')
            // }
            // if(form.currentstep === 7 && (!form.email || !form.tel)){
            //     return form.errors.push('Start end End Time are required')
            // }
            // else {
                form.errors = []
                form.currentstep++
                console.log(form.currentstep)
                form.progress_value = form.progress_value + 15
                console.log(form.progress_value)
            // }
        }
        function submit(){
            form.progress_value = 100
            console.log(form)
        }
        function checkForm(e){
            // console.log('checkForm')
            e.preventDefault();
            this.errors = [];

            if (!this.firstname) {
                this.errors.push("Name required.");
            }
            if (!this.lastname) {
                this.errors.push('Email required.');
            }
            if (!this.errors.length) {
                return true;
            }
        }

        return {form, submit, next, checkForm}
    }
}
</script>
