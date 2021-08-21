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
                        <input type="text" v-model="query">
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
                            <i
                                class="fas blue-text ml-2"
                                v-bind:class="calendar ? 'fa-chevron-up':'fa-chevron-down'"></i></th>
                        <th style=" width: 15%" @click="sort('class')"><i class="fas fa-book-open blue-text mr-2"></i>Class
                        </th>
                        <th style="width: 30%" @click="sort('topics')"><i class="fas fa-pen blue-text mr-2"></i>Topics
                        </th>
                        <th style="width: 30%" @click="sort('tags')"><i class="fas fa-tags blue-text mr-2"></i>Tags</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(item,index) in (sortedItems,computedList)">
                        <td>{{ item.dates }}</td>
                        <td>{{ item.class }}</td>
                        <td>{{ item.topics }}</td>
                        <td>
                            <!--                        <span v-for="tag in item.tags">-->
                            <!--                            {{ tag.tag }}, -->
                            <!--                        </span>-->
                            <span class="lightblue-badge badges">Lesson</span>
                            <span class="gray-badge badges">Strategy</span>
                            <span class="lightrose-badge badges">Medium</span>
                        </td>
                    </tr>
                    <p v-if="!computedList.length">No row found</p>
                    </tbody>
                </table>
            </div>

        </div>
    </app-layout>
</template>


<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
    components: {
        AppLayout,
    },
    data() {
        return {
            currentSort: 'class',
            currentSortDir: 'asc',
            query: '',
            calendar: false,
            items: [
                {
                    id: 1,
                    dates: '7/11',
                    class: 'ALG',
                    topics: 'Linear',
                    tags: [
                        {
                            tag: 'lesson'
                        },
                        {
                            tag: 'linear'
                        }
                    ]
                },
                {
                    id: 2,
                    dates: '8/11',
                    class: 'ALG 2',
                    topics: 'Quadratic',
                    tags: [
                        {
                            tag: 'lesson'
                        },
                        {
                            tag: 'linear'
                        }
                    ]
                }, {
                    id: 3,
                    dates: '8/11',
                    class: 'Math',
                    topics: 'Math',
                    tags: [
                        {
                            tag: 'lesson'
                        },
                        {
                            tag: 'linear'
                        }
                    ]
                }, {
                    id: 4,
                    dates: '8/11',
                    class: 'Geography',
                    topics: 'Geography',
                    tags: [
                        {
                            tag: 'lesson'
                        },
                        {
                            tag: 'linear'
                        }
                    ]
                },
            ]
        }
    },
    methods: {
        sort: function (s) {
            //if s == current sort, reverse
            if (s === this.currentSort) {
                this.currentSortDir = this.currentSortDir === 'asc' ? 'desc' : 'asc';
            }
            this.currentSort = s;
        }
    },
    computed: {
        computedList: function () {
            var vm = this
            return this.items.filter(function (item) {
                return item.class.toLowerCase().indexOf(vm.query.toLowerCase()) !== -1
            })
        },
        sortedItems: function () {
            return this.items.sort((a, b) => {
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
