import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from "vuex-persistedstate";
import auth from './auth'
import admin from './admin'
import error from './error'
import appdata from './appdata'

Vue.use(Vuex)

const store = new Vuex.Store({
  modules: {
    auth,
    error,
    appdata,
    admin,
  },
  plugins: [createPersistedState({
    key: 'DayLinks',
    paths: ['appdata.tenantName', 'auth.user', 'auth.token', 'auth.isLogin', 'admin.user', 'admin.isLogin'],
    storage: window.localStorage
  })]
})

export default store