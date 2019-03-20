<template lang="html">
  <div class="page" id="dashboard">
    <transition name="slideDown" mode="out-in">
      <header id="dashboardHeader" v-if="$route.name !== 'preview'">
        <nav class="wrapper">
          <ul>
            <li v-if="userStore.authUser.role_id === 1">
              <router-link :to="{ name: 'users'}">Usuários</router-link>
            </li>
            <li>
              <router-link :to="{ name: 'templates' }">Templates</router-link>
            </li>
            <li>
            <router-link :to="{ name: 'events' }">Eventos</router-link>
            </li>
            <li>
              <a @click="logout()">Sair</a>
            </li>
          </ul>
        </nav>
      </header>
    </transition>
    <div :class="['subWrapper']">
      <transition name="fade" mode="out-in">
        <router-view></router-view>
      </transition>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'
export default {
  name: 'dashboard',
  computed: {
    ...mapState({
      userStore: store => store.userStore
    })
  },
  /**
    * beforeRouteEnter
    * @author Eduardo Reis Nobre
    * @description Check before the user get to the screen if there is a logged user
    * if yes let him view this screen, else redirect him to login page
  */
  beforeRouteEnter (to, from, next) {
    next($this => {
      if ($this.userStore.authUser) next()
      else next({ name: 'login' })
    })
  },
  methods: {
    logout () {
      let p = new Promise((resolve, reject) => {
        window.localStorage.removeItem('authUser')
        window.localStorage.removeItem('authTokens')
        this.$router.push({ name: 'home' })
        resolve()
      })
      p.then(() => {
        this.$store.dispatch('destroyAuthUser')
      })
    }
  }
}
</script>
