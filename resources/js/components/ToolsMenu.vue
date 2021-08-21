<template>
    <div class="header-menu">
        <ul>
            <li @click="next = !next">Next <i class="pl-2 blue-text fas" v-bind:class="next ? 'fa-arrow-up' : 'fa-arrow-down'"></i></li>
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
                                        <span class="ml-2 badges gray-badge">Strategy</span><span class="ml-2 badges gray-badge">All</span>
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
                                        <span class="ml-2 badges gray-badge">Strategy</span><span class="ml-2 badges gray-badge">All</span>
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
                                        <span class="ml-2 badges gray-badge">Strategy</span><span class="ml-2 badges gray-badge">All</span>
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
            <li @click="tools = !tools">Tools <i class="pl-2 blue-text fas" v-bind:class="tools ? 'fa-arrow-up' : 'fa-arrow-down'"></i></li>
            <collapse-transition>
            <li v-if="tools">
                <div class="tools">
                    <div class="row">
                        <div class="col-3">
                            <div class="notes-circle rounded-circle"><i class="fas fa-question"></i></div>
                        </div>
                        <div class="col-3">
                            <div class="notes-circle rounded-circle"><i class="fas fa-pen"></i></div>
                        </div>
                        <div class="col-3">
                            <div class="notes-circle rounded-circle"><i class="fas fa-flag"></i></div>
                        </div>
                        <div class="col-3">
                            <div class="notes-circle rounded-circle"><i class="fas fa-microphone-alt"></i></div>
                        </div>
                    </div>
                    <textarea placeholder="Notes..." name="" id="" cols="25" rows="10"></textarea>
                    <button>Submit</button>
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

    },

    data() {
        return {
            next: false,
            tools: false
        }
    },
}
</script>
