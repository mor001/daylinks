import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from './pages/Home';
import Login from './pages/Login';
import User from './pages/User';
import Detail from './pages/ScheduleDetail';
import SystemError from './pages/errors/System.vue'
import store from './store'

Vue.use(VueRouter);

const routes = [
    { path: '/:year/:month', name: 'home', component: Home, meta: { requiresAuth: true } },
    { path: '/home/:year/:month', component: Home, meta: { requiresAuth: true } },
    { path: '/detail/:year/:month/:day', component: Detail, meta: { requiresAuth: true } },
    { path: '/login', component: Login },
    { path: '/user', component: User, meta: { requiresAuth: true } },
    { path: '/500',  component: SystemError }
];

const router = new VueRouter({
    mode: 'history',
    routes
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!store.getters['auth/isLogin']) {
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