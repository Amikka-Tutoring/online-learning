<template>
    <app-layout>
        <div class="container">
            <div class="profile-wrapper" data-aos="fade-up">
                <div class="row">
                    <img class="rounded-circle" style="width: 120px" :src="avatar">
                </div>
                <h1>{{ user.name }}</h1>
                <p>@{{ user.email }}</p>
                <button class="premium-btn">
                    Become Premium
                </button>
                <div class="btn-group">
                    <button @click="tab = 'specific'"
                            v-bind:class="[tab==='specific' ? 'active-button' : 'passive-button']">Course Specific
                    </button>
                    <button @click="tab = 'general'"
                            v-bind:class="[tab==='general' ? 'active-button' : 'passive-button']">General
                    </button>
                </div>
                <transition name="component-fade" mode="out-in">
                    <div v-if="tab === 'specific'" class="profile-course-listing">
                        <ul>
                            <li>
                                <div class="row">
                                    <div class="col-lg-1 col-3 align-items-center">
                                        <div class="courses-list-box"></div>
                                    </div>
                                    <div class="col-lg-9 col-7 align-items-center">
                                        <h5>Enrolled Courses</h5>
                                        <h6>SAT</h6>
                                    </div>
                                    <div class="col-lg-2 col-2 align-items-center">
                                        <p class="text-right"><i style="color: #4C6ED7;" class="fas fa-angle-right"></i>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-lg-1 col-3 align-items-center">
                                        <div class="courses-list-box"></div>
                                    </div>
                                    <div class="col-lg-9 col-7 align-items-center">
                                        <h5>Exam Date</h5>
                                        <h6>7/11</h6>
                                    </div>
                                    <div class="col-lg-2 col-2 align-items-center">
                                        <p class="text-right">Edit</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-lg-1 col-3 align-items-center">
                                        <div class="courses-list-box"></div>
                                    </div>
                                    <div class="col-lg-9 col-7 align-items-center">
                                        <h5>Lesson Dates</h5>
                                        <h6>Tuesday and Thursday</h6>
                                    </div>
                                    <div class="col-lg-2 col-2 align-items-center">
                                        <p class="text-right">Edit</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div v-else class="profile-course-listing">
                        <ul>
                            <li>
                                <div class="row">
                                    <div class="col-lg-1 col-3 align-items-center">
                                        <div class="courses-list-box"></div>
                                    </div>
                                    <div class="col-lg-9 col-7 align-items-center">
                                        <h5>Learning Style</h5>
                                        <h6>Auditory</h6>
                                    </div>
                                    <div class="col-lg-2 col-2 align-items-center">
                                        <p class="text-right"><i style="color: #4C6ED7;" class="fas fa-angle-right"></i>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-lg-1 col-3 align-items-center">
                                        <div class="courses-list-box"></div>
                                    </div>
                                    <div class="col-lg-9 col-7 align-items-center">
                                        <h5>Course Level</h5>
                                        <h6>Easy</h6>
                                    </div>
                                    <div class="col-lg-2 col-2 align-items-center">
                                        <p class="text-right"><i class="blue-text fas fa-lock"></i></p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-lg-1 col-3 align-items-center">
                                        <div class="courses-list-box"></div>
                                    </div>
                                    <div class="col-lg-9 col-7 align-items-center">
                                        <h5>Tutor Match Personality</h5>
                                        <h6>ENTJ</h6>
                                    </div>
                                    <div class="col-lg-2 col-2 align-items-center">
                                        <p class="text-right"><i class="blue-text fas fa-lock"></i></p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </transition>
                <a href="" @click="logout()" class="blue-text">LOG OUT</a>
            </div>
        </div>
        <CheckList/>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import CheckList from "../components/CheckList";

export default {
    components: {
        AppLayout,
        CheckList
    },
    methods: {
        logout() {
            this.$inertia.post(route("logout"));
        },
    },
    props: ['user'],
    data() {
        return {
            avatar: this.user.profile_photo_path,
            tab: 'specific',
        }
    },
}
</script>
