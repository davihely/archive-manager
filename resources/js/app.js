import { createInertiaApp } from "@inertiajs/vue3";
import { createApp } from "vue";
import { renderApp } from "@inertiaui/modal-vue";
import PrimeVue from "primevue/config";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap-icons/font/bootstrap-icons.css";

createInertiaApp({
    setup({ el, App, props, plugin }) {
        const app = createApp({
            render: renderApp(App, props),
        });

        app.use(plugin).use(PrimeVue).mount(el);
    },
});
