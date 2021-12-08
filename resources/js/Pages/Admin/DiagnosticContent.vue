<template>
    <admin-layout>
        <div class="container" data-aos="fade-up">
            <div class="csv-table">
                <table>
                    <thead>
                    <tr>
                        <th>Diagnostic</th>
                        <th>URL</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(content,index) in contents" v-if="contents.length">
                        <td>{{ content.quiz.name }}</td>
                        <td>
                            <input type="url" v-model="content.link" class="border-0 w-100">
                        </td>
                        <td class="text-center">
                            <div class="btn btn-primary pt-0 pb-0 mr-2 action-buttons"
                                 style="background-color: #4C6ED7;" @click="update(content)">Edit
                            </div>
                            <div class="btn btn-danger pt-0 pb-0 action-buttons" v-if="content.link"
                                 @click="deleteContent(content)">
                                Delete
                            </div>
                        </td>
                    </tr>
                    <p v-else>No row found</p>
                    </tbody>
                </table>
            </div>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout'


export default {
    name: "DiagnosticContent",
    components: {
        AdminLayout,
    },
    props: ['contents'],
    data() {
        return {
            contents: this.contents
        }
    },
    methods: {
        update: function (content) {
            axios.put(route('store.diagnostic.content', content.id), content).then(response => {
                this.toast.success(response.data.message)
            }).catch(error => {
                Object.values(error.response.data.errors).flat().forEach(element => this.toast.error(element))
            })
        },
        deleteContent: function (content) {
            if (!confirm('Are you sure want to remove?')) return;
            axios.delete(route('delete.diagnostic.content', content.id)).then(response => {
                this.toast.success(response.data.message)
                this.contents = response.data.contents
            }).catch(error => {
                console.log(error.response)
            })
        }
    },
    mounted() {
    }

}
</script>

<style scoped>

</style>
