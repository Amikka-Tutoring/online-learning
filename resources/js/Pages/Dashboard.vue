<template>
    <app-layout>
        <div class="container">
            <div class="academic">
                <h1 class="blue-text">Academic Diagnostic</h1>
                <div class="academic-content pl-5" style="margin-top: 90px">
                    <transition name="list">
                        <p class="question-box text-left" v-if="academic">
                        <div class="row">
                            <div class="col-lg-11 col-10">
                                Answer these short quizzes in order to help us build you a personalized program based on
                                your current strengths and weaknesses.
                            </div>
                            <div class="col-lg-1 col-2 d-flex align-items-center">
                                <i v-on:click="academic = !academic" class="fas fa-times red-text"></i>
                            </div>
                        </div>
                        </p>
                    </transition>
                    <div class="row">
                        <div v-for="a_q in academic_data.quizzes" class="col-lg-3 col-12" data-aos="fade-up"
                             data-aos-delay="50" data-aos-once="true">
                            <div class="input-cards">
                                <img class="w-100" :src="'images/course-img.png'">
                                <a :href="route('diagnostic.show',a_q.slug)"><h4>{{ a_q.name }}</h4></a>
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
                        <p v-if="personality" class="question-box text-left">
                        <div class="row">
                            <div class="col-lg-11 col-10">
                                Answer these 10 questions in order to help us build you a personalized program.
                            </div>
                            <div class="col-lg-1 col-2 d-flex align-items-center">
                                <i v-on:click="personality = !personality" class="fas fa-times red-text"></i>
                            </div>
                        </div>
                        </p>
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

            <!--        Courses-->
            <div class="courses" data-aos="fade-up">
                <h1 class="blue-text">My Courses</h1>
                <div class="courses-content pl-5" style="margin-top: 90px">
                    <transition name="list">
                        <p v-if="courses" class="question-box text-left">
                        <div class="row">
                            <div class="col-lg-11 col-10">
                                These course recommendations are based on a variety of factors including your
                                diagnostic, goal score, time until exam, and progress.
                            </div>
                            <div class="col-lg-1 col-2 d-flex align-items-center">
                                <i v-on:click="courses = !courses" class="fas fa-times red-text"></i>
                            </div>
                        </div>
                        </p>
                    </transition>
                    <div class="row">
                        <div v-for="user_course in user_courses.enrollments" class="col-lg-3 col-12" data-aos="fade-up"
                             data-aos-delay="50" data-aos-once="true">
                            <div class="input-cards">
                                <img class="w-100" :src="'images/course-img.png'">
                                <h4>{{ user_course.course.name }}</h4>
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

            <!--        Calendar-->

            <div class="calendar" data-aos="fade-up">
                <h1 class="blue-text">Calendar</h1>
                <div class="calendar-content pl-5" style="margin-top: 90px">
                    <transition name="list">
                        <p v-if="calendar" class="question-box text-left">
                        <div class="row">
                            <div class="col-lg-11 col-10">
                                Answer these 10 questions in order to help us build you a personalized program.
                            </div>
                            <div class="col-lg-1 col-2 d-flex align-items-center" data-aos="fade-up" data-aos-delay="50"
                                 data-aos-once="true">
                                <i v-on:click="calendar = !calendar" class="fas fa-times red-text"></i>
                            </div>
                        </div>
                        </p>
                    </transition>
                    <div class="row justify-content-md-center">
                        <div class="col-lg-3 col-12">
                            <div class="calendar-box">
                                <div class="row">
                                    <span class="blue-text font-weight-bold">Next Lesson:</span>
                                    <p>Tuesday, 8/3 at 3:00 pm</p>
                                </div>
                                <div class="row">
                                    <span class="blue-text font-weight-bold">Next Practice Exam:</span>
                                    <p>Wednesday, 8/4 at 3:00 pm</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!--        Note-->
            <div class="notes" data-aos="fade-up">
                <h1 class="blue-text">Notes</h1>
                <div class="notes-content pl-5" style="margin-top: 90px">
                    <transition name="list">
                        <p v-if="notes" class="question-box text-left">
                        <div class="row">
                            <div class="col-lg-11 col-10">
                                This is where all of your voice and written notes will be saved for all of the courses
                                that you are taking.
                            </div>
                            <div class="col-lg-1 col-2 d-flex align-items-center">
                                <i v-on:click="notes = !notes" class="fas fa-times red-text"></i>
                            </div>
                        </div>
                        </p>
                    </transition>
                    <div class="row">
                        <div class="col-lg-4 col-12" data-aos="fade-up" data-aos-delay="50" data-aos-once="true">
                            <span class="orange-badge badges">Date</span>
                            <div class="notes-box">
                                <h1>7/11</h1>
                                <div class="row">
                                    <span class="pink-badge badges">SAT</span>
                                    <span class="lightrose-badge badges">Medium</span>
                                    <span class="gray-badge badges">Strategy</span>
                                    <span class="lightblue-badge badges">Lesson</span>
                                </div>
                                <h5>Lessons</h5>
                                <p>Linear equations, Slope Intercept</p>
                            </div>
                            <div class="notes-box">
                                <h1>7/12</h1>
                                <div class="row">
                                    <span class="pink-badge badges">SAT</span>
                                    <span class="lightrose-badge badges">Medium</span>
                                    <span class="gray-badge badges">Strategy</span>
                                    <span class="lightblue-badge badges">Lesson</span>
                                </div>
                                <h5>Lessons</h5>
                                <p>Linear equations, Slope Intercept</p>
                            </div>
                            <div class="notes-box">
                                <h1>7/13</h1>
                                <div class="row">
                                    <span class="pink-badge badges">SAT</span>
                                    <span class="lightrose-badge badges">Medium</span>
                                    <span class="gray-badge badges">Strategy</span>
                                    <span class="lightblue-badge badges">Lesson</span>
                                </div>
                                <h5>Lessons</h5>
                                <p>Linear equations, Slope Intercept</p>
                            </div>
                            <div class="notes-box">
                                <h1>7/14</h1>
                                <div class="row">
                                    <span class="pink-badge badges">SAT</span>
                                    <span class="lightrose-badge badges">Medium</span>
                                    <span class="gray-badge badges">Strategy</span>
                                    <span class="lightblue-badge badges">Lesson</span>
                                </div>
                                <h5>Lessons</h5>
                                <p>Linear equations, Slope Intercept</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12" data-aos="fade-up" data-aos-delay="100" data-aos-once="true">
                            <span class="pink-badge badges">SAT</span>
                            <div class="notes-box">
                                <h1>7/11</h1>
                                <div class="row">
                                    <span class="pink-badge badges">SAT</span>
                                    <span class="lightrose-badge badges">Medium</span>
                                    <span class="gray-badge badges">Strategy</span>
                                    <span class="lightblue-badge badges">Lesson</span>
                                </div>
                                <h5>Lessons</h5>
                                <p>Linear equations, Slope Intercept</p>
                            </div>
                            <div class="notes-box">
                                <h1>7/12</h1>
                                <div class="row">
                                    <span class="pink-badge badges">SAT</span>
                                    <span class="lightrose-badge badges">Medium</span>
                                    <span class="gray-badge badges">Strategy</span>
                                    <span class="lightblue-badge badges">Lesson</span>
                                </div>
                                <h5>Lessons</h5>
                                <p>Linear equations, Slope Intercept</p>
                            </div>
                            <div class="notes-box">
                                <h1>7/13</h1>
                                <div class="row">
                                    <span class="pink-badge badges">SAT</span>
                                    <span class="lightrose-badge badges">Medium</span>
                                    <span class="gray-badge badges">Strategy</span>
                                    <span class="lightblue-badge badges">Lesson</span>
                                </div>
                                <h5>Lessons</h5>
                                <p>Linear equations, Slope Intercept</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12" data-aos="fade-up" data-aos-delay="150" data-aos-once="true">
                            <span class="rose-badge badges">Algebra 1</span>
                            <div class="notes-box">
                                <h1>7/12</h1>
                                <div class="row">
                                    <span class="pink-badge badges">SAT</span>
                                    <span class="lightrose-badge badges">Medium</span>
                                    <span class="gray-badge badges">Strategy</span>
                                    <span class="lightblue-badge badges">Lesson</span>
                                </div>
                                <h5>Lessons</h5>
                                <p>Linear equations, Slope Intercept</p>
                            </div>
                            <div class="notes-box">
                                <h1>7/13</h1>
                                <div class="row">
                                    <span class="pink-badge badges">SAT</span>
                                    <span class="lightrose-badge badges">Medium</span>
                                    <span class="gray-badge badges">Strategy</span>
                                    <span class="lightblue-badge badges">Lesson</span>
                                </div>
                                <h5>Lessons</h5>
                                <p>Linear equations, Slope Intercept</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
    components: {
        AppLayout,
    },
    props: ['academic_data', 'personality_data', 'user_courses'],
    data() {
        return {
            academic: true,
            personality: true,
            courses: true,
            calendar: true,
            notes: true
        }
    },
}
</script>
