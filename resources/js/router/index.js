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
        },
        {
            path: '/user/login',
            component: () => import ('../pages/user/Login.vue'),
            name: 'user.login'
        },
        {
            path: '/user/registration',
            component: () => import ('../pages/user/Registration.vue'),
            name: 'user.registration'
        },
        {
            path: '/user/personal',
            component: () => import ('../pages/user/Personal.vue'),
            name: 'user.personal'
        },
        {
            path: '/user/index',
            component: () => import ('../pages/user/Index.vue'),
            name: 'user.index'
        }
    ]
});

router.beforeEach( ( to,from,next)  => {
    axios.get('/api/user').catch( e => {
        if (e.response.status === 401){
            localStorage.key('x_xsrf_token') ? localStorage.removeItem('x_xsrf_token') : ''
        }
    });
    const token = localStorage.getItem('x_xsrf_token');

    if (!token){
        if (to.name === 'user.login' || to.name === 'user.registration') {
            return next();
        } else {
            return next({
                name: 'user.login'
            })
        }

        if (to.name === 'user.login' || to.name === 'user.registration' && token) {
            return next({
                name: 'user.personal'
            })
        }
    }
    next()
})
export default router;
