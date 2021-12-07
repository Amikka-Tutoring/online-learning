<template>
    <app-layout>
        <div class="container">
            <!--            <div  class="d-flex justify-content-center">-->
            <div
                v-if="form.currentstep != 1 && form.currentstep != layer.length"
                class="row justify-content-center align-items-center"
                style="margin-bottom: 50px; margin-top: -20px"
            >
                <div v-if="layer.content.link" class="blue-text" v-on:click="showFrame"><img src="/images/messenger.png"
                                                                                             alt="">
                </div>
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

            </div>
            <div>
                <form class="form" method="POST">
                    <div v-if="form.currentstep === 1" class="first-step">
                        <h1>
                            {{ layer.name }} Quiz
                        </h1>
                        <div class="step-one" style="margin-left: 100px">
                            <div class="row" style="">
                                <ol>
                                    <li>The <strong>{{ layer.name }}</strong> Quiz
                                    </li>
                                    <li>
                                        Based on your performance we build you a personalized course that
                                        teaches you exactly what you need to
                                        know.
                                    </li>
                                    <li>
                                        Please answer the next questions to
                                        the best of your ability.
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
                    <div class="modal fade" id="readFrame" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered m-0" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Excerpt</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body p-0">
                                    <iframe id="frame" :src="layer.content.link" type="application/pdf"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-for="(question, index) in layer.questions">
                        <div v-if="form.currentstep === index + 2"
                             class="row w-100 m-0 justify-content-center flex-column align-items-center">
                            <div class="col-12">
                                <p class="quiz-question-box" v-if="hasFormula(question.title)">
                                    <math-field id="formula" letterShapeStyle="upright"
                                                smart-mode
                                                style="font-size:18px;padding: 3px;border: none;display: inline-block; font-family: Arial"
                                                readOnly="true">
                                        {{ removeText(question.title) }}
                                    </math-field>
                                </p>
                                <p class="quiz-question-box" v-else>{{ question.title }}</p>
                            </div>

                            <div class="col-md-5">
                                <div class="image-box text-center">
                                    <img class="w-100" :src="question.image">
                                </div>
                            </div>
                            <div class="col-md-5 d-flex align-items-center justify-content-center">
                                <div class="row w-100">
                                    <div class="wrapper d-flex flex-column">
                                        <div class="row w-100 justify-content-center">
                                            <div v-for="(answer, index) in question.answers"
                                                 :key="answer"
                                                 :index="question.key"
                                                 class="col-md-12 p-0"
                                            >
                                                <div class="options">
                                                    <input :id="'option-' +answer.id"
                                                           :disabled="form.answers[form.currentstep]"
                                                           v-on:click="showExplanation(answer.id)"
                                                           :key="answer.title"
                                                           v-model="form.answers[form.currentstep]"
                                                           :name="form.answers[form.currentstep]"
                                                           :value="answer"
                                                           required
                                                           type="radio"/>
                                                    <label :class="'option option-' +answer.id"
                                                           :for="'option-' +answer.id">
                                                        <div class="dot"></div>
                                                        <span>{{ answer.title }}</span>
                                                    </label>
                                                    <div class="explanation-box shadow"
                                                         v-bind:class="[answer.is_correct ? 'correct':'incorrect']"
                                                         v-if="form.explanations[answer.id]">
                                                        <p class="text-center font-weight-bold">Explanation</p>
                                                        <hr>
                                                        <p class="text-justify text">{{
                                                            answer.explanation
                                                            }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center my-4">
                        <div class="col-md-2 col-5">
                            <button
                                v-if="form.currentstep > 1"
                                class="blue-button w-100"
                                style="font-size: 24px"
                                @click.prevent="back()"
                            >
                                <i class="bi bi-arrow-left-circle"></i>
                            </button>
                        </div>
                        <div class="col-md-2 col-5">
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
                    <div v-if="form.currentstep > 1" class="row justify-content-center">
                        <button class="retry-btn blue-text" v-on:click.prevent="retry()">Retry</button>
                    </div>
                </form>
            </div>
        </div>
    </app-layout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
    components: {
        AppLayout
    },
    methods: {
        showFrame: function () {
            $('#readFrame').modal('show');
            var head = jQuery("#readFrame").contents().find("head");
            var css = '<style type="text/css">' +
                '*{display:none}; ' +
                '</style>';
            jQuery(head).append(css);
        },
        showExplanation: function (index) {
            this.form.explanations = []
            this.form.explanations[index] = true
        },
        retry: function () {
            this.form.explanations = []
            this.form.answers[this.form.currentstep] = false
        },
        next: function () {
            if (!this.validate()) {
                this.toast.error('You need to select the answer')
                return
            }
            console.log('Answers')
            console.log(this.form.answers)
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
                    window.location.href = "/";
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
        },
        hasFormula(text) {
            return text.startsWith('&&&')
        },
        removeText(text) {
            return text.replace('&&&', '')
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
                layer: this.layer,
                explanations: []
            }
        }
    },
    mounted() {
        const mf = document.querySelector('#formula');
        // mf.replace('&&&', '');
    }
}
</script>
<style scoped>
.explanation-box {
    border: 1px solid lightgray;
    padding: 5px 20px;
}

.explanation-box p.text {
    color: #808080;
    font-size: 0.9em;
}

.correct {
    border-top: 2px solid green;
}

.incorrect {
    border-top: 2px solid red;
}

.retry-btn {
    border: none;
    background: none;
    text-decoration: underline;
}

iframe {
    width: 100%;
    min-height: 400px;
    height: 100%;
}

.modal-dialog {
    position: absolute;
    left: 0;
    top: 85px;
    width: 700px;
    max-width: 700px;
}

.modal-content {
    height: 80vh;
}

.modal-dialog-centered {
    display: block !important;
}

@media (max-width: 767.98px) {
    .modal-dialog {
        width: 100% !important;
    }
}
</style>
