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
                        <input type="text" v-model="query" @input="onInput">
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
                        <th style="width: 30%" @click="sort('tags')"><i class="fas fa-tags blue-text mr-2"></i>Tags</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(note,index) in notes" :key="note.id">
                        <td>{{ moment(note.created_at).format("MM/DD") }}</td>
                        <td>{{ note.lesson.course.name }}</td>
                        <td>{{ note.lesson.name }}</td>
                        <td>{{ note.written_notes }}</td>
                        <td>
                            <span v-for="tag in note.lesson.tags" class="lightblue-badge badges">{{ tag.name }}</span>
                        </td>
                    </tr>
                    <p v-if="!notes">No rows found</p>
                    </tbody>
                </table>
                <div>
                    <nav class="ls-pagination">
                        <ul>
                            <li class="prev page-item"><a
                                class=""
                                href=""><i class=" fa fa-arrow-left"></i></a></li>
                            <!--                            @for ($i = 1; $i <= $paginator->lastPage(); $i++)-->
                            <li class="page-item">
                                <a class=""
                                   href="">1</a>
                            </li>
                            <!--                            @endfor-->
                            <li class="page-item ">
                                <a class="" @click="next_page()"><i
                                    class="fa fa-arrow-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div>
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
    mounted() {
        console.log(this.notes)
        console.log(this.current_page)
    },
    data() {
        return {
            currentSort: 'class',
            currentSortDir: 'asc',
            query: '',
            calendar: false,
            moment: moment,
            notes: this.notes.data,
            current_page: this.notes.current_page,
            page: this.notes.current_page,
        }
    },
    methods: {
        sort: function (s) {
            if (s === this.currentSort) {
                this.currentSortDir = this.currentSortDir === 'asc' ? 'desc' : 'asc';
            }
            this.currentSort = s;
        },
        onInput(event) {
            this.page = 0;
            this.query = event.target.value;
            this.filterNotes();
        },
        filterNotes: function () {
            console.log('filter notes')
            console.log(this.query)
            console.log(this.page)
            axios.get(route('notes-search', this.query, this.page))
                .then(response => {
                    console.log('response')
                    console.log(response);
                    this.notes = response.data.notes.data
                })
                .catch(error => {
                });
        },
        next_page() {
            console.log('next 1' + this.page)
            this.page++;
            console.log('next 2' + this.page)
            this.filterNotes()
        }
    },
    computed: {
        computedList: function (props) {
            var vm = this
            return props.notes.filter(function (item) {
                // return item.class.toLowerCase().indexOf(vm.query.toLowerCase()) !== -1
            })
        },
        sortedItems: function () {
            return this.notes.sort((a, b) => {
                let modifier = 1;
                if (this.currentSortDir === 'desc') modifier = -1;
                if (a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
                if (a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
                return 0;
            });
        }
    },
}
</script>
