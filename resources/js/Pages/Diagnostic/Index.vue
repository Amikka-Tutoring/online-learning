<template>
    <app-layout>
        <div class="container">
            <calculator/>
            <!--            <div  class="d-flex justify-content-center">-->
            <div
                v-if="form.currentstep != 1 && form.currentstep != diagnostic.length"
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
                            <span class="blue-text">{{ diagnostic.name }}</span>
                            Diagnostic
                        </h1>
                        <div class="step-one" style="margin-left: 100px">
                            <div class="row" style="">
                                <ol>
                                    <li>The <span class="blue-text">{{ diagnostic.diagnostic.name }} Diagnostic</span>
                                        helps us access your
                                        <span class="blue-text"
                                        >strengths and weaknesses </span
                                        >in order to
                                        <span class="blue-text"
                                        >maximize your score.</span
                                        >
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
                    <div v-for="(question, index) in diagnostic.questions">
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
                                    diagnostic.questions.length + 1 &&
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
                                diagnostic.questions.length + 1
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
import {Inertia} from "@inertiajs/inertia";
import {useToast} from "vue-toastification";
import Question from "../../components/Question";
import Calculator from "@/components/Calculator";


export default {

    components: {
        AppLayout,
        Question,
        Calculator
    },
    methods: {
        toLetter(value) {
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
    },
    props: {
        diagnostic: Object,
    },
    setup(props) {
        const form = reactive({
            errors: [],
            answers: {},
            answer_list: [],
            progress_value: 0,
            currentstep: 1,
            diagnostic_name: props.diagnostic.slug
        });
        const toast = useToast();

        function next() {
            if (!validate()) {
                toast.error('You need to select the answer')
                return
            }
            form.currentstep++;
            console.log(form.currentstep)
            form.errors = [];
            form.progress_value = ((form.currentstep - 1) * 100) / props.diagnostic.questions.length;
            form.answer_list.push(form.answers);

            if (form.currentstep === props.diagnostic.questions.length + 2) {
                console.log("submitted");
                form.errors = [];
                form.progress_value = 100;
                console.log(form);

            }
        }

        function finish() {
            if (!validate()) {
                toast.error('You need to select the answer')
                return
            }
            form.answer_list.push(form.answers);
            toast.success('Submitted')
            Inertia.post(route('quiz.result'), form);
        }

        function validate() {
            if (form.answers[form.currentstep]) {
                return true
            }
            return false
        }

        function start() {
            form.currentstep++;
            form.progress_value = ((form.currentstep - 1) * 100) / props.diagnostic.questions.length;
        }

        function back() {
            form.currentstep--;
            form.errors = [];
            form.progress_value = ((form.currentstep - 1) * 100) / props.diagnostic.questions.length;
            form.answer_list.pop(form.answers);
        }

        return {form, start, next, back, finish, toast};
    },

    data() {
        return {
            currenstep: 1,
        };
    },

    mounted(props) {
        console.log(this.diagnostic);
    }
}
</script>
