require('./bootstrap');

// Import modules...
import {createApp, h} from 'vue';
import {App as InertiaApp, plugin as InertiaPlugin} from '@inertiajs/inertia-vue3';
import {InertiaProgress} from '@inertiajs/progress';
import AOS from 'aos';
import 'aos/dist/aos.css';


// import CollapseTransition from '@ivanv/vue-collapse-transition';

const el = document.getElementById('app');

createApp({
    created() {
        AOS.init()
    },
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
})
    .mixin({methods: {route}})
    .use(InertiaPlugin)
    .mount(el);

InertiaProgress.init({color: '#4B5563'});
