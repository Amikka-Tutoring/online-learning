<template>
    <div class="navigation-bar d-flex justify-content-between bg-white" style="width: 100%; height: 86px; left: 0px; top: 0px;">
        <div class="pos-f-t d-flex align-items-center" style="width: 100px">
            <nav class="navbar navbar-light" style="position: absolute">
                <button @click="toggleClass()" style="z-index: 2" class="border-0 navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                    <svg xmlns="http://www.w3.org/2000/svg" width="47" height="47" fill="#4C6ED7" class="bi bi-list" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                </button>
            </nav>
        </div>
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
<!--        <div class="" style="width: 100px">-->
<!--        </div>-->
    </div>
<div class="row">
<!--    <div class="side-bar" style="position:absolute; top: 0; z-index: 1" v-if="!isHidden">-->
    <div v-bind:class="[isHidden ? 'hidden' : 'side-bar col-lg-2 col-md-4 col-sm-12']" style="z-index: 1;">
        <ul>
            <h4>My Account</h4>
<!--            <li>My Account</li>-->
            <li>Home</li>
            <li>Profile</li>
        </ul>
        <ul>
            <h4>Course Content</h4>
            <li>My Courses</li>
            <li>Review</li>
        </ul>
        <ul>
            <h4>Tools</h4>
            <li>Notes</li>
            <li>1-on-1 Tutoring</li>
            <li>Calendar</li>
        </ul>
    </div>

    <div  v-bind:class="[isHidden ? 'col-12' : 'col-lg-10 col-md-8 pl-0']" class="bg-white">
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
