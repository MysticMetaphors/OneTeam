import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import MainLayout from './pages/layout/MainLayout.vue'
import '../css/app.css'
// import '../js/main'

createInertiaApp({
    resolve: name => {
        return import(`./Pages/${name}.vue`).then(module => {
            const page = module.default
            // If no layout specified, use default layout
            if (page.layout === undefined) {
                page.layout = MainLayout;

            }
            return page
        })
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el)
    },
})
