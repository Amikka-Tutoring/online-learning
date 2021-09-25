<template>
    <div>
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
                                    <label :class="'option option-' +answer.id" :for="'option-' +answer.id">
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
</template>


<script>

import {reactive} from "vue";
import {useToast} from "vue-toastification";
import {Inertia} from "@inertiajs/inertia";

export default {
    components: {},
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
    },

    data() {
        return {}
    },
    props: {
        diagnostic: Object,
    },
    mounted(props) {
        console.log('im from component')
        console.log(this.diagnostic);
    },
    setup(props) {
        const form = reactive({
            errors: [],
            answers: {},
            answer_list: [],
            progress_value: 0,
            currentstep: 1,
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
            Inertia.post(route('diagnostic.result'), form);
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
}
</script>
