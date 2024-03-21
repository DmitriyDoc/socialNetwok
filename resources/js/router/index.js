import { createRouter, createWebHistory } from 'vue-router';

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/index',
            component: () => import ('../pages/Index.vue')
        },
        {
            path: '/page',
            component: () => import ('../pages/Page.vue')
        }
    ]
});
export default router;
