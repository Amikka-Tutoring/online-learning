<template>
    <app-layout>
        <div class="container">
            <div class="profile-wrapper" data-aos="fade-up">
                <div class="row">
                    <img class="rounded-circle" style="width: 120px" :src="avatar">
                </div>
                <h1>{{ user.name }}</h1>
                <p>{{ user.email }}</p>
                <!--                <button class="premium-btn">-->
                <!--                    Become Premium-->
                <!--                </button>-->
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
                                <div class="row">
                                    <div class="col-lg-1 col-3 align-items-center">
                                        <div class="courses-list-box"></div>
                                    </div>
                                    <div class="col-lg-9 col-7 align-items-center">
                                        <h5>Enrolled Courses</h5>
                                        <span class="h6 mr-2"
                                              v-for="c in user_data.enrollments">{{ c.course.name }}</span>
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
                                        <h6>{{ moment(user_data.profile.exam_date).format("MM/DD") }}</h6>
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
                                        <!--                                        <h6>Tuesday and Thursday</h6>-->
                                        <h6><span class="mr-2" v-for="days in user_days_available">{{ days }}</span>
                                        </h6>
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
                                        <p class="text-right"><i class="blue-text fas fa-angle-right"></i>
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
                                        <h6>{{ user_tag }}</h6>
                                    </div>
                                    <div class="col-lg-2 col-2 align-items-center">
                                        <!--                                        <p class="text-right"><i class="blue-text fas fa-angle-down"></i></p>-->
                                        <div class="text-right"><select class="blue-text tag-select" v-model="key"
                                                                        name="tag" id=""
                                                                        @change="onChange($event)">
                                            <option :value="user_tag" selected="">{{ user_tag }}</option>
                                            <option v-for="tag in tags" v-bind:value="tag.name">{{
                                                    tag.name
                                                }}
                                            </option>
                                        </select></div>
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
import moment from "moment";
import {useToast} from "vue-toastification";

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
            const toast = useToast();
            axios.post(route('change.tag'), event.target.value)
                .then(response => {
                    toast.success(response.data.message);
                    this.user_tag = response.data.tag;
                })
                .catch(error => {
                    Object.values(error.response.data.errors).flat().forEach(element => toast.error(element))
                });
        },
        changeTab(tab_name) {
            this.loading = true;
            setTimeout(() => {
                this.tab = tab_name;
                this.loading = false;
            }, 500);

        }
    },
    props: ['user', 'tags', 'user_tag', 'user_data', 'user_days_available'],
    data() {
        return {
            avatar: this.user.profile_photo_path,
            tab: 'specific',
            moment: moment,
            user_tag: this.user_tag,
            loading: false
        }
    },
}
</script>
