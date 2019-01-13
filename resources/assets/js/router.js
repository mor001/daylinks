import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from './components/Home';
import Login from './components/Login';
import User from './components/User';
import Detail from './components/ScheduleDetail';

import Store from './store';

Vue.use(VueRouter);

const routes = [
    { path: '/', component: Home, meta: { requiresAuth: true } },
    { path: '/detail/:year/:month/:day', component: Detail, meta: { requiresAuth: true } },
    { path: '/login', component: Login },
    { path: '/user', component: User, meta: { requiresAuth: true } }
];

const router = new VueRouter({
    mode: 'history',
    routes
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!Store.getters.isLogin) {
            next({
                path: '/login',
                query: { redirect: to.fullPath }
            })
        } else {
            next()
        }
    } else {
        next()
    }
});

export default router;