<template>
    <admin-layout>
        <div class="container users" data-aos="fade-up">
            <h1 class="blue-text">Users</h1>
            <!--            <div class="p-4">-->
            <!--                <div class="form-group">-->
            <!--                    <label for="search">Name:</label>-->
            <!--                    <input type="text" id="search" v-model="name" @keyup="search" class="form-control">-->
            <!--                </div>-->
            <!--            </div>-->
            <div class="users-table">
                <table>
                    <thead>
                    <tr>
                        <th @click="sort('id'); id = !id">Reference Number
                            <i class="fas blue-text ml-2"
                               v-bind:class="id ? 'fa-chevron-up':'fa-chevron-down'"></i></th>
                        <th @click="sort('name'); name = !name">Name <i class="fas blue-text ml-2"
                                                                        v-bind:class="name ? 'fa-chevron-up':'fa-chevron-down'"></i>
                        </th>
                        <th @click="sort('email'); email = !email">Email <i class="fas blue-text ml-2"
                                                                            v-bind:class="email ? 'fa-chevron-up':'fa-chevron-down'"></i>
                        </th>
                        <th @click="sort('number'); number = !number">Number <i class="fas blue-text ml-2"
                                                                                v-bind:class="number ? 'fa-chevron-up':'fa-chevron-down'"></i>
                        </th>
                        <th @click="sort('created'); created = !created">Created <i class="fas blue-text ml-2"
                                                                                    v-bind:class="created ? 'fa-chevron-up':'fa-chevron-down'"></i>
                        </th>
                        <th>View</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="user in users.data">
                        <td>{{ user.id }}</td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.number }}</td>
                        <td>{{ moment(user.created_at).format("DD-MM-YYYY") }}</td>
                        <td>
                            <a class="text-white" @click="show(user.id)">View</a>
                        </td>
                    </tr>
                    <p v-if="!users.data.length">No row found</p>
                    </tbody>
                </table>
            </div>
        </div>
    </admin-layout>
</template>


<script>
import AdminLayout from '@/Layouts/AdminLayout'
import {Inertia} from '@inertiajs/inertia'
import moment from 'moment'

export default {
    components: {
        AdminLayout,
        Inertia
    },
    props: {
        users: Object,
    },
    data() {
        return {
            moment: moment,
            currentSort: 'class',
            currentSortDir: 'asc',
            query: '',
            selectedUser: null,
            id: false,
            name: '',
            email: false,
            number: false,
            created: false,
        }
    },
    methods: {
        sort: function (s) {
            //if s == current sort, reverse
            if (s === this.currentSort) {
                this.currentSortDir = this.currentSortDir === 'asc' ? 'desc' : 'asc';
            }
            this.currentSort = s;
        },
        printUser(e) {
            this.selectedUser = e;
            // Inertia.get('users/user', this.selectedUser);
            console.log(this.selectedUser)
        },
        show: function (user) {
            this.$inertia.get('users/' + user)
        },
        search: function () {
            console.log('search');
            this.$inertia.replace('users?name=' + this.name)
        }
    },
    computed: {
        sortedUsers: function () {
            return this.users.sort((a, b) => {
                let modifier = 1;
                if (this.currentSortDir === 'desc') modifier = -1;
                if (a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
                if (a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
                return 0;
            });
        }
    }
}
</script>
