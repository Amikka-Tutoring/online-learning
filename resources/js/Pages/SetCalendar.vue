<template>
    <app-layout>
        <div class="container">

            <div class="practice-exams">
                <h1 class="blue-text">Quick Calendar Changes</h1>
                <div class="practice-exams-content">
                    <p class="question-box mb-0">If your schedule changes last minute, edit specific lessons or exams by
                        clicking on the date. This will allow yoiu to change the time, duration, or type of lesson right
                        below it. </p>
                    <div class="row justify-content-center align-items-center">
                        <img :src="'/images/calendar.png'" style="width: 100%; max-width: 580px">
                    </div>
                </div>
            </div>

            <div class="practice-exams" data-aos="fade-up">
                <h1 class="blue-text">Recurring Calendar Changes</h1>
                <div class="practice-exams-content">
                    <p class="question-box">If your schedule changes completely, you can edit the recurring lesson dates
                        and times for all of your future sessions below. Beware that this will change your entire
                        schedule moving forward. </p>
                    <div class="row justify-content-center align-items-center">
                        <div class="days-box work-times">
                            <div class="row" v-for="l_dates in lesson_dates">
                                <div class="col-6">
                                    <label>{{ l_dates.day }}</label>
                                </div>
                                <div class="col-6">
                                    <input type="time" name="start_time" v-model="l_dates.time"
                                           @change="updateLessonDates(l_dates)">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <select name="" id="" class="form-control" v-model="new_day">
                                        <option value="Monday" v-if="!lesson_dates_busy.includes('Monday')">Monday
                                        </option>
                                        <option value="Tuesday" v-if="!lesson_dates_busy.includes('Tuesday')">Tuesday
                                        </option>
                                        <option value="Wednesday" v-if="!lesson_dates_busy.includes('Wednesday')">
                                            Wednesday
                                        </option>
                                        <option value="Thursday" v-if="!lesson_dates_busy.includes('Thursday')">Thursday
                                        </option>
                                        <option value="Friday" v-if="!lesson_dates_busy.includes('Friday')">Friday
                                        </option>
                                        <option value="Saturday" v-if="!lesson_dates_busy.includes('Saturday')">Saturday
                                        </option>
                                        <option value="Sunday" v-if="!lesson_dates_busy.includes('Sunday')">Sunday
                                        </option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <input type="time">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="practice-exams" data-aos="fade-up">
                <h1 class="blue-text">Practice Exams</h1>
                <div class="practice-exams-content">
                    <p class="question-box">Because your exam is <span class="blue-text">{{ date_diff }}</span> we
                        recommend that you add at least <span class="blue-text">two full timed practice exams</span>
                        before then. Press the <span class="blue-text">+</span> button to add study times that may work
                        for you. </p>
                    <div class="row d-flex justify-content-center">
                        <div class="exam-box" data-aos="fade-up">
                            <div class="exam-box-tile"><h1>Practice Exams</h1></div>
                            <div class="exam-box-list">
                                <div class="row p-2 mb-3 mt-3" v-for="exam in practice_exams"
                                     v-if="practice_exams.length">
                                    <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                        <i class="fas fa-play-circle fa-2x" style="color: #4C6ED7"></i>
                                    </div>
                                    <div class="col-8 d-flex align-items-center exam-name">
                                        {{ exam.title }}
                                    </div>
                                    <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                        <a class="fas fa-plus fa-2x" style="color: #4C6ED7"

                                           target="_blank" @click="openModal(exam)"></a>
                                    </div>
                                </div>
                                <div class="row p-2 mb-3 mt-3" v-else>
                                    <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                        <i class="fas fa-play-circle fa-2x" style="color: #4C6ED7"></i>
                                    </div>
                                    <div class="col-8 d-flex align-items-center exam-name">
                                        N/A
                                    </div>
                                </div>
                                <div class="row p-2 mb-3">
                                    <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                        <i class="fas fa-play-circle fa-2x" style="color: #4C6ED7"></i>
                                    </div>
                                    <div class="col-8 d-flex align-items-center exam-name">
                                        Real Exam Day
                                    </div>
                                    <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                        <h5 class="blue-text">{{ moment(user.profile.exam_date).format("MM/DD") }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="video-exams" data-aos="fade-up">
                <h1 class="blue-text">Videos and Quizzes</h1>
                <div class="video-exams-content">
                    <p class="question-box">On top of building your <span class="blue-text">endurance</span> for the
                        full test it’s important to <span class="blue-text">master</span> all of the content. We
                        initially recommended that you schedule two <span
                            class="blue-text">1.5 hour lessons per week.</span><br><br>However because your exam is in
                        <span class="blue-text">{{ date_diff }}</span> and you want to <span class="blue-text">improve 100 points</span>
                        we recommend that you do <span class="blue-text">our fast track course.</span><br><br><span
                            class="blue-text">Practice makes perfect.</span></p>
                    <div class="row d-flex justify-content-center">
                        <div class="exam-box" data-aos="fade-up">
                            <div class="exam-box-tile"><h1>Videos and Quizzes</h1></div>
                            <div class="exam-box-list">
                                <div class="row p-2 mb-3 mt-3">
                                    <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                        <i class="fas fa-play-circle fa-2x" style="color: #4C6ED7"></i>
                                    </div>
                                    <div class="col-8 d-flex align-items-center exam-name">
                                        Which Recommendation Do You Want?
                                    </div>
                                    <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                        <i class="fas fa-plus fa-2x" style="color: #4C6ED7"></i>
                                    </div>
                                </div>
                                <div class="row p-2 mb-3">
                                    <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                        <i class="fas fa-play-circle fa-2x" style="color: #4C6ED7"></i>
                                    </div>
                                    <div class="col-8 d-flex align-items-center exam-name">
                                        What Other Days Can You Practice?
                                    </div>
                                    <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                        <i class="fas fa-plus fa-2x" style="color: #4C6ED7"></i>
                                    </div>
                                </div>
                                <div class="row p-2 mb-3">
                                    <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                        <i class="fas fa-play-circle fa-2x" style="color: #4C6ED7"></i>
                                    </div>
                                    <div class="col-8 d-flex align-items-center exam-name">
                                        What Times Work For You?
                                    </div>
                                    <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                        <i class="fas fa-plus fa-2x" style="color: #4C6ED7"></i>
                                    </div>
                                </div>
                                <div class="row p-2 mb-3">
                                    <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                        <i class="fas fa-play-circle fa-2x" style="color: #4C6ED7"></i>
                                    </div>
                                    <div class="col-8 d-flex align-items-center exam-name">
                                        Real Exam Day
                                    </div>
                                    <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                        <h5 class="blue-text">{{
                                                moment(user.profile.exam_date).format("MM/DD")
                                            }}</h5>
                                    </div>
                                </div>
                            </div>
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="form-group">
                            <input type="datetime-local" class="form-control" id="datetimepicker"
                                   v-model="form.date_time">
                            <div id="datepicker"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="save">Save changes</button>
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
    methods: {
        updateLessonDates: function (lesson_date) {
            axios.put(route('update.lesson.dates'), lesson_date)
                .then(response => {
                    this.toast.success(response.data.message);
                })
                .catch(error => {
                    Object.values(error.response.data.errors).flat().forEach(element => this.toast.error(element))
                });
        },
        visitExam: function (exam) {
            axios.post(route('exams.visit', exam.id))
                .then(response => {
                    // this.toast.success(response.data.message);
                })
                .catch(error => {
                    Object.values(error.response.data.errors).flat().forEach(element => this.toast.error(element))
                });
        },
        openModal: function (exam) {
            $('#exampleModalCenter').modal('show');
            $('#exampleModalLongTitle').text(exam.title);
            this.form.exam_id = exam.id;
        },
        save: function () {
            axios.post(route('schedule.practice.exam', this.form.exam_id), this.form)
                .then(response => {
                    this.toast.success(response.data.message);
                })
                .catch(error => {
                    Object.values(error.response.data.errors).flat().forEach(element => this.toast.error(element))
                })
            $('#exampleModalCenter').modal('hide');
        }
    },
    props: ['date_diff', 'practice_exams', 'user', 'lesson_dates', 'lesson_dates_busy'],

    data() {
        return {
            moment: moment,
            practice_exams: this.practice_exams,
            form: {
                date_time: null,
                exam_id: null,
            },
            date: '2021-02-22 12:00'
        }
    },
}
</script>

