// import "../css/app.css";
import "./bootstrap";

import { createInertiaApp, Head, Link } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { createApp, h } from "vue";
import { ZiggyVue } from "../../vendor/tightenco/ziggy"; // For name routes

// Vuetify
import "vuetify/styles";
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";
import AppLayout from "./Layouts/AppLayout.vue";
import "@mdi/font/css/materialdesignicons.css";

const savedTheme = localStorage.getItem("theme") || "light";

const vuetify = createVuetify({
    components,
    directives,
    theme: {
        defaultTheme: savedTheme,
    },
});

createInertiaApp({
    title: (title) => `${title}`,
    resolve: async (name) => {
        const page = await resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        );

        // 👇 Apply default layout if not set
        page.default.layout = page.default.layout || AppLayout;

        return page;
    },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(vuetify)
            .component("Head", Head) //For title
            .component("Link", Link) //For link
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
