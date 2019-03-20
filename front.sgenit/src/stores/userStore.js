const state = {
  authUser: null
}

const mutations = {
  SET_AUTH_USER (state, data) {
    state.authUser = data
  },
  DESTROY_AUTH_USER (state) {
    state.authUser = null
  }
}

const actions = {
  setAuthUser: ({ commit }, data) => {
    commit('SET_AUTH_USER', data)
  },
  destroyAuthUser: ({ commit }) => {
    commit('SET_AUTH_USER')
  }
}

export default {
  state,
  mutations,
  actions
}
