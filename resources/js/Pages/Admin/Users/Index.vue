<template>
    <admin-layout>
        <div class="container users" data-aos="fade-up">
            <h1 class="blue-text">Users</h1>
            <div class="row justify-content-end">
                <div class="col-md-4">
                    <div class="search-content">
                        <input type="text" v-model="term" v-on:keyup="search" placeholder="Search by name..."
                               class="form-control">
                    </div>
                </div>
            </div>


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
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="user in users.data" :key="user.id">
                        <td>{{ user.id }}</td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.profile?.reminder_phone }}</td>
                        <td>{{ moment(user.created_at).format("DD-MM-YYYY") }}</td>
                        <td>
                            <a class="text-white" @click="show(user.id)"
                               v-if="user.profile && user.role_id===1">View</a>
                            <button v-else-if="user.role_id===1" v-on:click="setAsTutor(user)"
                                    class="btn btn-outline-primary btn-sm">
                                Set As Tutor
                            </button>
                        </td>
                    </tr>
                    <p v-if="!users.data.length">No row found</p>
                    </tbody>
                </table>
            </div>
            <pagination :pagination="this.pagination"/>
        </div>
    </admin-layout>
</template>


<script>
import AdminLayout from '@/Layouts/AdminLayout'
import {Inertia} from '@inertiajs/inertia'
import moment from 'moment'
import Pagination from "@/components/Pagination";

export default {
    components: {
        AdminLayout,
        Inertia,
        Pagination
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
            pagination: {
                nextPageUrl: this.users.next_page_url,
                prevPageUrl: this.users.prev_page_url
            },
        }
    },
    methods: {
        show: function (user) {
            this.$inertia.get('users/' + user)
        },
        setAsTutor: function (user) {
            if (!confirm('Are you sure want to set this user as tutor?')) return;
            axios.post(route('set.tutor', user)).then(response => {
                this.toast.success(response.data.message)
            }).catch(error => {
                this.toast.error('Something went wrong!')
                console.log(error.response)
            })
        },
        search: function () {
            this.$inertia.replace(this.route('admin.users', {term: this.term}))
        }

    },
}
</script>
