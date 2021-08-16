<template>
            <nav class="navbar navbar-light sticky-top" style="height: 86px; background: white">
                <button @click="toggleClass()" style="z-index: 2" class="border-0 navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                    <svg xmlns="http://www.w3.org/2000/svg" width="47" height="47" fill="#4C6ED7" class="bi bi-list" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                </button>

                <div class="dropdown">
                    <button class="dropleft" style="background: none; border: none" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img style="object-fit: cover; margin-right: 20px; margin-top: 20px; width: 47px; height: 47px" class="d-flex align-items-center rounded-circle" src="https://www.kindpng.com/picc/m/78-786207_user-avatar-png-user-avatar-icon-png-transparent.png" alt="">
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" @click="logout()" href="" >Logout</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </nav>
<div class="row m-0">
<!--    <div class="side-bar" style="position:absolute; top: 0; z-index: 1" v-if="!isHidden">-->
    <div v-bind:class="[isHidden ? 'side-bar-0' : 'side-bar']" style="z-index: 1;" >
        <ul>
            <h4>My Account</h4>
<!--            <li>My Account</li>-->
            <li><a href="">Home</a></li>
            <li><a href="">Profile</a></li>
        </ul>
        <ul>
            <h4>Course Content</h4>
            <li><a href="">My Courses</a></li>
            <li><a href="">Review</a></li>
        </ul>
        <ul>
            <h4>Tools</h4>
            <li><a href="">Notes</a></li>
            <li><a href="">1-on-1 Tutoring</a></li>
            <li><a href="">Calendar</a></li>
        </ul>
    </div>

    <div  v-bind:class="[isHidden ? 'main-content' : 'main-content-1']" class="bg-white p-0 transition">
        <img :src="'/images/banner.png'" alt="" style="width: 100%; height:140px">
        <div class="container">
                <main>
                    <div class="row p-5 d-block">
                        <slot></slot>
                    </div>
                </main>
        </div>
    </div>
</div>
</template>

<script>


// import { Link, Head } from "@inertiajs/inertia-vue3";

export default {
    props: {

    },
    components: {

    },
    data() {
        return {
            showingNavigationDropdown: false,
            isHidden: true
        };
    },


    methods: {
        logout() {
            this.$inertia.post(route("logout"));
        },
        toggleClass: function(event){
            this.isHidden = !this.isHidden;
        }
    },
};
</script>
