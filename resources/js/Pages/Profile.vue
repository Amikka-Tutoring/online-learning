<template>
    <app-layout>
        <div class="container">


            <div class="profile-wrapper" data-aos="fade-up">
                <div class="btn-group">
                    <button @click="tab = changeTab('specific')"
                            v-bind:class="[tab==='specific' ? 'active-button' : 'passive-button']">Course Specific
                    </button>
                    <button @click="tab = changeTab('general')"
                            v-bind:class="[tab==='general' ? 'active-button' : 'passive-button']">General
                    </button>
                </div>
                <div class="row justify-content-center">
                    <div v-if=loading class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <transition>
                    <div v-if="tab === 'specific'" class="profile-course-listing">
                        <ul>
                            <li>
                                <div class="row justify-content-between">
                                    <div class="col-lg-10 col-7 align-items-center">
                                        <h5>Enrolled Courses</h5>
                                        <span class="h6"
                                              v-for="(c,index) in user_data.enrollments">
                                            <span v-if="index>0">, </span>{{ c.course.name }}</span>
                                    </div>
                                    <div class="col-lg-2 align-self-center col-2 align-items-center"
                                         v-on:click="openModal()">
                                        <p class="text-right"><i style="color: #4C6ED7;" class="fas fa-angle-right"></i>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row justify-content-between">

                                    <div class="col-lg-10 col-7 align-items-center">
                                        <h5>Exam Date</h5>
                                        <h6>{{ moment(user_data.profile.exam_date).format("MM/DD") }}</h6>
                                    </div>
                                    <div class="col-lg-2 align-self-center col-2 align-items-center"
                                         v-on:click="openExamDateModal()">
                                        <p class="text-right">Edit</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row justify-content-between">

                                    <div class="col-lg-10 col-7 align-items-center">
                                        <h5>Lesson Dates</h5>
                                        <h6><span class="" v-for="(days,index) in user.lesson_dates">
                                            <span v-if="index!=0">, </span>{{ days.day }}</span>
                                        </h6>
                                    </div>
                                    <div class="col-lg-2 align-self-center col-2 align-items-center">
                                        <a href="/set-calendar"><p class="text-right">Edit</p></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row justify-content-between">

                                    <div class="col-lg-10 col-7 align-items-center">
                                        <h5>Lesson Frequency</h5>
                                        <h6><span class="mr-2">{{ user.lesson_dates.length }}x a week</span>
                                        </h6>
                                    </div>
                                    <div class="col-lg-2 align-self-center col-2 align-items-center">
                                        <a href="/set-calendar"><p class="text-right">Edit</p></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row justify-content-between">

                                    <div class="col-lg-10 col-7 align-items-center">
                                        <h5>Lesson Length</h5>
                                        <h6><span class="mr-2">{{ user.profile.lesson_length }} minutes</span>
                                        </h6>
                                    </div>
                                    <div class="col-lg-2 align-self-center col-2 align-items-center">
                                        <div class="text-right">
                                            <select class="blue-text tag-select" v-model="lesson_length"
                                                    name="tag"
                                                    @change="set_lesson_length($event)">
                                                <option v-bind:value="60">
                                                    60
                                                </option>
                                                <option v-bind:value="90">
                                                    90
                                                </option>
                                                <option v-bind:value="120">
                                                    120
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row justify-content-between">
                                    <div class="col-lg-10 col-7 align-items-center">
                                        <h5>Goal Score</h5>
                                        <h6><span class="mr-2">{{ user.profile.desire_score }}</span>
                                        </h6>
                                    </div>
                                    <div class="col-lg-2 align-self-center col-2 align-items-center">
                                        <p class="text-right" @click="openScoreGoalModal">Edit</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row justify-content-between">

                                    <div class="col-lg-10 col-7 align-items-center">
                                        <h5>Practice Exam Dates</h5>
                                        <h6><span v-if="user_data.practice_exam_dates.length"
                                                  v-for="(p_e,index) in user_data.practice_exam_dates"><span
                                            v-if="index!==0">, </span>{{ moment(p_e.date_time).format("MM/DD") }}</span>
                                            <span v-else>N/A</span>
                                        </h6>
                                    </div>
                                    <div class="col-lg-2 align-self-center col-2 align-items-center">
                                        <a href="/set-calendar"><p class="text-right">Edit</p></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row justify-content-between">

                                    <div class="col-lg-10 col-7 align-items-center">
                                        <h5>Diagnostic Score</h5>
                                        <h6><span class="mr-2">1300</span>
                                        </h6>
                                    </div>
                                    <div class="col-lg-2 align-self-center col-2 align-items-center">
                                        <p class="text-right"><i class="blue-text fas fa-lock"></i></p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row justify-content-between">

                                    <div class="col-lg-10 col-7 align-items-center">
                                        <h5>Learning Style</h5>
                                        <h6>{{ user.profile.learning_style }}</h6>
                                    </div>
                                    <div class="col-lg-2 align-self-center col-2 align-items-center">
                                        <p class="text-right"><i class="blue-text fas fa-angle-right"></i>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row justify-content-between">

                                    <div class="col-lg-10 col-7 align-items-center">
                                        <h5>Course Level</h5>
                                        <h6>{{ user_tag }}</h6>
                                    </div>

                                    <div class="col-lg-2 align-self-center col-2 align-items-center">
                                        <div class="text-right">
                                            <select class="blue-text tag-select" v-model="key"
                                                    name="tag" id=""
                                                    @change="onChange($event)">
                                                <option v-for="tag in tags" v-bind:value="tag.name">
                                                    {{ tag.name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row justify-content-between">

                                    <div class="col-lg-10 col-7 align-items-center">
                                        <h5>Tutor Match Personality</h5>
                                        <h6>{{ user.profile.tutor_match }}</h6>
                                    </div>
                                    <div class="col-lg-2 align-self-center col-2 align-items-center">
                                        <p class="text-right"><i class="blue-text fas fa-lock"></i></p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div v-else class="profile-course-listing">
                        <ul>
                            <li>
                                <div class="row justify-content-between">

                                    <div class="col-lg-11 col-9 align-items-center">
                                        <h5>Name</h5>
                                        <h6>{{ user.name }}</h6>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">

                                    <div class="col-lg-11 col-9 align-items-center">
                                        <h5>Email</h5>
                                        <h6>{{ user.email }}</h6>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">

                                    <div class="col-lg-11 col-9 align-items-center">
                                        <h5>Password</h5>
                                        <a href="user/profile"><h6>Tap to Change Password</h6></a>

                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">

                                    <div class="col-lg-11 col-9 align-items-center">
                                        <h5>Phone Number</h5>
                                        <h6>{{ user.profile.reminder_phone }}</h6>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">

                                    <div class="col-lg-11 col-9 align-items-center">
                                        <h5>Payment</h5>
                                        <a :href="route('add.payment.method')"><h6>Tap to Change Payment</h6></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row justify-content-between">
                                    <div class="col-lg-10 col-7 align-items-center">
                                        <h5>Privacy Policy</h5>
                                        <span class="h6 mr-2">Tap to See Privacy Policy</span>
                                    </div>
                                    <div class="col-lg-2 align-self-center col-2 align-items-center">
                                        <p class="text-right"><i style="color: #4C6ED7;" class="fas fa-angle-right"></i>
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </transition>
                <a href="" @click="logout()" class="blue-text">LOG OUT</a>
            </div>
        </div>
        <CheckList :user="user"/>
    </app-layout>
    <div class="modal fade" id="modal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body px-5 pt-5">
                    <div class="form-group row align-items-center" v-for="course in available_courses">
                        <label for="" class="col-9 h4 m-0">{{ course.name }}</label>
                        <input type="checkbox" class="form-control col-3 enroll_course_checkboxes" v-model="plans"
                               :value="course.plan_id"/>
                    </div>
                    <p v-if="available_courses.length ===0">You are enrolled to all of the courses.</p>
                    <p><u><strong>Each additional course is $30/monthly</strong></u></p>
                </div>
                <div class="modal-footer justify-content-start px-5">
                    <button type="button" class="btn btn-primary" v-on:click="enroll">Enroll <span
                        v-if="loadingButton"
                        class="spinner-border ml-2"
                        style="width: 1rem; height: 1rem"></span></button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-lesson-date" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Exam Date</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="form-group">
                            <input type="date" class="form-control" id="datetimepicker"
                                   v-model="user_data.profile.exam_date">
                            <div id="datepicker"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="changeExamDate">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-goal-score" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Score Goal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="form-group">
                            <input type="number" class="form-control"
                                   v-model="user.profile.desire_score">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="changeScoreGoal">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.enroll_course_checkboxes:focus {
    border: none !important;
    outline: 0 !important;
    box-shadow: none !important;
}
</style>

<script>
import AppLayout from '@/Layouts/AppLayout'
import CheckList from "../components/CheckList";
import moment from "moment";

export default {
    components: {
        AppLayout,
        CheckList
    },

    methods: {
        logout() {
            this.$inertia.post(route("logout"));
        },
        onChange(event, props) {
            axios.post(route('change.tag'), event.target.value)
                .then(response => {
                    this.toast.success(response.data.message);
                    this.user_tag = response.data.tag;
                })
                .catch(error => {
                    Object.values(error.response.data.errors).flat().forEach(element => this.toast.error(element))
                });
        },
        changeTab(tab_name) {
            this.loading = true;
            setTimeout(() => {
                this.tab = tab_name;
                this.loading = false;
            }, 500);

        },
        set_lesson_length(event) {
            axios.post(route('change.lesson.length', event.target.value))
                .then(response => {
                    this.toast.success(response.data.message);
                    this.user.profile.lesson_length = event.target.value
                })
                .catch(error => {
                    Object.values(error.response.data.errors).flat().forEach(element => this.toast.error(element))
                });
        },
        openModal: function () {
            $('#modal').modal('show');
        },
        openExamDateModal: function () {
            $('#modal-lesson-date').modal('show');
        },
        openScoreGoalModal: function () {
            $('#modal-goal-score').modal('show');
        },
        hideModal: function () {
            $('#modal').modal('hide');
        },
        changeExamDate: function () {
            axios.post(route('change.exam.date', this.user_data.profile.exam_date)).then((response) => {
                this.toast.success(response.data.message)
            }).catch(() => {
                console.log('error')
            });
        },
        changeScoreGoal: function () {
            axios.post(route('change.score.goal', this.user.profile.desire_score)).then((response) => {
                this.toast.success(response.data.message)
            }).catch(() => {
                console.log('error')
            });
        },
        enroll: function () {
            this.loadingButton = true
            axios.post(route('subscribe.course', {
                courses: this.plans
            }))
                .then(response => {
                    this.toast.success('Enrolled Successfully')
                    this.available_courses = response.data.available_courses
                })
                .catch(error => {
                    Object.values(error.response.data.errors).flat().forEach(element => this.toast.error(element))
                }).finally(() => {
                this.loadingButton = false
                this.hideModal()
            });
        }
    },
    props: ['user', 'tags', 'user_tag', 'user_data', 'available_courses'],
    data() {
        return {
            avatar: this.user.profile_photo_path,
            tab: 'specific',
            moment: moment,
            user_tag: this.user_tag,
            loadingButton: false,
            plans: [],
            available_courses: this.available_courses,
            formula: 'x=\\frac{-b\\pm \\sqrt{b^2-4ac}}{2a}'
        }
    },
}
</script>
