<template>
    <nav class="navbar navbar-light sticky-top" style="height: 86px; background: white">
        <button @click="toggleClass()" style="z-index: 2" class="border-0 navbar-toggler" type="button"
                data-toggle="collapse" data-target="#navbarToggleExternalContent"
                aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
            <svg @mouseenter="isHidden = false" xmlns="http://www.w3.org/2000/svg" width="47" height="47" fill="#4C6ED7"
                 class="bi bi-list" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                      d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
            </svg>
        </button>

        <div class="dropdown">
            <button class="dropleft" style="background: none; border: none" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img style="object-fit: cover; margin-right: 20px; margin-top: 20px; width: 47px; height: 47px"
                     class="d-flex align-items-center rounded-circle" alt="" :src="avatar">
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" @click="logout()" href="">Logout</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </div>

    </nav>

    <div class="row m-0">
        <!--    <div class="side-bar" style="position:absolute; top: 0; z-index: 1" v-if="!isHidden">-->
        <div v-bind:class="[isHidden ? 'side-bar-0' : 'side-bar']" style="z-index: 1;" @mouseleave="isHidden = true">
            <ul>
                <h4>My Account</h4>
                <li><a v-bind:class="route().current('dashboard') ? 'active' : ''" :href="route('dashboard')">Home</a>
                </li>
                <li><a v-bind:class="route().current('profile') ? 'active' : ''" :href="route('profile')">Profile</a>
                </li>
            </ul>
            <ul>
                <h4>Course Content</h4>
                <li><a v-bind:class="route().current('my-courses') || route().current('course') ? 'active' : ''"
                       :href="route('my-courses')">My
                    Courses</a></li>
                <li><a v-bind:class="route().current('recommended') ? 'active' : ''" :href="route('recommended')">Recommended</a>
                </li>
                <li><a v-bind:class="route().current('review') || route().current('review') ? 'active' : ''"
                       :href="route('review')">Review</a></li>
            </ul>
            <ul>
                <h4>Tools</h4>
                <li><a v-bind:class="route().current('notes-list') ? 'active' : ''"
                       :href="route('notes-list')">Notes</a></li>
                <li><a v-bind:class="route().current('one-to-one') ? 'active' : ''" :href="route('one-to-one')">1-on-1
                    Tutoring</a></li>
                <li><a v-bind:class="route().current('set-calendar') ? 'active' : ''" :href="route('set-calendar')">Calendar</a>
                </li>
                <li><a v-bind:class="route().current('exams') ? 'active' : ''"
                       :href="route('exams')">Exams</a>
                </li>
            </ul>
        </div>

        <div v-bind:class="[isHidden ? 'main-content' : 'main-content-1']" class="bg-white p-0 transition">
            <img class="banner-img" :src="'/images/banner.png'" alt=""
                 style="width: 100%; height:140px; margin-bottom: 100px">
            <div class="container-fluid p-0">
                <main>
                    <slot></slot>
                </main>
            </div>
        </div>
    </div>
    <!--    <h1>{{avatar}}</h1>-->
</template>

<script>


// import { Link, Head } from "@inertiajs/inertia-vue3";
import {computed} from 'vue'
import {usePage} from '@inertiajs/inertia-vue3'

export default {
    components: {},
    setup() {
        const user = computed(() => usePage().props.value.auth.user)
        console.log(user)
        return {user}
    },
    props: ['user'],
    data() {
        return {
            showingNavigationDropdown: false,
            isHidden: true,
            next: false,
            avatar: this.user.profile_photo_path,
        };
    },


    methods: {
        logout() {
            this.$inertia.post(route("logout"));
        },
        toggleClass: function (event) {
            this.isHidden = !this.isHidden;

        }
    },
};
</script>
