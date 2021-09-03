<template>
    <app-layout>
        <div class="container">
            <!--            <div  class="d-flex justify-content-center">-->
            <div
                v-if="
                    form.currentstep != 1 &&
                    form.currentstep != diagnostic.length
                "
                class="row justify-content-center align-items-center"
                style="margin-bottom: 70px"
            >
                <div
                    class="progress"
                    style="height: 5px; width: 370px; margin: 0 20px"
                >
                    <div
                        style="background: #56c880"
                        :style="{ width: form.progress_value + '%' }"
                        class="progress-bar"
                        role="progressbar"
                        aria-valuenow="50"
                        aria-valuemin="0"
                        aria-valuemax="100"
                    ></div>
                </div>
                <div class="blue-text">Skip</div>
            </div>
            <div
                v-if="form.errors.length"
                class="alert alert-danger"
                v-for="error in form.errors"
            >
                {{ error }}
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
                                    <li>
                                        The
                                        <span class="blue-text"
                                        >{{
                                                diagnostic.diagnostic.name
                                            }}
                                            Diagnostic</span
                                        >
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
                                            @click.prevent="start()"
                                            class="blue-button"
                                        >
                                            Start
                                        </button>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <div v-for="(question, index) in diagnostic.questions">
                        <div
                            class="row math-questions w-100"
                            v-show="form.currentstep === index + 2">
                            <div class="col-lg-6 col-12">
                                <p class="quiz-question-box">{{ question.question }}</p>
                                <p class="quiz-question-box text-left">
                                <ol>
                                    <li v-for="(answer, index) in question.answers">{{ answer.answer }}</li>
                                </ol>
                                </p>

                                <!--                                <img :src="'/images/math-question.png'" style="width: 100%">-->
                            </div>
                            <div
                                class="
                                    col-lg-6 col-12
                                    d-flex
                                    align-items-center
                                "
                            >
                                <div class="row w-100">
                                    <div class="wrapper d-flex flex-column">
                                        <div class="row w-100">
                                            <div v-for="(
                                                    answer, index
                                                ) in question.answers"
                                                 :index="question.key"
                                                 :key="answer"
                                                 class="col-6"
                                            >
                                                <div class="options">
                                                    <input required
                                                           type="radio"
                                                           name="select[]"
                                                           v-model="form.answers"
                                                           :value="answer"
                                                           :key="answer.answer"
                                                           :id="
                                                            'option-' +
                                                            answer.id
                                                        "
                                                    />
                                                    <label
                                                        :for="
                                                            'option-' +
                                                            answer.id
                                                        "
                                                        :class="
                                                            'option option-' +
                                                            answer.id
                                                        "
                                                    >
                                                        <div class="dot"></div>
                                                        <span>{{
                                                                index + 1
                                                            }}</span>
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
                                @click.prevent="back()"
                                class="blue-button w-100"
                                style="font-size: 24px"
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
                                @click.prevent="next()"
                                class="blue-button w-100"
                                style="font-size: 24px"
                            >
                                <i class="bi bi-arrow-right-circle"></i>
                            </button>
                            <button
                                v-if="
                                form.currentstep ===
                                diagnostic.questions.length + 1
                            "
                                @click.prevent="next()"
                                class="blue-button w-100"
                                style="font-size: 24px"
                            >
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

export default {
    components: {
        AppLayout,
    },
    props: {
        diagnostic: Object,
    },
    mount() {
        // $("#date").data("DateTimePicker").show();
    },

    data() {
        return {
            currenstep: 1,
        };
    },

    setup(props) {
        const form = reactive({
            errors: [],
            answers: {},
            answer_list: [],
            progress_value: 0,
            currentstep: 1,
        });

        function next() {
            validate();
            if (form.errors.length > 0) {
                return false
            }
            form.currentstep++;
            form.errors = [];
            form.progress_value = ((form.currentstep - 1) * 100) / props.diagnostic.questions.length;
            form.answer_list.push(form.answers);

            if (form.currentstep === props.diagnostic.questions.length + 2) {
                console.log("submitted");
                form.errors = [];
                form.progress_value = 100;
                console.log(form);
                Inertia.post(route('diagnostic.result'), form);
            }
        }

        function validate() {
            console.log('validating...')
            console.log(form.answer_list.length);
            if (Object.keys(form.answers).length === 0) {
                form.errors = []
                return form.errors.push('Select one option')
            }
            form.errors = []
        }

        function start() {
            form.currentstep++;
            form.progress_value = ((form.currentstep - 1) * 100) / props.diagnostic.questions.length;
        }

        function back() {
            form.currentstep--;
            form.errors = [];
            form.progress_value =
                ((form.currentstep - 1) * 100) /
                props.diagnostic.questions.length;
            form.answer_list.pop(form.answers);
        }

        return {form, start, next, back};
    },
}
;
</script>
