import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import MainLayout from './Pages/layout/MainLayout.vue'
import '../css/app.css'
import { ZiggyVue } from 'ziggy-js'
// import '../js/main'

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
            // If no layout specified, use default layout
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
            app.mount(el)
    },
})
