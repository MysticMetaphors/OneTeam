import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import MainLayout from './Pages/layout/MainLayout.vue'
import LoadingOverlay from './Pages/Component/LoadingOverlay.vue'
import '../css/app.css'
import { ZiggyVue } from 'ziggy-js'

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue');
        const path = `./Pages/${name}.vue`;
        const importPage = pages[path];
        if (!importPage) {
            throw new Error(`Unknown page: ${name}`);
        }
        return importPage().then(module => {
            const page = module.default
            if (page.layout === undefined) {
                page.layout = MainLayout;
            }
            return page
        })
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });
            app.use(plugin)
            app.use(ZiggyVue, Ziggy)
            app.config.globalProperties.$route = route
            app.component('LoadingOverlay', LoadingOverlay)
            app.mount(el)
    },
})
