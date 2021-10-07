<template>
    <admin-layout>
        <div class="container user-show" data-aos="fade-up">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-12">
                    <form action="">
                        <div class="form-item">
                            <div class="row">
                                <div class="col-6 align-self-center">
                                    <label for="id">Reference Number</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="id" name="id" v-model="user.id" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="form-item">
                            <div class="row">
                                <div class="col-6 align-self-center">
                                    <label for="name">Name</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="name" name="name" v-model="user.name" disabled>

                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="row">
                                <div class="col-6 align-self-center">
                                    <label for="email">Email</label>
                                </div>
                                <div class="col-6">
                                    <input type="email" id="email" name="email" v-model="user.email" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="row">
                                <div class="col-6 align-self-center">
                                    <label for="number">Number</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="number" name="number" v-model="user.profile.reminder_phone"
                                           disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="row">
                                <div class="col-6 align-self-center">
                                    <label for="created">Created</label>
                                </div>
                                <div class="col-6">
                                    <input :formatter="format()" type="text" id="created" name="created" disabled
                                           v-model="user.created_at">
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="row">
                                <div class="col-6 align-self-center">
                                    <label for="learning_style">Learning Style</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="learning_style" name="learning_style" disabled
                                           v-model="user.profile.learning_style">
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="row">
                                <div class="col-6 align-self-center">
                                    <label for="tutor">Tutor Match Personality</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="tutor" name="tutor" disabled
                                           v-model="user.profile.tutor_match">
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="row">
                                <div class="col-6 align-self-center">
                                    <label for="exam_date">Exam Date</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="exam_date" name="exam_date" disabled
                                           v-model="user.profile.exam_date">
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="row">
                                <div class="col-6 align-self-center">
                                    <label for="current_score">Current Score</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="current_score" name="current_score" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="row">
                                <div class="col-6 align-self-center">
                                    <label for="enrolled_courses">Enrolled Courses</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="enrolled_courses" name="enrolled_courses" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="row">
                                <div class="col-6 align-self-center">
                                    <label for="lesson_dates">Lesson Dates</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="lesson_dates" name="lesson_dates" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="row">
                                <div class="col-6 align-self-center">
                                    <label for="lesson_frequency">Lesson Frequency</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="lesson_frequency" name="lesson_frequency" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="row">
                                <div class="col-6 align-self-center">
                                    <label for="lesson_length">Lesson Length</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="lesson_length" name="lesson_length" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="row">
                                <div class="col-6 align-self-center">
                                    <label for="goal_score">Goal Score</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="goal_score" name="goal_score" disabled
                                           v-model="user.profile.desire_score">
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="row">
                                <div class="col-6 align-self-center">
                                    <label for="practice_exam_dates">Practice Exam Dates</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="practice_exam_dates" name="practice_exam_dates" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="row">
                                <div class="col-6 align-self-center">
                                    <label for="course_level">Course Level</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="course_level" name="course_level" disabled
                                           v-model="user_tag">
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="row">
                                <div class="col-6">

                                </div>
                                <div class="col-6">
                                    <a @click="back()">Back</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </admin-layout>
</template>


<script>
import AdminLayout from '@/Layouts/AdminLayout'
import moment from 'moment'

export default {
    components: {
        AdminLayout,
    },
    data() {
        return {
            moment: moment
        }
    },
    props: ['user', 'user_tag'],
    methods: {
        back() {
            history.back();
        },
        format(value, event) {
            return moment(value).format("DD-MM-YYYY")
        }
    }
}
</script>
