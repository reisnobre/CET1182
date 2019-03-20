import Vue from 'vue'
import Vuex from 'vuex'
import userStore from './stores/userStore'
import eventStore from './stores/eventStore'
import dashboardStore from './stores/dashboardStore'

Vue.use(Vuex)
const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
  modules: {
    userStore,
    eventStore,
    dashboardStore
  },
  strict: debug
})
Vue.use(Vuex)
