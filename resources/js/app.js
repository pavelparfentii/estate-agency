import './bootstrap';

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import MainComponent from "./Pages/Layouts/MainComponent.vue";
import { ZiggyVue } from "ziggy";
import '../css/app.css'


createInertiaApp({
    resolve: async (name) => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });
        const page = await pages[`./Pages/${name}.vue`];
        page.default.layout = page.default.layout || MainComponent;
        return page
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el)
    },
})
