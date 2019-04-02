import * as CONSTS from '../common/const';

const state = {
  user: null,
  token: null,
  isLogin: false
}

const getters = {
  token: state => state.token,
  username: state => state.user ? state.user.name : '',
  user: state => state.user,
  isLogin: state => state.isLogin
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
  }
}

const actions = {
  // ログイン
  async login(context, data) {
    context.commit('error/setCode', null, { root: true })
    context.commit('error/setMessage', '', { root: true })
    await window.axios.post('/api/login', data)
    .then(function (response) {
      if(response.data.login) {
        const token = 'Bearer ' + response.data.access_token
        window.axios.defaults.headers.common['Authorization'] = token;
        //localStorage.setItem('user', JSON.stringify(response.data.user))
        localStorage.setItem('token', token)
        //localStorage.setItem('isLogin', true)
        context.commit('appdata/setTenantName', response.data.tenant, { root: true }) 
        context.commit('setUser', response.data.user) // state.userに値をセット
        context.commit('setToken', token)
        context.commit('setIsLogin', true)
      } else {
        context.commit('appdata/setTenantName', null, { root: true })
        context.commit('setUser', null)
        context.commit('setToken', null)
        context.commit('setIsLogin', false)
        context.commit('error/setMessage', 'ログインに失敗しました。ID、パスワードをご確認ください。', { root: true })
      }
    })
  },

  // ログアウト
  async logout(context) {
    await window.axios.get('/api/logout')
    .then(function (response) {
      window.axios.defaults.headers.common['Authorization'] = null;
      localStorage.removeItem('token')
      context.commit('appdata/setTenantName', null, { root: true })
      context.commit('setUser', null)
      context.commit('setToken', null)
      context.commit('setIsLogin', false)
    })
  },
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