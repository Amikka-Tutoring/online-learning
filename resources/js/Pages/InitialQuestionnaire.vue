<template>
    <app-layout>
        <div>
            <p v-if="form.errors.length">
                <b>Please correct the following error(s):</b>
                <ul>
                    <li v-for="error in form.errors">{{ error }}</li>
                </ul>
            </p>
            <form @submit="submit">
                <div v-if="currentstep === 1">
                    <label for="first_name">First name:</label>
                    <input name="firstname" required id="first_name" v-model="form.first_name" />
                    <label for="last_name">Last name:</label>
                    <input name="lastname" id="last_name" v-model="form.last_name" />
                </div>
                <div v-if="currentstep === 2">
                    <label for="email">Email:</label>
                    <input name="email" id="email" v-model="form.email" />
                </div>
                <div v-if="currentstep === 3">
                    <label for="test">Test:</label>
                    <input id="test" v-model="form.test" />
                </div>
                <button v-if="currentstep!=3" @click.prevent="next()">Next</button>
                <button v-if="currentstep==3" type="submit">Submit</button>
            </form>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import { ref } from 'vue'
import { reactive } from 'vue'

import { Inertia } from '@inertiajs/inertia'

export default {
    components: {
        AppLayout,
    },

    setup () {
        const form = reactive({
            errors:[],
            first_name: null,
            last_name: null,
            test: null,
            email: null,
        })

        const currentstep = ref(1)

        function next () {
            console.log(currentstep)
            if(currentstep === 1 && !form.first_name || !form.last_name){
               form.errors.push('Name and lastname are required')
                return console.log(form.errors)
            }
            if(currentstep === 2 && !form.email){
                form.errors.push('Email is required')
            }
            else {
                form.errors = []
                currentstep.value++
            }

        }
        function submit(){
            console.log(form)
        }
        function checkForm(e){
            // console.log('checkForm')
            e.preventDefault();
            this.errors = [];

            if (!this.firstname) {
                this.errors.push("Name required.");
            }
            if (!this.lastname) {
                this.errors.push('Email required.');
            }
            if (!this.errors.length) {
                return true;
            }

        }

        return {form, submit, currentstep, next, checkForm}
    }
}
</script>
