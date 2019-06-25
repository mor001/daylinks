const state = {
  staff: null,
  token: null,
  isLogin: false,
  tenantName: null,
  currentYearSchedule: null,
  currentMonthSchedule: null,
  currentYearReserve: null,
  currentMonthReserve: null,
}

const getters = {
  token: state => state.token,
  staffname: state => state.staff ? state.staff.name : '',
  staff: state => state.staff,
  isLogin: state => state.isLogin,
  tenantName: state => state.tenantName,
  currentYearSchedule: state => state.currentYearSchedule,
  currentMonthSchedule: state => state.currentMonthSchedule,
  currentYearReserve: state => state.currentYearReserve,
  currentMonthReserve: state => state.currentMonthReserve,
}

const computed = {

}

const mutations = {
  setStaff (state, staff) {
    state.staff = staff;
  },
  setToken (state, token) {
    state.token = token
  },
  setIsLogin (state, islogin) {
    state.isLogin = islogin
  },
  setTenantName (state, value) {
    state.tenantName = value
  },
  setCurrentYearSchedule (state, y) {
    state.currentYearSchedule = y
  },
  setCurrentMonthSchedule (state, m) {
    state.currentMonthSchedule = m
  },
  setCurrentYearReserve (state, y) {
    state.currentYearReserve = y
  },
  setCurrentMonthReserve (state, m) {
    state.currentMonthReserve = m
  },

}

const actions = {
  // ログイン
  async login(context, data) {
    context.commit('error/setCode', null, { root: true })
    context.commit('error/setMessage', '', { root: true })
    await window.axios.post('/api/admin/login', data)
    .then(function (response) {
      if(response.data.login) {
        const token = 'Bearer ' + response.data.access_token
        window.axios.defaults.headers.common['Authorization'] = token;
        localStorage.setItem('token', token)
        context.commit('appdata/setTenantName', response.data.tenant, { root: true }) 
        context.commit('setStaff', response.data.user)
        context.commit('setToken', token)
        context.commit('setIsLogin', true)
      } else {
        context.commit('appdata/setTenantName', null, { root: true })
        context.commit('setStaff', null)
        context.commit('setToken', null)
        context.commit('setIsLogin', false)
        context.commit('error/setMessage', 'ログインに失敗しました。ID、パスワードをご確認ください。', { root: true })
      }
    })
  },

  // ログアウト
  async logout(context) {
    await window.axios.get('/api/admin/logout')
    .finally( () => {
      window.axios.defaults.headers.common['Authorization'] = null;
      localStorage.removeItem('token')
      context.commit('appdata/setTenantName', null, { root: true })
      context.commit('setStaff', null)
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