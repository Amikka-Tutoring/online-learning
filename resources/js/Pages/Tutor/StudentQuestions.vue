<template>
    <admin-layout>
        <div class="container" data-aos="fade-up">
            <h1 class="blue-text">Student Questions</h1>
            <div class="csv-table">
                <table>
                    <thead>
                    <tr>
                        <th>Student</th>
                        <th>Lesson</th>
                        <th>Video</th>
                        <th>Question</th>
                        <th>Created</th>
                        <th>Response</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(question,index) in questions" v-if="questions.length">
                        <td>{{ question.user.name }}</td>
                        <td>{{ question.video.layer.name }}</td>
                        <td>{{ question.video.title }}</td>
                        <td>{{ question.question_text }}</td>
                        <td class="text-center">{{ moment(question.created_at).format("DD-MM-YYYY") }}</td>
                        <td class="text-center">
                            <button v-if="!question.response" type="button" class="btn btn-primary w-100"
                                    v-on:click="respond(question)">
                                Respond
                            </button>
                            <a v-else type="button" class="btn btn-success w-100" v-on:click="response(question)">
                                Responded
                            </a>
                        </td>
                    </tr>
                    <p v-else>No row found</p>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal -->

    </admin-layout>
    <div class="modal fade" id="modal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Video Response</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" name="title" id="title" class="form-control" v-model="form.title">
                    </div>
                    <div class="form-group">
                        <label for="url">Vimeo ID:</label>
                        <input type="text" name="url" id="url" class="form-control" v-model="form.url">
                    </div>
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea name="message" class="form-control" id="message" cols="30" rows="10"
                                  v-model="form.message"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" v-on:click="save(this.form)">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal1" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Video Response</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title1">Title:</label>
                        <input disabled type="text" name="title" id="title1" class="form-control"
                               v-model="question_response.title">
                    </div>
                    <div class="form-group">
                        <label for="url2">URL:</label>
                        <input disabled type="url" name="url" id="url2" class="form-control"
                               v-model="question_response.url">
                    </div>
                    <div class="form-group">
                        <label for="message2">Message:</label>
                        <textarea disabled name="message" class="form-control" id="message2" cols="30" rows="10"
                                  v-model="question_response.message"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="user">User:</label>
                        <input disabled type="text" name="user" id="user" class="form-control"
                               v-model="this.userName">
                    </div>
                </div>
                <!--                <div class="modal-footer">-->
                <!--                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                <!--                    <button type="button" class="btn btn-primary" v-on:click="save(this.form)">Save changes</button>-->
                <!--                </div>-->
            </div>
        </div>
    </div>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout'
import moment from 'moment'

export default {
    components: {
        AdminLayout,
    },
    props: ['user', 'questions'],
    methods: {
        openModal: function () {
            $('#modal').modal('show');
        },
        showResponse: function () {
            $('#modal1').modal('show');
        },
        respond: function (data) {
            this.openModal();
            this.form.video_id = data.video_id
            this.form.question_id = data.id
        },
        response: function (question) {
            this.showResponse();
            this.question_response = question.response
            this.userName = this.question_response.user.name

        },
        closeModal: function () {
            $('#modal').modal('hide');
            this.reset();
        },
        save: function (data) {
            console.log(data)
            axios.post(route('store.response'), data)
                .then(response => {
                    this.toast.success(response.data.message)
                    this.questions = response.data.questions
                    console.log(response.data.message)
                    this.closeModal();
                }).catch(error => {
                Object.values(error.response.data.errors).flat().forEach(element => this.toast.error(element))
            });
        }
    },

    data() {
        return {
            questions: this.questions,
            moment: moment,
            form: {
                title: null,
                url: null,
                message: null,
                video_id: null,
                question_id: null
            },
            question_response: {
                title: null,
                url: null,
                message: null,
                video_id: null,
                question_id: null
            },
            userName: false,
            loading: false,
            onsuccess: false,
            onerror: false,
            isOpen: false,
        }
    }
}
</script>
