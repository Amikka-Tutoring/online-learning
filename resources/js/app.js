require("./bootstrap");

// Import modules...
import {createApp, h} from "vue";
import {
    App as InertiaApp,
    plugin as InertiaPlugin,
} from "@inertiajs/inertia-vue3";
import {InertiaProgress} from "@inertiajs/progress";
import AOS from "aos";
import "aos/dist/aos.css";
import moment from "moment";
import Toast from "vue-toastification";
import {useToast} from "vue-toastification";
import VueCtkDateTimePicker from 'vue-ctk-date-time-picker';
import 'vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css';

// Import the CSS or use your own!
import "vue-toastification/dist/index.css";

const el = document.getElementById("app");
const toast = useToast();
const options = {
    transition: "Vue-Toastification__fade",
    newestOnTop: true
};

createApp({
    created() {
        AOS.init();
    },
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
}).component('VueCtkDateTimePicker', VueCtkDateTimePicker)
    .mixin({
        methods: {route},
        data() {
            return {
                toast: useToast(),
            }
        }

    }).use(InertiaPlugin, moment)
    .use(Toast, options)
    .use(toast)
    .mount(el);

InertiaProgress.init({color: "#4B5563"});
