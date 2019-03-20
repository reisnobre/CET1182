const state = {
  title: null,
  description: null,
  siteUrl: null,
  template: null,
  location: null,
  sponsor: null,
  edital: null,
  workshops: null,
  hoursListener: null,
  hoursStaff: null,
  inscriptionDates: {
    start: null,
    end: null
  },
  eventDates: {
    start: null,
    end: null
  },
  banner: {
    fileName: null,
    url: null,
    base64: null
  },
  swatches: null
}

const mutations = {
  SET_EVENT_DATA (state, eventData) {
    state.title = eventData.title
    state.description = eventData.description
    state.location = eventData.location
    state.sponsor = eventData.sponsor
    state.edital = eventData.edital
    state.siteUrl = eventData.siteUrl
    state.template = eventData.template
    state.workshops = eventData.workshops
    state.inscriptionDates.start = eventData.inscriptionDates.start
    state.inscriptionDates.end = eventData.inscriptionDates.end
    state.hoursListener = eventData.hoursListener
    state.hoursStaff = eventData.hoursStaff
    state.eventDates.start = eventData.eventDates.start
    state.eventDates.end = eventData.eventDates.end

    state.banner.fileName = eventData.banner.fileName
    state.banner.url = eventData.banner.url
    state.banner.base64 = eventData.banner.base64

    state.swatches = eventData.swatches
  },
  DESTROY_EVENT_DATA (state) {
    state.title = null
    state.description = null
    state.siteUrl = null
    state.template = null

    state.inscriptionDates.start = null
    state.inscriptionDates.end = null

    state.eventDates.start = null
    state.eventDates.end = null

    state.banner.fileName = null
    state.banner.url = null
    state.banner.base64 = null

    state.swatches = null
  }
}

const actions = {
  setEventData: ({ commit }, eventData) => {
    commit('SET_EVENT_DATA', eventData)
  },
  destroyEventData: ({ commit }) => {
    commit('DESTROY_EVENT_DATA')
  }
}

export default {
  state,
  mutations,
  actions
}
