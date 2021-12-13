<template>
    <app-layout>
        <div class="container">
            <h1 class="blue-text">Notes</h1>
            <div class="notes-container" v-if="Object.keys(this.notes).length">
                <div class="notes-buttons">
                    <div class="row">
                        <div class="col-lg-6 col-12 text-right buttons">
                            <select name="" id="" class="text-right buttons" v-model="selected_course"
                                    style="background: rgba(196, 196, 196, 0.25);border-radius: 10px;color: #4c6ed7;border: none;padding: 10px 20px; margin-right: 25px;"
                                    v-on:change="filterNotes(this.input,this.selected_course)">
                                <option v-for="en in user.enrollments">{{ en.course.name }}</option>
                            </select>
                            <!--                        <button><i class="fas fa-plus blue-text mr-2"></i>New</button>-->
                        </div>
                        <div class="col-lg-6 col-12">
                            <i class="fab fa-searchengin fa-2x blue-text pr-2 search-icon position-absolute"
                               style="padding-left: 20px; padding-top: 10px"></i>
                            <input type="text" v-model="input"
                                   v-on:keyup="filterNotes(this.input,this.selected_course)">
                        </div>
                    </div>
                </div>
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
                        <tr v-for="(note,itemObjKey) in s_notes">
                            <td><span v-for="(n,index) in note"> <a v-if="index==0"
                                                                    :href="route('notes-show',n)">{{
                                    itemObjKey
                                }}</a></span>
                            </td>
                            <td><span v-for="(n,index) in note"><span
                                v-if="index !== 0">, </span>  <a
                                :href="route('notes-show',n)">{{ n.video.layer.course.name }}</a></span>
                            </td>
                            <td><span v-for="(n,index) in note"><span v-if="index !== 0">, </span>
                                        <a :href="route('notes-show',n)">{{
                                                n.video.layer.name
                                            }}</a></span>
                            </td>
                        </tr>
                        <p v-if="!Object.keys(this.s_notes).length">No rows found</p>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="notes-else" v-else>
                <transition name="list">
                    <div class="question-box text-left my-4" v-if="no_notes">
                        <div class="row">
                            <div class="col-lg-11 col-10">
                                When you take written or audio notes during your lessons they will be saved here.
                                Good
                                luck!
                            </div>
                            <div class="col-lg-1 col-2 d-flex align-items-center">
                                <i v-on:click="no_notes = disableNotification('no_notes')"
                                   class="fas fa-times red-text"></i>
                            </div>
                        </div>
                    </div>
                </transition>
            </div>
        </div>
    </app-layout>
</template>


<script>
import AppLayout from '@/Layouts/AppLayout'
import moment from 'moment'

export default {
    components: {
        AppLayout,
    },
    props: ['notes', 'user'],
    data() {
        return {
            formula: '$$x = {-b \\pm \\sqrt{b^2-4ac} \\over 2a}.$$',
            query: '',
            calendar: false,
            moment: moment,
            notes: this.notes,
            s_notes: this.notes,
            no_notes: localStorage.getItem('no_notes') === 'true',
            selected_course: '',
        }
    },
    methods: {
        disableNotification(attribute) {
            localStorage.setItem(attribute, false);
        },
        filterNotes: function (input = '', course = '') {
            console.log(input)
            axios.get(route('notes-search') + '?course=' + course + '&input=' + input)
                .then(response => {
                    console.log('response:')
                    console.log(response.data.s_notes)
                    this.s_notes = response.data.s_notes
                })
                .catch(error => {
                    this.toast.error('Something went wrong!');
                });
        },
    }
    ,
    setup() {
        let saved = localStorage.getItem('no_notes') === null;
        if (saved) {
            localStorage.setItem('no_notes', true)
        }
    },
    mounted() {
        console.log(this.s_notes)
    }
}
</script>
