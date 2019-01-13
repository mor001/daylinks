import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    user: {},
    isLogin: false
  },
  mutations: {
    setUser(state, user) {
      state.user = user;
    },
    setLogin(state, login) {
      state.isLogin = login;
    }
  },
  getters: {
    user(state) {
      return state.user;
    },
    isLogin(state) {
      return state.isLogin;
    }
  }
});