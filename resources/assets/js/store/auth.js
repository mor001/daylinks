const state = {
  user: {},
  token: null,
  isLogin: false
}

const getters = {
  user(state) {
    return state.user;
  },
  token(state) {
    return state.token; 
  },
  isLogin(state) {
    return state.isLogin;
  }
}

const mutations = {
  setUser(state, user) {
    state.user = user;
  },
  setToken(state, token) {
    state.token = token;
  },
  setLogin(state, login) {
    state.isLogin = login;
  }
}

const actions = {
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}