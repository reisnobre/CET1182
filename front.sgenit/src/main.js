import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import './registerServiceWorker'

import axios from 'axios'
import Buefy from 'buefy'
import VueTheMask from 'vue-the-mask'

Vue.use(Buefy)

Vue.use(VueTheMask)
Vue.config.productionTip = false

Vue.prototype.$http = axios

new Vue({
  beforeMount () {
    this.reLogin()
  },
  methods: {
    reLogin () {
      const userObj = JSON.parse(window.localStorage.getItem('authUser'))
      if (userObj) {
        this.$store.dispatch('setAuthUser', userObj)
      }
    }
  },
  router,
  store,
  render: h => h(App)
}).$mount('#app')
