<template lang="html">
  <div class="subPage" id="user" v-if="user">
    <h4>{{ user.name }}</h4>
  </div>
</template>

<script>
import { user } from '../../routes/api'
import { getHeader } from '../../routes/auth'
export default {
  name: 'user',
  data () {
    return {
      user: null
    }
  },
  beforeRouteEnter (to, from, next) {
    next($this => {
      if ($this.$route.params.id !== null) next()
      else next({ name: 'overview' })
    })
  },
  mounted () {
    this.getUser(this.$route.params.id)
  },
  methods: {
    getUser (id) {
      this.$http.get(user, {
        headers: getHeader(),
        params: {
          id: id
        }
      }).then(response => {
        this.user = response.data
      }, error => {
        console.log(error)
      })
    }
  }
}
</script>
