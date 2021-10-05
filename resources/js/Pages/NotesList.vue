<template>
    <app-layout>
        <div class="container">
            <h1 class="blue-text">Notes</h1>
            <div class="notes-buttons">
                <div class="row">
                    <div class="col-lg-6 col-12 text-right buttons">
                        <button><i class="fas fa-chevron-down blue-text mr-2"></i>Course</button>
                        <button><i class="fas fa-plus blue-text mr-2"></i>New</button>
                    </div>
                    <div class="col-lg-6 col-12">
                        <i class="fab fa-searchengin fa-2x blue-text pr-2 search-icon position-absolute"
                           style="padding-left: 20px; padding-top: 10px"></i>
                        <input type="text" v-model="query" v-on:keyup="filterNotes(query)">
                    </div>
                </div>
            </div>
            <hr class="blue-divider">
            <div class="notes-table">
                <table>
                    <thead>
                    <tr>
                        <th style="width: 25%" @click="sort('dates'); calendar = !calendar"><i
                            class="fas fa-calendar-day blue-text mr-2"></i>Dates
                            <!--                            <i class="fas blue-text ml-2"-->
                            <!--                               v-bind:class="calendar ? 'fa-chevron-up':'fa-chevron-down'"></i>-->
                        </th>
                        <th style=" width: 15%" @click="sort('class')"><i class="fas fa-book-open blue-text mr-2"></i>Class
                        </th>
                        <th style="width: 30%" @click="sort('topics')"><i class="fas fa-pen blue-text mr-2"></i>Topics
                        </th>
                        <th style="width: 30%"><i class="fas fa-pen blue-text mr-2"></i>Note
                        </th>
                        <th style="width: 30%" @click="sort('tags')"><i class="fas fa-tags blue-text mr-2"></i>Tags</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(note,index) in notes">
                        <td>{{ moment(note.created_at).format("MM/DD") }}</td>
                        <td>{{ note.lesson.course.name }}</td>
                        <td>{{ note.lesson.name }}</td>
                        <td>{{ note.written_notes }}</td>
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
    props: ['notes'],
    data() {
        return {
            query: '',
            calendar: false,
            moment: moment,
            notes: this.notes,
        }
    },
    methods: {
        filterNotes: function (query) {
            axios.get(route('notes-search', query))
                .then(response => {
                    this.notes = response.data.notes
                })
                .catch(error => {
                    this.toast.error('Something went wrong!');
                });
        },
    },
}
</script>
