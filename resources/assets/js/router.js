import Vue from 'vue';
import VueRouter from 'vue-router';
import store from './store'

import UserLayout from './layouts/LayoutUser.vue';
import Home from './pages/Home';
import Login from './pages/Login';
import User from './pages/User';
import Detail from './pages/ScheduleDetail';
import Notice from './pages/Notice';
import ForgotPassword from './pages/ForgotPassword';
import ResetPassword from './pages/ResetPassword';

import AdminLayout from './layouts/LayoutAdmin.vue';
import AdminLogin from './admin/pages/AdminLogin';
import AdminHome from './admin/pages/AdminHome';
import AdminUsersList from './admin/pages/AdminUsersList';
import AdminUserForm from './admin/pages/AdminUserForm';
import AdminSchedulesList from './admin/pages/AdminSchedulesList';
import AdminScheduleForm from './admin/pages/AdminScheduleForm';
import AdminReserve from './admin/pages/AdminReserve';

import SystemError from './pages/errors/System.vue'
import NotFound from './pages/errors/NotFound.vue'

Vue.use(VueRouter);

const routes = [
    { path: '/', component: UserLayout,
        children: [
          { path: 'login', component: Login, },
          { path: 'forgot', component: ForgotPassword, },
          { path: 'reset/:token', component: ResetPassword, },
          { path: '', component: Home, meta: { requiresAuth: true }, },
          { path: 'detail/:year/:month/:day', component: Detail, meta: { requiresAuth: true } },
          { path: 'user', component: User, meta: { requiresAuth: true } },
          { path: 'notice', component: Notice, meta: { requiresAuth: true } },

        ],
    },
    { path: '/admin', component: AdminLayout,
        children: [
          { path: 'login', component: AdminLogin, },
          { path: '', name: 'adminHome', component: AdminHome, meta: { requiresAdminAuth: true } },
          { path: 'users/list', component: AdminUsersList, meta: { requiresAdminAuth: true } },
          { path: 'users/form/:userid', component: AdminUserForm, meta: { requiresAdminAuth: true } },
          { path: 'users/form', component: AdminUserForm, meta: { requiresAdminAuth: true } },
          { path: 'schedules/list', component: AdminSchedulesList, meta: { requiresAdminAuth: true } },
          { path: 'schedules/form/:year/:month/:day', component: AdminScheduleForm, meta: { requiresAdminAuth: true } },
          { path: 'reserve', component: AdminReserve, meta: { requiresAdminAuth: true } },
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
    if (!store.getters['user/isLogin']) {
      console.log('[VueRouterでloginにリダイレクト] isLogin: ' + store.getters['user/isLogin'])
      next({
        path: '/login',
        query: { redirect: to.fullPath }
      })
    } else {
      next()
    }
  } else if (to.matched.some(record => record.meta.requiresAdminAuth)) {
    if (!store.getters['admin/isLogin']) {
      console.log('[VueRouterでadmin/loginにリダイレクト] admin/isLogin: ' + store.getters['admin/isLogin'])
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