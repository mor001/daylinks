const state = {
  user: null,
  token: null,
  isLogin: false,
  unread_notice: 0,
}

const getters = {
  token: state => state.token,
  username: state => state.user ? state.user.name : '',
  user: state => state.user,
  isLogin: state => state.isLogin,
  unread_notice: state => state.unread_notice,
}

const computed = {

}

const mutations = {
  setUser (state, user) {
    state.user = user;
  },
  setToken (state, token) {
    state.token = token
  },
  setIsLogin (state, islogin) {
    state.isLogin = islogin
  },
  setUnreadNotice (state, unread_notice) {
    state.unread_notice = unread_notice
  }
}

const actions = {
}

const methods = {

}

export default {
  namespaced: true,
  state,
  getters,
  computed,
  mutations,
  actions,
  methods
}