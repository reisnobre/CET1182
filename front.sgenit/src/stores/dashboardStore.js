const state = {
  event: null
}

const mutations = {
  SET_EVENT (state, event) {
    state.event = event
  }
}

const actions = {
  setEvent: ({ commit }, event) => {
    commit('SET_EVENT', event)
  }
}

export default {
  state,
  mutations,
  actions
}
