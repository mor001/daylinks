import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from './pages/Home';
import Login from './pages/Login';
import User from './pages/User';
import Detail from './pages/ScheduleDetail';

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
        //if (!Store.getters.isLogin) {
        if (!localStorage.isLogin) {
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