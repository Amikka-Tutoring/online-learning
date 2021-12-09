<template>
    <app-layout>
        <div class="container">
            <calculator v-if="diagnostic.name=='Mathematics'"/>
            <template v-if="form.currentstep != 1 && form.currentstep != diagnostic.length">
                <div
                    class="row justify-content-center align-items-center"
                    style="margin-bottom: 50px; margin-top: -20px"
                >
                    <div v-if="diagnostic.content.link" class="blue-text" v-on:click="showFrame"><img
                        src="/images/messenger.png"
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
                <!--                <reading-diagnostic v-if="diagnostic.name=='Reading'"/>-->
                <!--                <grammar-diagnostic v-if="diagnostic.name=='Grammar'"/>-->
            </template>
            <div>
                <form class="form" method="POST">
                    <div v-if="form.currentstep === 1" class="first-step">
                        <h1>
                            {{ diagnostic.name }}
                            Diagnostic
                        </h1>
                        <div class="step-one" style="margin-left: 100px">
                            <div class="row" style="">
                                <ol>
                                    <li>The {{ diagnostic.diagnostic.name }} Diagnostic
                                        helps us access your
                                        strengths and weaknesses in order to
                                        maximize your score.
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
                                    <iframe id="frame" :src="diagnostic.content.link" type="application/pdf"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-for="(question, index) in diagnostic.questions">
                        <div v-if="form.currentstep === index + 2"
                             class="row w-100 m-0 justify-content-center flex-column align-items-center">
                            <div class="col-12">
                                <p class="quiz-question-box" v-if="hasFormula(question.title)">
                                    <math-field id="formula" letterShapeStyle="upright"
                                                smart-mode
                                                style="font-size:18px;padding: 3px;border: none;font-family: Inter"
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
                                                           :key="answer.title"
                                                           v-model="form.answers[form.currentstep]"
                                                           :name="form.answers[form.currentstep]"
                                                           :value="answer"
                                                           required
                                                           type="radio"/>
                                                    <label :class="'option option-' +answer.id"
                                                           :for="'option-' +answer.id">
                                                        <div class="dot"></div>
                                                        <span v-if="hasFormula(answer.title)">
                                                            <math-field letterShapeStyle="upright" readOnly="true"
                                                                        smart-mode
                                                                        style="font-size:18px;padding: 0px;border: none; font-family: Inter;">
                                                                {{ removeText(answer.title) }}
                                                            </math-field>
                                                        </span>
                                                        <span v-else>{{ answer.title }}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class=" row justify-content-center">
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
import ReadingDiagnostic from "@/components/ReadingDiagnostic";
import GrammarDiagnostic from "@/components/GrammarDiagnostic";


export default {

    components: {
        AppLayout,
        Question,
        Calculator,
        ReadingDiagnostic,
        GrammarDiagnostic,
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
        hasFormula(text) {
            return text.startsWith('&&&')
        },
        removeText(text) {
            return text.replace('&&&', '')
        }
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
            form.errors = [];
            form.progress_value = ((form.currentstep - 1) * 100) / props.diagnostic.questions.length;
            form.answer_list.push(form.answers);

            if (form.currentstep === props.diagnostic.questions.length + 2) {
                form.errors = [];
                form.progress_value = 100;

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


    }
}
</script>
<style>
iframe {
    width: 100%;
    min-height: 400px;
    height: 100%;
}

.ML__base {
    display: inline !important;
    width: auto !important;
}

.ML__mathlive {
    width: auto !important;
    white-space: normal !important;
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
