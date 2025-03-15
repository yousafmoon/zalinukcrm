import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { abilitiesPlugin } from '@casl/vue';
import { defineAbilitiesFor } from '@/Pages/Services/ability';
import ToastPlugin from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-bootstrap.css';

const appName = import.meta.env.VITE_APP_NAME || 'Zalinukcrm';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        const role = props.auth && props.auth.user ? props.auth.user.role : 'Guest';  
        const abilities = defineAbilitiesFor(role);
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ToastPlugin)
            .use(abilitiesPlugin, abilities)  
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
