const state = {
  tenantName: null,
  currentYear: null,
  currentMonth: null
}
    
const mutations = {
  setTenantName (state, value) {
    state.tenantName = value
  },
  setCurrentYear (state, y) {
    state.currentYear = y
  },
  setCurrentMonth (state, m) {
    state.currentMonth = m
  }
}
  
const getters = {
  tenantName(state) {
    return state.tenantName;
  },
  currentYear(state) {
    return state.currentYear;
  },
  currentMonth(state) {
    return state.currentMonth;
  },
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