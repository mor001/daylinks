const state = {
  currentYear: null,
  currentMonth: null
}
    
const mutations = {
  setCurrentYear (state, y) {
    state.currentYear = y
  },
  setCurrentMonth (state, m) {
    state.currentMonth = m
  }
}
  
const getters = {
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