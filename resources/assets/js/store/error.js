const state = {
  code: null
}
  
const mutations = {
  setCode (state, code) {
    state.code = code
  }
}

const getters = {
  code(state) {
    return state.code;
  }
}

export default {
  namespaced: true,
  state,
  mutations
}