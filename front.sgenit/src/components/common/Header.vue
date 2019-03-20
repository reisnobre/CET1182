<template lang="html">
  <header id="mainHeader">
    <nav class="wrapper" id="desktopNav">
      <ul>
        <li>
          <router-link :to="{ name: 'home', params: {} }">Início</router-link>
        </li>
        <!-- <li>
          <router-link :to="{ name: '', params: {} }">Eventos</router-link>
        </li> -->
        <li>
          <router-link :to="{ name: authUser ? 'overview' : 'login', params: {} }">Área Restrita</router-link>
        </li>
      </ul>
    </nav>
  </header>
</template>

<script>
import { mapState } from 'vuex'
export default {
  name: 'vueHeader',
  computed: {
    ...mapState({
      authUser: store => store.userStore.authUser
    })
  }
}
</script>
