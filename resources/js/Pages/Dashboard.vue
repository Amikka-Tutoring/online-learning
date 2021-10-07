<template>
    <app-layout>
        <div class="container">
            <div class="academic">
                <h1 class="blue-text">Academic Diagnostic</h1>
                <div class="academic-content pl-5" style="margin-top: 90px">
                    <transition name="list">
                        <div class="question-box text-left" v-if="academic">
                            <div class="row">
                                <div class="col-lg-11 col-10">
                                    Answer these short quizzes in order to help us build you a personalized program
                                    based on
                                    your current strengths and weaknesses.
                                </div>
                                <div class="col-lg-1 col-2 d-flex align-items-center">
                                    <i v-on:click="academic = disableNotification('academic')"
                                       class="fas fa-times red-text"></i>
                                </div>
                            </div>
                        </div>
                    </transition>
                    <div class="row">
                        <div v-for="a_q in academic_data.quizzes" class="col-lg-3 col-12" data-aos="fade-up"
                             data-aos-delay="50" data-aos-once="true">
                            <div class="input-cards">
                                <img class="w-100" :src="'images/course-img.png'">
                                <a v-if="a_q.questions.length" :href="route('diagnostic.show',a_q.slug)"><h4>
                                    {{
                                        a_q.name
                                    }}</h4></a>
                                <h4 v-else> {{
                                        a_q.name
                                    }}</h4>
                                <div class="row justify-content-center align-items-center"
                                     style="margin-top: 60px; margin-bottom: 10px">
                                    <div class="col-9">
                                        <div class="progress" style="height: 5px; margin-left: 20px">
                                            <div style="background: #4C6ED7; width: 50%" class="progress-bar"
                                                 role="progressbar" aria-valuenow="50" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="blue-text">5/10</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-12" data-aos="fade-up" data-aos-delay="200" data-aos-once="true">
                            <div class="input-cards">
                                <img class="w-100" :src="'images/course-img.png'">
                                <h4>Initial Questionnaire</h4>
                                <div class="row justify-content-center align-items-center"
                                     style="margin-top: 60px; margin-bottom: 10px">
                                    <div class="col-9">
                                        <div class="progress" style="height: 5px; margin-left: 20px">
                                            <div style="background: #4C6ED7; width: 50%" class="progress-bar"
                                                 role="progressbar" aria-valuenow="50" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="blue-text">5/10</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--        Personality-->

            <div class="personality">
                <h1 class="blue-text">Personality Diagnostic</h1>
                <div class="personality-content pl-5" style="margin-top: 90px">
                    <transition name="list">
                        <div v-if="personality" class="question-box text-left">
                            <div class="row">
                                <div class="col-lg-11 col-10">
                                    Answer these 10 questions in order to help us build you a personalized program.
                                </div>
                                <div class="col-lg-1 col-2 d-flex align-items-center">
                                    <i v-on:click="personality = disableNotification('personality')"
                                       class="fas fa-times red-text"></i>
                                </div>
                            </div>
                        </div>
                    </transition>
                    <div class="row">
                        <div v-for="p_q in personality_data.quizzes" class="col-lg-3 col-12" data-aos="fade-up"
                             data-aos-delay="50" data-aos-once="true">
                            <div class="input-cards">
                                <img class="w-100" :src="'images/course-img.png'">
                                <a :href="route('diagnostic.show',p_q.slug)"><h4>{{ p_q.name }}</h4></a>
                                <div class="row justify-content-center align-items-center"
                                     style="margin-top: 60px; margin-bottom: 10px">
                                    <div class="col-9">
                                        <div v-if="p_q.slug === 'learning-style' && learning_style_done"
                                             class="progress" style="height: 5px; margin-left: 20px">
                                            <div style="background: #4C6ED7; width: 100%" class="progress-bar"
                                                 role="progressbar" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                        <div v-else-if="p_q.slug === 'perfect-tutor-match' && tutor_match_done"
                                             class="progress" style="height: 5px; margin-left: 20px">
                                            <div style="background: #4C6ED7; width: 100%" class="progress-bar"
                                                 role="progressbar" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                        <div v-else class="progress" style="height: 5px; margin-left: 20px">
                                            <div style="background: #4C6ED7; width: 0%" class="progress-bar"
                                                 role="progressbar" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="blue-text"
                                             v-if="p_q.slug === 'learning-style' && learning_style_done"><i
                                            class="bi bi-check2-square blue-text fa-2x"></i>
                                        </div>
                                        <div class="blue-text"
                                             v-else-if="p_q.slug === 'perfect-tutor-match' && tutor_match_done"><i
                                            class="bi bi-check2-square blue-text fa-2x"></i>
                                        </div>
                                        <div class="blue-text" v-else><i class="bi bi-app blue-text fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--        Courses-->
            <div class=" courses
                                        " data-aos="fade-up">
                <h1 class="blue-text">My Courses</h1>
                <div class="courses-content pl-5" style="margin-top: 90px">
                    <transition name="list">
                        <p v-if="courses" class="question-box text-left">
                        <div class="row">
                            <div class="col-lg-11 col-10">
                                These course recommendations are based on a variety of factors
                                including your
                                diagnostic, goal score, time until exam, and progress.
                            </div>
                            <div class="col-lg-1 col-2 d-flex align-items-center">
                                <i v-on:click="courses = disableNotification('courses')"
                                   class="fas fa-times red-text"></i>
                            </div>
                        </div>
                        </p>
                    </transition>
                    <div class="row">
                        <div v-for="user_course in user_courses.enrollments"
                             class="col-lg-3 col-12" data-aos="fade-up"
                             data-aos-delay="50" data-aos-once="true">
                            <div class="input-cards">
                                <img class="w-100" :src="'images/course-img.png'">
                                <h4>{{ user_course.course.name }}</h4>
                                <div class="row justify-content-center align-items-center"
                                     style="margin-top: 60px; margin-bottom: 10px">
                                    <div class="col-9">
                                        <div class="progress"
                                             style="height: 5px; margin-left: 20px">
                                            <div style="background: #4C6ED7;"
                                                 v-bind:style="{'width':(user_course.course.quizzes_attempted / user_course.course.quizzes_count)*100 + '%'}"
                                                 class="progress-bar"
                                                 role="progressbar" aria-valuenow="50"
                                                 aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="blue-text">{{
                                                user_course.course.quizzes_attempted
                                            }}/{{
                                                user_course.course.quizzes_count
                                            }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--        Calendar-->

            <div class="calendar" data-aos="fade-up">
                <h1 class="blue-text">Calendar</h1>
                <div class="calendar-content pl-5" style="margin-top: 90px">
                    <transition name="list">
                        <p v-if="calendar" class="question-box text-left">
                        <div class="row">
                            <div class="col-lg-11 col-10">
                                Answer these 10 questions in order to help us build you a
                                personalized program.
                            </div>
                            <div class="col-lg-1 col-2 d-flex align-items-center"
                                 data-aos="fade-up" data-aos-delay="50"
                                 data-aos-once="true">
                                <i v-on:click="calendar = disableNotification('calendar')"
                                   class="fas fa-times red-text"></i>
                            </div>
                        </div>
                        </p>
                    </transition>
                    <div class="row justify-content-md-center">
                        <div class="col-lg-3 col-12">
                            <div class="calendar-box">
                                <div class="row">
                                    <span class="blue-text font-weight-bold">Next Lesson:</span>
                                    <p>{{ days_available[0] }}, {{ first_date }} at
                                        {{ first_day_time }}</p>
                                </div>
                                <div class="row">
                                    <span class="blue-text font-weight-bold">Next Practice Exam:</span>
                                    <p>{{ days_available[1] }}, {{ second_date }} at {{
                                            second_day_time
                                        }}</p>
                                </div>
                            </div>
                            <a type="button" class="blue-text font-weight-bold pt-4"
                               data-toggle="modal"
                               data-target="#exampleModalCenter">
                                Edit Schedule
                            </a>
                        </div>
                    </div>

                </div>
            </div>


            <!--        Note-->
            <div class="notes">
                <h1 class="blue-text">Notes</h1>
                <select name="course" id="" class="form-control w-lg-25 float-right my-4"
                        v-on:change="getNotesByCourse(this.selected_course)"
                        v-model="selected_course">
                    <option value="All">All</option>
                    <option v-for="user_course in user_courses.enrollments">{{
                            user_course.course.name
                        }}
                    </option>
                </select>
                <div class="notes-content pl-5" style="margin-top: 90px;position: relative">
                    <transition name="list">
                        <div v-if="notes" class="question-box text-left">
                            <div class="row">
                                <div class="col-lg-11 col-10">
                                    This is where all of your voice and written notes will be
                                    saved for all of the
                                    courses
                                    that you are taking.
                                </div>
                                <div class="col-lg-1 col-2 d-flex align-items-center">
                                    <i v-on:click="notes = disableNotification('notes')"
                                       class="fas fa-times red-text"></i>
                                </div>
                            </div>
                        </div>
                    </transition>
                    <div class="row">
                        <div class="spinner-container"
                             style="position: absolute;width:100%;height: 253px;z-index: 1;">
                            <div class="spinner-border" role="status" v-if="loading"
                                 style="top: 40%;position: absolute;left: 48%; width: 4rem !important; height: 4rem !important;">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <div class="row w-100"
                         :style="[loading ? {'opacity':'50%'}:{'opacity':'100%'}]">
                        <div class="col-lg-4 col-12 my-4"
                             v-for="(key,value) in notesByCourse">
                            <p><span
                                v-for="(date,index) in key"><span
                                class="badges orange-badge">{{ date.lesson.course.name }} </span></span>
                            </p>
                            <div class="notes-box">
                                <h1>{{ moment(value).format("MM/DD") }}</h1>
                                <div class="row">
                                    <span class="pink-badge badges">{{ user_tag }}</span>
                                </div>
                                <h5>Lessons</h5>
                                <p><span
                                    v-for="(date,index) in key"><span
                                    v-if="index !== 0">, </span>{{ date.lesson?.name }} </span>
                                </p>
                            </div>
                            <p class="my-4" v-if="this.notesByCourse == null">No notes
                                found.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="first_day">First Day:</label>
                                <select class="form-control" v-model="form.first_day" id="first_day">
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="second_day">Second Day:</label>
                                <select name="" id="second_day" class="form-control" v-model="form.second_day">
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="first_day_time">First Day Time:</label>
                                <input type="time" id="first_day_time" class="form-control"
                                       v-model="form.first_day_time">
                            </div>
                            <div class="form-group col-6">
                                <label for="second_day_time">Second Day Time:</label>
                                <input type="time" id="second_day_time" class="form-control"
                                       v-model="form.second_day_time">
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="updateSchedule()">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import AppLayout from '@/Layouts/AppLayout'
import moment from "moment";

export default {
    components: {
        AppLayout,
    },
    props: ['academic_data', 'personality_data', 'user_courses', 'profile', 'days_available', 'first_date', 'second_date', 'tutor_match_done', 'learning_style_done', 'user_tag'],
    data() {
        return {
            academic: localStorage.getItem('academic') === 'true',
            personality: localStorage.getItem('personality') === 'true',
            courses: localStorage.getItem('courses') === 'true',
            calendar: localStorage.getItem('calendar') === 'true',
            notes: localStorage.getItem('notes') === 'true',
            first_day_time: moment(this.profile.first_day_time, ["h:mm A"]).format("h:mm A"),
            second_day_time: moment(this.profile.second_day_time, ["h:mm A"]).format("h:mm A"),
            notesByDate: null,
            notesByCourse: null,
            moment: moment,
            selected_course: 'All',
            loading: false,
            first_day: this.days_available[0],
            second_day: this.days_available[1],
            profile: this.profile,
            form: {
                first_day: this.days_available[0],
                second_day: this.days_available[1],
                first_day_time: this.profile.first_day_time,
                second_day_time: this.profile.second_day_time
            },
            learning_style_done: this.learning_style_done
        }
    },
    methods: {
        disableNotification(attribute) {
            localStorage.setItem(attribute, false);
        },

        getNotesByCourse: function (course) {
            this.loading = true
            axios.get(route('dashboard.notes.course', course)).then(response => {
                this.notesByCourse = response.data.notes
                this.loading = false
            })
        },
        updateSchedule: function () {
            axios.put(route('change.schedule', this.form))
                .then(response => {
                    this.toast.success(response.data.message);
                    $('#exampleModalCenter').modal('hide');
                    this.days_available[0] = this.form.first_day
                    this.days_available[1] = this.form.second_day
                    this.first_day_time = this.form.first_day_time
                    this.second_day_time = this.form.second_day_time
                })

                .catch(error => {
                    Object.values(error.response.data.errors).flat().forEach(element => this.toast.error(element))
                });
        }
    },
    beforeMount() {
        this.getNotesByCourse(this.selected_course)
        console.log('Learning style')
        console.log(this.learning_style_done)
    }
}
</script>
