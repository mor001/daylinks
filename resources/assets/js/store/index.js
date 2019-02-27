import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from "vuex-persistedstate";
import auth from './auth'
import error from './error'

Vue.use(Vuex)

const store = new Vuex.Store({
  modules: {
    auth,
    error
  },
  plugins: [createPersistedState({
    key: 'DayLinks',
    paths: ['auth.user', 'auth.token', 'auth.isLogin'],
    storage: window.localStorage
  })]
})

export default store