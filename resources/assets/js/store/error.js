const state = {
  code: null,
  message: null
}
  
const mutations = {
  setCode (state, code) {
    state.code = code
  },
  setMessage (state, message) {
    state.message = message
  }
}

const getters = {
  code(state) {
    return state.code;
  },
  //message(state) {
  //  return state.message;
  //}
  message: state => state.message
}

const actions = {
  setError(context, data) {
    context.commit('setCode', data.status)
    context.commit('setMessage', data.data.errors)
  }
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}