import * as CONSTS from '../common/const';

const state = {
  user: null,
  apiStatus: null,
  loginErrorMessages: null
}

const getters = {
  check: state => true,
  username: state => state.user ? state.user.name : '',
  user: state => state.user,
  apiStatus: state => state.apiStatus
}

const computed = {
}

const mutations = {
  setUser(state, user) {
    state.user = user;
  },
  setApiStatus (state, status) {
    state.apiStatus = status
  },
  setLoginErrorMessages (state, messages) {
    state.loginErrorMessages = messages
  }
}

const actions = {
  // ログイン
  async login(context, data) {
    console.log(context)
    context.commit('setApiStatus', null)
    const response = await axios.post('/api/login', data)
    if (response.status === CONSTS.OK) {
      console.log(response)
      const token = 'Bearer ' + response.data.access_token
      
      window.axios.defaults.headers.common['Authorization'] = token;

      localStorage.setItem('token', token)
      localStorage.setItem('isLogin', true)
      //localStorage.setItem('loginUser', JSON.stringify(response.data));
      context.commit('setApiStatus', true)
      context.commit('setUser', response.data)
      return false
    }
    context.commit('setApiStatus', false)
    if (response.status === CONSTS.UNPROCESSABLE_ENTITY) {
      context.commit('setLoginErrorMessages', response.data.errors)
    } else {
      context.commit('error/setCode', response.status, { root: true })
    }
  },

  // ログアウト
  async logout(context) {
    context.commit('setApiStatus', null)
    const response = await axios.get('/api/logout')
    if (response.status === CONSTS.OK) {
      localStorage.removeItem('token')
      localStorage.removeItem('isLogin')
      localStorage.removeItem('loginUser')
      context.commit('setApiStatus', true)
      context.commit('setUser', null)
      return false
    }
    context.commit('setApiStatus', false)
    context.commit('error/setCode', response.status, { root: true })
  },

  // ログインユーザーチェック
  async currentUser(context) {
    context.commit('setApiStatus', null)
    const response = await axios.get('/api/me')
    if (response.status === CONSTS.OK) {
      context.commit('setUser', response.data)
      return response.data
    }
    context.commit('setApiStatus', false)
    context.commit('error/setCode', response.status, { root: true })
  }
}

export default {
  namespaced: true,
  state,
  getters,
  computed,
  mutations,
  actions
}