import Vue from 'vue';
import VueRouter from 'vue-router';

import UserLayout from './user.vue';
import Home from './pages/Home';
import Login from './pages/Login';
import User from './pages/User';
import Detail from './pages/ScheduleDetail';

import AdminLayout from './admin.vue';
import AdminLogin from './admin/pages/AdminLogin';
import AdminHome from './admin/pages/AdminHome';

import SystemError from './pages/errors/System.vue'
import NotFound from './pages/errors/NotFound.vue'
import store from './store'

Vue.use(VueRouter);

const routes = [
    { path: '/', component: UserLayout,
        children: [
          { path: 'login', component: Login, },
          { path: '', component: Home, meta: { requiresAuth: true }, },
          { path: '/detail/:year/:month/:day', component: Detail, meta: { requiresAuth: true } },
          { path: '/user', component: User, meta: { requiresAuth: true } },

        ],
    },
    { path: '/admin', component: AdminLayout,
        children: [
          { path: 'login', component: AdminLogin, },
          { path: '', component: AdminHome, meta: { requiresAdminAuth: true } },
        ],
     },
    
    { path: '/500',  component: SystemError },
    { path: '/404',  component: NotFound },

];

const router = new VueRouter({
    mode: 'history',
    routes
});

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!store.getters['auth/isLogin']) {
      console.log('[VueRouterでloginにリダイレクト] isLogin: ' + store.getters['auth/isLogin'])
      next({
        path: '/login',
        query: { redirect: to.fullPath }
      })
    } else {
      next()
    }
  } else if (to.matched.some(record => record.meta.requiresAdminAuth)) {
    if (!store.getters['admin/isLogin']) {
      next({
        path: '/admin/login',
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