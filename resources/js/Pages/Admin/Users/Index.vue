<template>
    <admin-layout>
        <div class="container users">
            <h1 class="blue-text">Users</h1>
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
                    <tr v-for="user in sortedUsers">
                        <td>{{ user.id }}</td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.number }}</td>
                        <td>{{ user.created }}</td>
                        <td>
                            <button @click="printUser(user)">View</button>
                        </td>
                    </tr>
                    <p v-if="!sortedUsers.length">No row found</p>
                    </tbody>
                </table>
            </div>
        </div>
    </admin-layout>
</template>


<script>
import AdminLayout from '@/Layouts/AdminLayout'
import {Inertia} from '@inertiajs/inertia'

export default {
    components: {
        AdminLayout,
        Inertia
    },
    data() {
        return {
            currentSort: 'class',
            currentSortDir: 'asc',
            query: '',
            selectedUser: null,
            id: false,
            name: false,
            email: false,
            number: false,
            created: false,
            users: [
                {
                    id: 1,
                    name: 'Anthony Hawkins',
                    email: 'anthony@gmail.com',
                    number: '(123)-541-9594',
                    created: '1 day ago',
                },
                {
                    id: 2,
                    name: 'Michele Mccoy',
                    email: 'michele.mccoy@gmail.com',
                    number: '(342)-689-9594',
                    created: '1 week ago',
                },
                {
                    id: 3,
                    name: 'Harold Hoffman',
                    email: 'harold.hoffman@gmail.com',
                    number: '(270)-546-9338',
                    created: '1 month ago',
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
        },
        printUser(e) {
            this.selectedUser = e;
            Inertia.get('users/user', this.selectedUser);
            console.log(this.selectedUser)
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
