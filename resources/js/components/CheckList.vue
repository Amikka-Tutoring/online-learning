<template>
    <div class="header-menu">
        <ul>
            <li @click="checklist = !checklist">Checklist <i class="pl-2 blue-text fas"
                                                             v-bind:class="checklist ? 'fa-arrow-up' : 'fa-arrow-down'"></i>
            </li>
        </ul>
        <ul v-show="checklist">
            <collapse-transition>
                <li>
                    <div class="step-one" style="margin-left: 100px">
                        <div class="row" style="">
                            <ol>
                                <li>
                                    <strong class="blue-text">Academic Diagnostic</strong>
                                    <br><br>
                                    Access your strengths and weakness in order to know <span
                                    class="blue-text">what </span>content you need to study.
                                    <br><br>
                                    <a href="">
                                        Start
                                    </a>
                                </li>
                                <li>
                                    <strong class="blue-text">Academic Diagnostic</strong>
                                    <br><br>
                                    Access your strengths and weakness in order to know <span
                                    class="blue-text">what </span>content you need to study.
                                    <br><br>
                                    <a href="">
                                        Start
                                    </a>
                                </li>
                                <li>
                                    <strong class="blue-text">Academic Diagnostic</strong>
                                    <br><br>
                                    Access your strengths and weakness in order to know <span
                                    class="blue-text">what </span>content you need to study.
                                    <br><br>
                                    <a href="">
                                        Start
                                    </a>
                                </li>
                            </ol>
                        </div>
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
    methods: {},

    data() {
        return {
            checklist: false,
        }
    },
}
</script>
