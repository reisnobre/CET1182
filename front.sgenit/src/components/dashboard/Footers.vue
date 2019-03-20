<template lang="html">
  <div class="subPage" id="footers">
    <header class="resourceHeader">
      <h4>Rodapés</h4>
    </header>
    <div class="" v-for="footer in footers">
      <h5>{{ footer.title }}</h5>
      <img :src="footer.url" alt="" >
      <hr>
    </div>
    <router-link tag="button" :to="{ name: 'create', query: { target: 'footer' } }">Criar</router-link>
  </div>
</template>

<script>
import { footers } from '../../routes/api'
import { getHeader } from '../../routes/auth'
export default {
  name: 'footers',
  data () {
    return {
      footers: []
    }
  },
  mounted () {
    this.getFooters()
  },
  methods: {
    getFooters () {
      this.$http.get(footers, {
        headers: getHeader()
      }).then(response => {
        this.footers = response.data
      }, error => {
        console.log(error)
      })
    }
  }
}
</script>
