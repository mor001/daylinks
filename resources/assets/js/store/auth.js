const state = {

}
const getters = {

}
const computed = {

}
const mutations = {

}
const actions = {
  // ログイン
  async login(context, data) {
    context.commit('error/setCode', null, { root: true })
    context.commit('error/setMessage', '', { root: true })
    await window.axios.post('/api/login', data)
    .then( (response) => {
      if(response.data.login) {
        const token = 'Bearer ' + response.data.access_token
        window.axios.defaults.headers.common['Authorization'] = token;
        //localStorage.setItem('user', JSON.stringify(response.data.user))
        localStorage.setItem('token', token)
        //localStorage.setItem('isLogin', true)
        context.commit('appdata/setTenantName', response.data.tenant, { root: true }) 
        context.commit('user/setUser', response.data.user, { root: true }) // state.userに値をセット
        context.commit('user/setToken', token, { root: true })
        context.commit('user/setIsLogin', true, { root: true })
      } else {
        context.commit('appdata/setTenantName', null, { root: true })
        context.commit('user/setUser', null, { root: true })
        context.commit('user/setToken', null, { root: true })
        context.commit('user/setIsLogin', false, { root: true })
        context.commit('error/setMessage', 'ログインに失敗しました。ID、パスワードをご確認ください。', { root: true })
      }
    })
  },

  // ログアウト
  async logout(context) {
    await window.axios.get('/api/logout')
    .finally( () => {
      window.axios.defaults.headers.common['Authorization'] = null;
      localStorage.removeItem('token')
      context.commit('appdata/setTenantName', null, { root: true })
      context.commit('user/setUser', null, { root: true })
      context.commit('user/setToken', null, { root: true })
      context.commit('user/setIsLogin', false, { root: true })
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