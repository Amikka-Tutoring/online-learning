<template>
    <app-layout>
        <div class="container">
            <!--            <div  class="d-flex justify-content-center">-->
            <div
                v-if="form.currentstep != 1 && form.currentstep != layer.length"
                class="row justify-content-center align-items-center"
                style="margin-bottom: 50px; margin-top: -20px"
            >
                <div
                    class="progress"
                    style="height: 5px; width: 370px; margin: 0 20px"
                >
                    <div
                        :style="{ width: form.progress_value + '%' }"
                        aria-valuemax="100"
                        aria-valuemin="0"
                        aria-valuenow="50"
                        class="progress-bar"
                        role="progressbar"
                        style="background: #56c880"
                    ></div>
                </div>
                <div class="blue-text">Skip</div>
            </div>
            <div>
                <form class="form" method="POST">
                    <div v-if="form.currentstep === 1" class="first-step">
                        <h1>
                            <span class="blue-text">{{ layer.name }}</span>
                            Quiz
                        </h1>
                        <div class="step-one" style="margin-left: 100px">
                            <div class="row" style="">
                                <ol>
                                    <li>The <span class="blue-text">{{ layer.name }}</span> Quiz

                                    </li>
                                    <li>
                                        Based on your
                                        <span class="blue-text"
                                        >performance</span
                                        >
                                        we build you a personalized course that
                                        teaches you exactly what you need to
                                        know.
                                    </li>
                                    <li>
                                        Please answer the next ten questions to
                                        the
                                        <span class="blue-text"
                                        >best of your ability.</span
                                        >
                                    </li>
                                    <li>
                                        <button
                                            v-if="form.currentstep === 1"
                                            class="blue-button"
                                            @click.prevent="start()"
                                        >
                                            Start
                                        </button>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div v-for="(question, index) in layer.questions">
                        <div v-if="form.currentstep === index + 2"
                             class="row w-100">
                            <div class="col-lg-6 col-12">
                                <p class="quiz-question-box">{{ question.title }}</p>
                                <div class="image-box text-center">
                                    <img class="w-100" :src="question.image">
                                </div>
                                <p class="quiz-question-box text-left">
                                <ol style="list-style-type: upper-latin">
                                    <li v-for=" (answer, index) in question.answers">{{ answer.title }}</li>
                                </ol>
                                </p>
                            </div>
                            <div class="col-lg-6 col-12 d-flex align-items-center">
                                <div class="row w-100">
                                    <div class="wrapper d-flex flex-column">
                                        <div class="row w-100">
                                            <div v-for="(answer, index) in question.answers"
                                                 :key="answer"
                                                 :index="question.key"
                                                 class="col-6"
                                            >
                                                <div class="options">
                                                    <input :id="'option-' +answer.id"
                                                           :key="answer.title"
                                                           v-model="form.answers[form.currentstep]"
                                                           :name="form.answers[form.currentstep]"
                                                           :value="answer"
                                                           required
                                                           type="radio"/>
                                                    <label :class="'option option-' +answer.id"
                                                           :for="'option-' +answer.id">
                                                        <div class="dot"></div>
                                                        <span>{{ toLetter(index + 1) }}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <button
                                v-if="form.currentstep > 1"
                                class="blue-button w-100"
                                style="font-size: 24px"
                                @click.prevent="back()"
                            >
                                <i class="bi bi-arrow-left-circle"></i>
                            </button>
                        </div>
                        <div class="col-6">
                            <button
                                v-if="
                                form.currentstep !==
                                    layer.questions.length + 1 &&
                                form.currentstep !== 1
                            "
                                class="blue-button w-100"
                                style="font-size: 24px"
                                @click.prevent="next()"
                            >
                                <i class="bi bi-arrow-right-circle"></i>
                            </button>
                            <button
                                v-if="
                                form.currentstep ===
                                layer.questions.length + 1
                            "
                                class="blue-button w-100"
                                style="font-size: 24px"
                                @click.prevent="finish()">
                                Finish
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import {reactive} from "vue";


export default {

    components: {
        AppLayout,
    },
    methods: {
        toLetter(value) {
            //do something here
            if (value == 1) {
                return 'A'
            } else if (value == 2) {
                return 'B'
            } else if (value == 3) {
                return 'C'
            } else {
                return 'D'
            }
        },
        next: function () {
            if (!this.validate()) {
                this.toast.error('You need to select the answer')
                return
            }
            this.form.currentstep++;
            this.form.errors = [];
            this.form.progress_value = ((this.form.currentstep - 1) * 100) / this.layer.questions.length;
            this.form.answer_list.push(this.form.answers);

            if (this.form.currentstep === this.layer.questions.length + 2) {
                this.form.errors = [];
                this.form.progress_value = 100;

            }
        },
        finish: function () {
            if (!this.validate()) {
                this.toast.error('You need to select the answer')
                return
            }
            this.form.answer_list.push(this.form.answers);
            axios.post(route('lesson.quiz.store', this.form.layer_id), this.form.answer_list[0])
                .then(response => {
                    this.toast.success(response.data.message);
                    this.toast.success(response.data.score);
                    // setTimeout(function () {
                    window.location.href = "/lesson/" + this.form.layer_id;
                    // }, 2000);
                })
                .catch(error => {
                    Object.values(error.response.data.errors).flat().forEach(element => this.toast.error(element))
                });
        },
        validate: function () {
            if (this.form.answers[this.form.currentstep]) {
                return true
            }
            return false
        },
        start: function () {
            this.form.currentstep++;
            this.form.progress_value = ((this.form.currentstep - 1) * 100) / this.layer.questions.length;
        },

        back: function () {
            this.form.currentstep--;
            this.form.errors = [];
            this.form.progress_value = ((this.form.currentstep - 1) * 100) / this.layer.questions.length;
            this.form.answer_list.pop(this.form.answers);
        }
    },
    props: {
        layer: Object,
    },
    data() {
        return {
            currenstep: 1,
            form: {
                errors: [],
                answers: {},
                answer_list: [],
                progress_value: 0,
                currentstep: 1,
                layer_id: this.layer.id,
                layer: this.layer
            }
        }
    },
    mounted() {

    }
}
</script>
