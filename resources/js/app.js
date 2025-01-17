import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp, Head, Link } from "@inertiajs/vue3";
import { ZiggyVue } from '../../vendor/tightenco/ziggy'
import Layout from "../js/Layout/Layout.vue";

createInertiaApp({
    title: (title) => `My App | ${title}`, // add My App in start of title
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        let page = pages[`./Pages/${name}.vue`];
        page.default.layout = page.default.layout || Layout;
        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component("Head", Head) //
            .component("Link", Link) // globally import Head and Link
            .mount(el);
    },
});
