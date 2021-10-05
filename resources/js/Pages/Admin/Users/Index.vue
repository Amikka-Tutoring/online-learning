<template>
    <admin-layout>
        <div class="container users" data-aos="fade-up">
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
                    <tr v-for="user in users">
                        <td>{{ user.id }}</td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.profile?.reminder_phone }}</td>
                        <td>{{ moment(user.created_at).format("DD-MM-YYYY") }}</td>
                        <td>
                            <a class="text-white" @click="show(user.id)">View</a>
                        </td>
                    </tr>
                    <p v-if="!users.length">No row found</p>
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
        show: function (user) {
            this.$inertia.get('users/' + user)
        },
    },
}
</script>
