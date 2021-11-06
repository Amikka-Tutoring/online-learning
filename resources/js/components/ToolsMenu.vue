<template>
    <div class="tools-menu">
        <ul>
            <li @click="next = !next">Next <i class="pl-2 blue-text fas"
                                              v-bind:class="next ? 'fa-arrow-up' : 'fa-arrow-down'"></i></li>
            <collapse-transition>
                <li v-show="next">
                    <div class="next-lessons">
                        <div class="next-up">Next Up</div>
                        <div class="next-item">
                            <div class="row">
                                <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                    <i class="fas fa-play-circle" style="color: #4C6ED7"></i>
                                </div>
                                <div class="col-7">
                                    <div class="row">
                                        <p>Concision</p>
                                    </div>
                                    <div class="row">
                                        <span class="ml-2 badges gray-badge">Strategy</span><span
                                        class="ml-2 badges gray-badge">All</span>
                                    </div>
                                </div>
                                <div class="col-3 d-flex justify-content-center align-items-center text-center">
                                    <p>03:23</p>
                                </div>
                            </div>
                        </div>
                        <div class="next-item">
                            <div class="row">
                                <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                    <i class="fas fa-play-circle" style="color: #4C6ED7"></i>
                                </div>
                                <div class="col-7">
                                    <div class="row">
                                        <p>Concision</p>
                                    </div>
                                    <div class="row">
                                        <span class="ml-2 badges gray-badge">Strategy</span><span
                                        class="ml-2 badges gray-badge">All</span>
                                    </div>
                                </div>
                                <div class="col-3 d-flex justify-content-center align-items-center text-center">
                                    <p>03:23</p>
                                </div>
                            </div>
                        </div>
                        <p>{{ videos }}</p>

                        <div class="next-item">
                            <div class="row">
                                <div class="col-2 d-flex justify-content-center align-items-center text-center">
                                    <i class="fas fa-play-circle" style="color: #4C6ED7"></i>
                                </div>
                                <div class="col-7">
                                    <div class="row">
                                        <p>Concision</p>
                                    </div>
                                    <div class="row">
                                        <span class="ml-2 badges gray-badge">Strategy</span><span
                                        class="ml-2 badges gray-badge">All</span>
                                    </div>
                                </div>
                                <div class="col-3 d-flex justify-content-center align-items-center text-center">
                                    <p>03:23</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </collapse-transition>
            <li @click="tools = !tools">Tools <i class="pl-2 blue-text fas"
                                                 v-bind:class="tools ? 'fa-arrow-up' : 'fa-arrow-down'"></i></li>
            <collapse-transition>
                <li v-if="tools" class="p-0">
                    <div class="tools">
                        <div class="row">
                            <div class="col-3">
                                <div class="notes-circle rounded-circle" title="Ask a question"
                                     v-on:click="written_notes = false; question_box = true"><i
                                    class="fas fa-question"></i></div>
                            </div>
                            <div class="col-3">
                                <div class="notes-circle rounded-circle" title="Write notes"
                                     v-on:click="written_notes = true; question_box = false"><i
                                    class="fas fa-pen"></i></div>
                            </div>
                            <div class="col-3">
                                <div class="notes-circle rounded-circle" title="Save for later"><i
                                    class="fas fa-flag"></i>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="notes-circle rounded-circle" title="Voice notes"><i
                                    class="fas fa-microphone-alt"></i></div>
                            </div>
                        </div>
                        <collapse-transition>
                            <div v-if="written_notes">
                                  <textarea v-model="form.written_notes" placeholder="Notes..." cols="25"
                                            rows="10"></textarea>
                                <button v-on:click="submit">Submit</button>
                            </div>
                        </collapse-transition>
                        <collapse-transition>
                            <div v-if="question_box">
                                <textarea v-model="question_form.question_text" placeholder="Question..." id=""
                                          cols="25"
                                          rows="10"></textarea>
                                <button v-on:click="submitQuestion">Submit</button>
                            </div>
                        </collapse-transition>

                    </div>
                </li>
            </collapse-transition>
        </ul>
    </div>
</template>

<script>

import CollapseTransition from '@ivanv/vue-collapse-transition/src'

export default {
    components: {
        CollapseTransition,
    },
    methods: {
        submit: function () {
            axios.post(route('notes.store'), this.form)
                .then(response => {
                    this.toast.success(response.data.message)
                })
                .catch(error => {
                    Object.values(error.response.data.errors).flat().forEach(element => this.toast.error(element))
                });
        },
        submitQuestion: function () {
            axios.post(route('notes.store.question'), this.question_form)
                .then(response => {
                    this.toast.success(response.data)
                    this.question_form.question_text = null
                })
                .catch(error => {
                    Object.values(error.response.data.errors).flat().forEach(element => this.toast.error(element))
                });
        },
    },
    props: ['form', 'question_form', 'videos'],

    data() {
        return {
            next: false,
            tools: false,
            written_notes: false,
            question_box: false,
            form: this.form,
            question_form: this.question_form
        }
    },
}
</script>
