<template>
    <app-layout>
        <div class="container">
            <h1 class="blue-text">Notes</h1>
            <div class="notes-buttons">
                <div class="row">
                    <div class="col-lg-6 col-12 text-right buttons">
                        <select name="" id="" class="text-right buttons"
                                style="background: rgba(196, 196, 196, 0.25);border-radius: 10px;color: #4c6ed7;border: none;padding: 10px 20px; margin-right: 25px;"
                                v-on:change="filterNotes(this.input,this.selected_course)" v-model="selected_course">
                            <option v-for="en in user.enrollments">{{ en.course.name }}</option>
                        </select>
                        <!--                        <button><i class="fas fa-plus blue-text mr-2"></i>New</button>-->
                    </div>
                    <div class="col-lg-6 col-12">
                        <i class="fab fa-searchengin fa-2x blue-text pr-2 search-icon position-absolute"
                           style="padding-left: 20px; padding-top: 10px"></i>
                        <input type="text" v-model="input" v-on:keyup="filterNotes(this.input,this.selected_course)">
                    </div>
                </div>
            </div>
            <hr class="blue-divider">
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
                        <th style="width: 30%"><i class="fas fa-tags blue-text mr-2"></i>Tags</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(note,index) in notes">
                        <td>{{ moment(note.created_at).format("MM/DD") }}</td>
                        <td>{{ note.lesson.course.name }}</td>
                        <td><a :href="route('notes-show',note)">{{ note.lesson.name }}</a></td>
                        <td>
                            <span v-for="tag in note.lesson.tags" class="lightblue-badge badges">{{ tag.name }}</span>
                        </td>
                    </tr>
                    <p v-if="!notes.length">No rows found</p>
                    </tbody>
                </table>
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
            query: '',
            calendar: false,
            moment: moment,
            notes: this.notes,
            selected_course: 'Grammar'
        }
    },
    methods: {
        filterNotes: function (input = '', course = '') {
            console.log('input: ' + input, 'course :' + course)
            axios.get('notes/search/' + course + '/' + input)
                .then(response => {
                    this.notes = response.data.notes
                    console.log(response.data)
                })
                .catch(error => {
                    this.toast.error('Something went wrong!');
                });
        },
    }
    ,
}
</script>
