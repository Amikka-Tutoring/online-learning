<template>
    <admin-layout>
        <div class="container user-show" data-aos="fade-up">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-12">
                    <form action="">
                        <div class="form-item">
                            <div class="row">
                                <div class="col-6">
                                    <label for="id">Reference Number</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="id" name="id" v-model="user.id">
                                </div>
                            </div>
                        </div>

                        <div class="form-item">
                            <div class="row">
                                <div class="col-6">
                                    <label for="name">Name</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="name" name="name" v-model="user.name">

                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="row">
                                <div class="col-6">
                                    <label for="email">Email</label>
                                </div>
                                <div class="col-6">
                                    <input type="email" id="email" name="email" v-model="user.email">
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="row">
                                <div class="col-6">
                                    <label for="number">Number</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="number" name="number" v-model="user.number">
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="row">
                                <div class="col-6">
                                    <label for="created">Created</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="created" name="created" v-model="user.created">
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="row">
                                <div class="col-6">
                                    <label for="learning_style">Learning Style</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="learning_style" name="learning_style">
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="row">
                                <div class="col-6">
                                    <label for="tutor">Tutor Match Personality</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="tutor" name="tutor">
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="row">
                                <div class="col-6">
                                    <label for="exam_date">Exam Date</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="exam_date" name="exam_date">
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="row">
                                <div class="col-6">
                                    <label for="current_score">Current Score</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="current_score" name="current_score">
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="row">
                                <div class="col-6">
                                    <label for="enrolled_courses">Enrolled Courses</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="enrolled_courses" name="enrolled_courses">
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="row">
                                <div class="col-6">
                                    <label for="lesson_dates">Lesson Dates</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="lesson_dates" name="lesson_dates">
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="row">
                                <div class="col-6">
                                    <label for="lesson_frequency">Lesson Frequency</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="lesson_frequency" name="lesson_frequency">
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="row">
                                <div class="col-6">
                                    <label for="lesson_length">Lesson Length</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="lesson_length" name="lesson_length">
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="row">
                                <div class="col-6">
                                    <label for="goal_score">Goal Score</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="goal_score" name="goal_score">
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="row">
                                <div class="col-6">
                                    <label for="practice_exam_dates">Practice Exam Dates</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="practice_exam_dates" name="practice_exam_dates">
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <div class="row">
                                <div class="col-6">
                                    <label for="course_level">Course Level</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="course_level" name="course_level">
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

export default {
    components: {
        AdminLayout,
    },
    props: ['user'],
    methods: {
        back() {
            history.back();
        }
    },

    data() {
        return {}
    },
}
</script>
