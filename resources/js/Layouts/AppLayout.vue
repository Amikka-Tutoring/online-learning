<template>
    <nav class="navbar navbar-light sticky-top" style="height: 86px; background: white">
        <button @click="toggleClass()" style="z-index: 2" class="border-0 navbar-toggler" type="button"
                data-toggle="collapse" data-target="#navbarToggleExternalContent"
                aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
            <svg v-bind:class="[isHidden ? 'rotate-effect':'']"
                 xmlns="http://www.w3.org/2000/svg" width="30"
                 height="30"
                 fill="#4C6ED7"
                 class="bi bi-list rotate" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                      d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
            </svg>
        </button>
        <a :href="route('dashboard')" style="height: 80%">
            <img src="/images/logo.png" alt="" style="height: 100%">
        </a>
        <div class="d-flex">
            <div class="dropdown">
                <div class="btn-group dropleft" v-if="user.profile">
                    <button type="button" class="btn btn-primary mr-2" data-toggle="dropdown" aria-haspopup="true"
                            style="background: white; color:#4c6ed7; border:none; box-shadow: none"
                            aria-expanded="false">
                        <i class="bi bi-bell-fill"></i>
                        <span class="notifications-number">{{ notifications.length }}</span>
                    </button>
                    <div class="dropdown-menu notifications-section" style="min-width: 280px">
                        <div v-if="notifications.length" class="row mx-0" v-for="notification in notifications"
                             v-on:click="readNotification(notification)">
                            <div class="col-10">
                                <a :href="notification.data.details.link"
                                   class="dropdown-item"
                                   href="#">{{ notification.data.details.title }}</a>
                            </div>
                            <div class="col-2">
                                <button style="background: none; border: 0">X
                                </button>
                            </div>
                        </div>
                        <p v-else class="px-3 m-0">No new notifications</p>
                    </div>
                </div>
            </div>
            <div class="dropdown d-flex">

                <button class="dropleft" style="background: none; border: none" type="button" id="dropdownMenuButton1"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img style="object-fit: cover; width: 40px; height: 40px"
                         class="d-flex align-items-center rounded-circle" alt="" :src="avatar">
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton1">
                    <a class="dropdown-item" v-on:click.prevent="logout()" href="">Logout</a>
                </div>
            </div>

        </div>
    </nav>

    <div class="row m-0">
        <div v-bind:class="[isHidden ? 'side-bar-0' : 'side-bar']">
            <div class="mb-5">
                <ul>
                    <h4>My Account</h4>
                    <li><a v-bind:class="route().current('dashboard') || route().current('main') ? 'active' : ''"
                           :href="route('dashboard')">Home</a>
                    </li>
                    <li><a v-bind:class="route().current('profile') ? 'active' : ''"
                           :href="route('profile')">Profile</a>
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
                    <li class="mb-5"><a v-bind:class="route().current('exams') ? 'active' : ''"
                                        :href="route('exams')">Exams</a>
                    </li>
                </ul>
            </div>
        </div>

        <div v-bind:class="[isHidden ? 'main-content' : 'main-content-1']" class="bg-white p-0 transition">
            <img class="banner-img" :src="'/images/banner.png'" alt=""
                 style="width: 100%; height:100px; margin-bottom: 100px">
            <div class="container-fluid p-0">
                <main class="mb-4">
                    <slot></slot>
                </main>
            </div>
        </div>
    </div>
    <!--    <h1>{{avatar}}</h1>-->
</template>

<script>


import {computed} from 'vue'
import {usePage} from '@inertiajs/inertia-vue3'

export default {
    components: {},
    setup() {
        const user = computed(() => usePage().props.value.auth.user);
        return {user}
    },
    props: ['user'],
    data() {
        return {
            showingNavigationDropdown: false,
            isHidden: true,
            next: false,
            avatar: this.user.profile_photo_path,
            user: this.user,
            notifications: [],
        };
    },
    methods: {
        logout() {
            axios.post(route('logout'))
                .then(response => {
                })
                .catch(error => {
                    Object.values(error.response.data.errors).flat().forEach(element => this.toast.error(element))
                }).finally(() => {
                window.location = '/login'
            });
        },
        toggleClass: function (event) {
            this.isHidden = !this.isHidden;
        },
        getNotifications: function () {
            axios.get(route('get.notifications')).then(response => {
                this.notifications = response.data
            }).catch(error => {
                console.log(error.response)
            })
        },
        readNotification: function (notification) {
            axios.post(route('read.notification'), notification).then(response => {
                this.notifications = response.data
            }).catch(error => {
                console.log(error.response)
            })
        }
    },
    mounted() {
        this.getNotifications()
    }
};
</script>
