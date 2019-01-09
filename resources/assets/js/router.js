import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from './components/Home'
import Login from './components/Login'
import User from './components/User'

Vue.use(VueRouter);

const routes = [
    { path: '/', component: Home, meta: { requiresAuth: true } },
    { path: '/login', component: Login },
    { path: '/user', component: User, meta: { requiresAuth: true } }
];

const router = new VueRouter({
    mode: 'history',
    routes
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (state.isLogin === false) {
            next({
                path: '/login',
                query: { redirect: to.fullPath }
            })
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router;