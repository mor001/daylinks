const state = {
  schedules: null,
  year: null,
  month: null,
}

const mutations = {
  setSchedules (state, schedules) {
    state.schedules = schedules
  },
  setYear (state, year) {
    state.year = year
  },
  setMonth (state, month) {
    state.month = month
  },

}

const getters = {
  schedules: state => state.schedules,
  year: state => state.year,
  month: state => state.month,
}

const actions = {
  async fetchMonthly(context, y, m) {
    let url = '/api/schedule/monthly/' + y + '/' + m
    await window.axios.get(url)
    .then( (response) => {
      context.commit('setSchedules', response.data.schedules)
      context.commit('setYear', response.data.y)
      context.commit('setMonth', response.data.m)
    }).catch( (error) => {
      if(!error.response) {
        context.commit('error/setCode', error.response.status, { root: true })
      }
      context.commit('error/setMessage', 'データの取得に失敗しました。', { root: true })
    }).finally( () => {
    })
  },
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}