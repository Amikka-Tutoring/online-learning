<template>
    <app-layout>
        <div class="container">
            <div v-if="!profile.math_score || !profile.grammar_score || !profile.reading_score" class="academic">
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
                        <div class="col-lg-3 col-md-6 col-12" data-aos="fade-up"
                             data-aos-delay="50" data-aos-once="true">
                            <div class="input-cards">
                                <img class="w-100" :src="'images/course-img.png'">
                                <a v-if="!profile.math_score" :href="route('diagnostic.show','mathematics')"><h4>
                                    Mathematics</h4></a>
                                <h4 v-else>Mathematics</h4>
                                <div class="row justify-content-center align-items-center"
                                     style="margin-top: 60px; margin-bottom: 10px">
                                    <div class="col-9">
                                        <div class="progress" style="height: 5px; margin-left: 20px">
                                            <div style="background: #4C6ED7;" class="progress-bar"
                                                 :style="{width:profile.math_score/800*100 +'%'}"
                                                 role="progressbar" aria-valuenow="50" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-3" style="padding-left: 0;">
                                        <div class="blue-text">{{
                                                parseFloat(profile.math_score / 800 * 100).toFixed(0)
                                            }} %
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12" data-aos="fade-up"
                             data-aos-delay="50" data-aos-once="true">
                            <div class="input-cards">
                                <img class="w-100" :src="'images/course-img.png'">
                                <a v-if="!profile.reading_score" :href="route('diagnostic.show','reading')"><h4>
                                    Reading</h4></a>
                                <h4 v-else>Reading</h4>
                                <div class="row justify-content-center align-items-center"
                                     style="margin-top: 60px; margin-bottom: 10px">
                                    <div class="col-9">
                                        <div class="progress" style="height: 5px; margin-left: 20px">
                                            <div style="background: #4C6ED7;" class="progress-bar"
                                                 :style="{width:profile.reading_score/800*100 +'%'}"
                                                 role="progressbar" aria-valuenow="50" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="blue-text">
                                            {{ parseFloat(profile.reading_score / 800 * 100).toFixed(0) }} %
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12" data-aos="fade-up"
                             data-aos-delay="50" data-aos-once="true">
                            <div class="input-cards">
                                <img class="w-100" :src="'images/course-img.png'">
                                <a v-if="!profile.grammar_score" :href="route('diagnostic.show','grammar')"><h4>
                                    Grammar</h4></a>
                                <h4 v-else>Grammar</h4>
                                <div class="row justify-content-center align-items-center"
                                     style="margin-top: 60px; margin-bottom: 10px">
                                    <div class="col-9">
                                        <div class="progress" style="height: 5px; margin-left: 20px">
                                            <div style="background: #4C6ED7;" class="progress-bar"
                                                 :style="{width:profile.grammar_score/800*100 +'%'}"
                                                 role="progressbar" aria-valuenow="50" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="blue-text">
                                            {{ parseFloat(profile.grammar_score / 800 * 100).toFixed(0) }} %
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12" data-aos="fade-up" data-aos-delay="200"
                             data-aos-once="true">
                            <div class="input-cards">
                                <img class="w-100" :src="'images/course-img.png'">
                                <h4>Initial Questionnaire</h4>
                                <div class="row justify-content-center align-items-center"
                                     style="margin-top: 60px; margin-bottom: 10px">
                                    <div class="col-9">
                                        <div class="progress" style="height: 5px; margin-left: 20px">
                                            <div style="background: #4C6ED7; width: 100%" class="progress-bar"
                                                 role="progressbar" aria-valuenow="50" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="blue-text">100 %</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--        Personality-->

            <div class="personality" v-if="!profile.learning_style || !profile.tutor_match">
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
                        <div class="col-lg-3 col-md-6 col-12" data-aos="fade-up"
                             data-aos-delay="50" data-aos-once="true">
                            <div class="input-cards">
                                <img class="w-100" :src="'images/course-img.png'">
                                <a v-if="!profile.learning_style" :href="route('diagnostic.show','learning-style')">
                                    <h4>Learning Style </h4>
                                </a>
                                <h4 v-else>Learning Style</h4>
                                <div class="row justify-content-center align-items-center"
                                     style="margin-top: 60px; margin-bottom: 10px">
                                    <div class="col-9">
                                        <div v-if="profile.learning_style"
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
                                             v-if="profile.learning_style"><i
                                            class="bi bi-check2-square blue-text fa-2x"></i>
                                        </div>
                                        <div class="blue-text" v-else><i class="bi bi-app blue-text fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12" data-aos="fade-up"
                             data-aos-delay="50" data-aos-once="true">
                            <div class="input-cards">
                                <img class="w-100" :src="'images/course-img.png'">
                                <a v-if="!profile.tutor_match" :href="route('diagnostic.show','perfect-tutor-match')">
                                    <h4>Perfect Tutor Match</h4>
                                </a>
                                <h4 v-else>Perfect Tutor Match</h4>
                                <div class="row justify-content-center align-items-center"
                                     style="margin-top: 60px; margin-bottom: 10px">
                                    <div class="col-9">
                                        <div v-if="profile.tutor_match"
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
                                             v-if="profile.tutor_match"><i
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
            <div class=" courses" data-aos="fade-up">
                <h1 class="blue-text">My Courses</h1>
                <div class="courses-content pl-5" style="margin-top: 90px">
                    <transition name="list">
                        <div v-if="courses" class="question-box text-left">
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
                        </div>
                    </transition>
                    <div class="row">
                        <div v-if="user_courses.enrollments.length" v-for="user_course in user_courses.enrollments"
                             class="col-lg-3 col-md-6 col-12" data-aos="fade-up"
                             data-aos-delay="50" data-aos-once="true">
                            <div class="input-cards">
                                <img class="w-100" :src="'images/course-img.png'">
                                <a :href="route('course',user_course.course.slug)"><h4>{{
                                        user_course.course.name
                                    }}</h4></a>
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
                                        <div class="blue-text">
                                            {{
                                                parseFloat(user_course.course.quizzes_attempted /
                                                    (user_course.course.quizzes_count === 0 ? 1 :
                                                        user_course.course.quizzes_count) *
                                                    100).toFixed(0)
                                            }} %
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
                        <div v-if="calendar" class="question-box text-left">
                            <div class="row">
                                <div class="col-lg-11 col-10">
                                    This calendar is based on your current progress versus expected progress, exam date,
                                    goals, and availability.
                                </div>
                                <div class="col-lg-1 col-2 d-flex align-items-center"
                                     data-aos="fade-up" data-aos-delay="50"
                                     data-aos-once="true">
                                    <i v-on:click="calendar = disableNotification('calendar')"
                                       class="fas fa-times red-text"></i>
                                </div>
                            </div>
                        </div>
                    </transition>
                    <div class="row justify-content-center my-4">
                        <div class="col-lg-8">
                            <div class="my-4">
                                <full-calendar :editable="true" :exams="calendar_exams" :lessons="calendar_lessons"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!--        Note-->
            <div class="notes">
                <h1 class="blue-text">Notes</h1>
                <transition name="list">
                    <div v-if="notes" class="question-box text-left mt-5">
                        <div class="row">
                            <div class="col-lg-11 col-10">
                                All of your notes for a specific day will be saved on the same page. You can review old
                                notes or add new ones by clicking a date.
                            </div>
                            <div class="col-lg-1 col-2 d-flex align-items-center">
                                <i v-on:click="notes = disableNotification('notes')"
                                   class="fas fa-times red-text"></i>
                            </div>
                        </div>
                    </div>
                </transition>
                <template v-if="has_notes">
                    <select name="course" id="" class="form-control w-lg-25 float-right my-4"
                            style="z-index: 999; position: relative"
                            v-on:change="getNotesByCourse(this.selected_course)"
                            v-model="selected_course">
                        <option value="All">All</option>
                        <option v-for="user_course in user_courses.enrollments">{{ user_course.course.name }}
                        </option>
                    </select>

                    <div class="notes-content pl-5" style="position: relative">

                        <div class="row">
                            <div class="spinner-container" v-if="loading"
                                 style="position: absolute;width:100%;height: 253px;z-index: 1;">
                                <div class="spinner-border" role="status"
                                     style="top: 40%;position: absolute;left: 48%; width: 4rem !important; height: 4rem !important;">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </div>
                        <div class="w-100"
                             :style="[loading ? {'opacity':'50%'}:{'opacity':'100%'}]">
                            <div class="notes-table">
                                <table>
                                    <thead>
                                    <tr>
                                        <th style="width: 25%"><i
                                            class="fas fa-calendar-day blue-text mr-2"></i>Dates
                                        </th>
                                        <th style=" width: 15%"><i class="fas fa-book-open blue-text mr-2"></i>Class
                                        </th>
                                        <th style="width: 30%"><i class="fas fa-pen blue-text mr-2"></i>Topics
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(note,itemObjKey) in notesByCourse">
                                        <td>{{ itemObjKey }}</td>
                                        <td><span v-for="(n,index) in note"><span
                                            v-if="index !== 0">, </span>{{ n.video.layer.course.name }}</span>
                                        </td>
                                        <td><span v-for="(n,index) in note"><span v-if="index !== 0">, </span>
                                        <a :href="route('notes-show',n)">{{
                                                n.video.layer.name
                                            }}</a></span>
                                        </td>
                                    </tr>
                                    <p v-if="!Object.keys(this.notesByCourse).length">No rows found</p>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </template>

            </div>

            <div v-if="profile.math_score && profile.grammar_score && profile.reading_score" class="academic my-5">
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
                        <div class="col-lg-3 col-md-6 col-12" data-aos="fade-up"
                             data-aos-delay="50" data-aos-once="true">
                            <div class="input-cards">
                                <img class="w-100" :src="'images/course-img.png'">
                                <a v-if="!profile.math_score" :href="route('diagnostic.show','mathematics')"><h4>
                                    Mathematics</h4></a>
                                <h4 v-else>Mathematics</h4>
                                <div class="row justify-content-center align-items-center"
                                     style="margin-top: 60px; margin-bottom: 10px">
                                    <div class="col-9">
                                        <div class="progress" style="height: 5px; margin-left: 20px">
                                            <div style="background: #4C6ED7;" class="progress-bar"
                                                 :style="{width:profile.math_score/800*100 +'%'}"
                                                 role="progressbar" aria-valuenow="50" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-3" style="padding-left:0">
                                        <div class="blue-text">{{
                                                parseFloat(profile.math_score / 800 * 100).toFixed(0)
                                            }} %
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12" data-aos="fade-up"
                             data-aos-delay="50" data-aos-once="true">
                            <div class="input-cards">
                                <img class="w-100" :src="'images/course-img.png'">
                                <a v-if="!profile.reading_score" :href="route('diagnostic.show','reading')"><h4>
                                    Reading</h4></a>
                                <h4 v-else>Reading</h4>
                                <div class="row justify-content-center align-items-center"
                                     style="margin-top: 60px; margin-bottom: 10px">
                                    <div class="col-9">
                                        <div class="progress" style="height: 5px; margin-left: 20px">
                                            <div style="background: #4C6ED7;" class="progress-bar"
                                                 :style="{width:profile.reading_score/800*100 +'%'}"
                                                 role="progressbar" aria-valuenow="50" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-3" style="padding-left:0">
                                        <div class="blue-text">
                                            {{ parseFloat(profile.reading_score / 800 * 100).toFixed(0) }} %
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12" data-aos="fade-up"
                             data-aos-delay="50" data-aos-once="true">
                            <div class="input-cards">
                                <img class="w-100" :src="'images/course-img.png'">
                                <a v-if="!profile.grammar_score" :href="route('diagnostic.show','grammar')"><h4>
                                    Grammar</h4></a>
                                <h4 v-else>Grammar</h4>
                                <div class="row justify-content-center align-items-center"
                                     style="margin-top: 60px; margin-bottom: 10px">
                                    <div class="col-9">
                                        <div class="progress" style="height: 5px; margin-left: 20px">
                                            <div style="background: #4C6ED7;" class="progress-bar"
                                                 :style="{width:profile.grammar_score/800*100 +'%'}"
                                                 role="progressbar" aria-valuenow="50" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-3" style="padding-left:0">
                                        <div class="blue-text">
                                            {{ parseFloat(profile.grammar_score / 800 * 100).toFixed(0) }} %
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12" data-aos="fade-up" data-aos-delay="200"
                             data-aos-once="true">
                            <div class="input-cards">
                                <img class="w-100" :src="'images/course-img.png'">
                                <h4>Initial Questionnaire</h4>
                                <div class="row justify-content-center align-items-center"
                                     style="margin-top: 60px; margin-bottom: 10px">
                                    <div class="col-9">
                                        <div class="progress" style="height: 5px; margin-left: 20px">
                                            <div style="background: #4C6ED7; width: 100%" class="progress-bar"
                                                 role="progressbar" aria-valuenow="50" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="col-3" style="padding-left:0">
                                        <div class="blue-text">100 %</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="personality my-5" v-if="profile.learning_style && profile.tutor_match">
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
                        <div class="col-lg-3 col-md-6 col-12" data-aos="fade-up"
                             data-aos-delay="50" data-aos-once="true">
                            <div class="input-cards">
                                <img class="w-100" :src="'images/course-img.png'">
                                <a v-if="!profile.learning_style" :href="route('diagnostic.show','learning-style')">
                                    <h4>Learning Style </h4>
                                </a>
                                <h4 v-else>Learning Style</h4>
                                <div class="row justify-content-center align-items-center"
                                     style="margin-top: 60px; margin-bottom: 10px">
                                    <div class="col-9">
                                        <div v-if="profile.learning_style"
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
                                             v-if="profile.learning_style"><i
                                            class="bi bi-check2-square blue-text fa-2x"></i>
                                        </div>
                                        <div class="blue-text" v-else><i class="bi bi-app blue-text fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12" data-aos="fade-up"
                             data-aos-delay="50" data-aos-once="true">
                            <div class="input-cards">
                                <img class="w-100" :src="'images/course-img.png'">
                                <a v-if="!profile.tutor_match" :href="route('diagnostic.show','perfect-tutor-match')">
                                    <h4>Perfect Tutor Match</h4>
                                </a>
                                <h4 v-else>Perfect Tutor Match</h4>
                                <div class="row justify-content-center align-items-center"
                                     style="margin-top: 60px; margin-bottom: 10px">
                                    <div class="col-9">
                                        <div v-if="profile.tutor_match"
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
                                             v-if="profile.tutor_match"><i
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
        </div>
        <cup v-if="this.cup"/>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import moment from "moment";
import FullCalendar from "@/components/FullCalendar";
import Cup from "@/components/Cup";

export default {
    components: {
        AppLayout,
        FullCalendar,
        'cup': Cup
    },
    props: ['has_notes', 'calendar_lessons', 'calendar_exams', 'flash', 'academic_data', 'personality_data', 'user_courses', 'profile', 'next_lesson_time', 'next_lesson', 'next_lesson_day', 'next_practice_exam', 'tutor_match_done', 'learning_style_done', 'user_tag'],
    data() {
        return {
            academic: localStorage.getItem('academic') === 'true',
            personality: localStorage.getItem('personality') === 'true',
            courses: localStorage.getItem('courses') === 'true',
            calendar: localStorage.getItem('calendar') === 'true',
            notes: localStorage.getItem('notes') === 'true',
            next_lesson_time: moment(this.next_lesson_time, ["h:mm A"]).format("h:mm A"),
            next_practice_exam_time: moment(this.next_practice_exam, ["h:mm A"]).format("h:mm A"),
            next_practice_exam_day: moment(this.next_practice_exam, ["YYYY-MM-DD HH:mm:ss"]).format("dddd"),
            next_practice_exam_date: moment(this.next_practice_exam, ["YYYY-MM-DD HH:mm:ss"]).format("D/M"),
            notesByDate: null,
            notesByCourse: {},
            moment: moment,
            selected_course: 'All',
            loading: false,
            profile: this.profile,
            form: {
                first_day_time: this.profile.first_day_time,
                second_day_time: this.profile.second_day_time
            },
            learning_style_done: this.learning_style_done,
            cup: false,
        }
    },
    setup() {
        let saved = localStorage.getItem('dashboard') === null;
        if (saved) {
            localStorage.setItem('academic', true)
            localStorage.setItem('personality', true)
            localStorage.setItem('courses', true)
            localStorage.setItem('calendar', true)
            localStorage.setItem('notes', true)
            localStorage.setItem('dashboard', true)
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
            }).catch(error => {
                console.log(error.response)
            })
        },
    },
    mounted() {
        if (this.flash.message != null)
            this.toast(this.flash.message)
        if (this.flash.cup != null) {
            this.cup = true
        }
        if (localStorage.getItem('plan'))
            localStorage.removeItem('plan')
    },
    beforeMount() {
        console.log('notes')
        this.getNotesByCourse(this.selected_course)
    }
}
</script>
