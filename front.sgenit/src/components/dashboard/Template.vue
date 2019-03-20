<template lang="html">
  <div class="subPage" id="template" v-if="template">
    <h4>{{ template.title }}</h4>
    <p>{{ template.description }}</p>
    <img :src="template.footer_image.url" alt="">
  </div>
</template>

<script>
import { template } from '../../routes/api'
import { getHeader } from '../../routes/auth'
export default {
  name: 'template',
  data () {
    return {
      template: null,
      footer: null
    }
  },
  beforeRouteEnter (to, from, next) {
    next($this => {
      if ($this.$route.params.id !== null) next()
      else next({ name: 'templates' })
    })
  },
  mounted () {
    this.getTemplate(this.$route.params.id)
  },
  methods: {
    getTemplate (id) {
      this.$http.get(template + `/${id}`, {
        headers: getHeader()
      }).then(response => {
        this.template = response.data
      }, error => {
        console.log(error)
      })
    }
  }
}
</script>

<style lang="css">
</style>
