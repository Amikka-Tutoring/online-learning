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
        <div v-bind:class="[isHidden ? 'side-bar-0' : 'side-bar']" style="z-index: 1;" @mouseleave="isHidden = true"
             class="admin-sidebar">
            <ul>
                <h1>Ammika Admin</h1>
            </ul>
            <ul class="list">
                <li><a>Users</a></li>
                <li><a>Courses</a></li>
                <li><a>Practice Exams</a></li>
                <li><a>Academic Diagnostics</a></li>
                <li><a>Personality Diagnostics</a></li>
                <li><a>Personality Diagnostics</a></li>
                <li><a style="color: red; text-decoration: underline;">Logout</a></li>
            </ul>
        </div>

        <div v-bind:class="[isHidden ? 'main-content' : 'main-content-1']" class="bg-white p-0 transition">
            <img class="banner-img" :src="'/images/admin-banner.png'" alt=""
                 style="width: 100%; height:140px; margin-bottom: 100px; object-fit: cover">
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
