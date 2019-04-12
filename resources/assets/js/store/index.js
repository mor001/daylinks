import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from "vuex-persistedstate";
import auth from './auth'
import admin from './admin'
import user from './user'
import error from './error'
import appdata from './appdata'
import schedule from './schedule'

Vue.use(Vuex)

const store = new Vuex.Store({
  modules: {
    auth,
    error,
    appdata,
    admin,
    schedule,
    user,
  },
  plugins: [createPersistedState({
    key: 'DayLinks',
    paths: ['appdata.tenantName', 'user.user', 'user.token', 'user.isLogin', 'admin.user', 'admin.isLogin'],
    storage: window.localStorage
  })]
})

export default store