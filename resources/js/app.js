import { createApp, h } from 'vue'
import { createInertiaApp, Link } from '@inertiajs/vue3'
import AppHead from "@/AppHead.vue";
import LayoutDefault from "./Layouts/LayoutDefault.vue";

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })

        let page = pages[`./Pages/${name}.vue`].default;
        page.layout = LayoutDefault;

        return pages[`./Pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .component("Link", Link)
            .component("AppHead", AppHead)

        app.config.globalProperties.$route = route;

        app.mount(el);
    },
})
