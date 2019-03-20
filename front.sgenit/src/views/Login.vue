<template lang="html">
  <div class="page" id="login">
    <div class="wrapper">
      <form @submit.prevent="handleAuth(login, password)">
        <b-field label="Email">
          <b-input v-model="login" type="email" required></b-input>
        </b-field>
        <b-field label="Senha" :message="state.message" :type="state.status" required>
          <b-input v-model="password" type="password" password-reveal></b-input>
        </b-field>
        <button type="submit" name="button" class="button is-primary">Entrar</button>
      </form>
    </div>
  </div>
</template>

<script>
import { clientId, clientSecret } from '../../env'
import { login as loginUrl, user } from '../routes/api'
import { getHeader } from '../routes/auth'
import { mapState } from 'vuex'
export default {
  name: 'login',
  data () {
    return {
      login: 'admin@admin.com',
      password: 'projeto',
      state: {
        status: null,
        message: ''
      }
    }
  },
  /**
    * beforeRouteEnter
    * @author Eduardo Reis Nobre
    * @description Check before the user get to the screen if there is a logged user
    * if yes redirect to overview scren, else let him enter in this screen
  */
  beforeRouteEnter (to, from, next) {
    next($this => {
      if (!$this.userStore.authUser) next()
      else next({ name: 'overview' })
    })
  },
  computed: {
    ...mapState({
      userStore: store => store.userStore
    })
  },
  methods: {
    /**
      * handleAuth
      * @author Eduardo Reis Nobre
      * @description The function gets the {clientId} and {clientSecret} from the base configuration of the project
      * and the gets the login and password and send to the server for authentication. If the response is 200,
      * then it creates the authTokens on windows.localStorage and then calls the function that handle the login it self.
      * @arg {string} login: @this.login passed though form submission
      * @arg {string} password: @this.password passed though form submission
      * @version 1.0
    */
    handleAuth (login, password) {
      const postData = {
        grant_type: 'password',
        client_id: clientId,
        client_secret: clientSecret,
        username: login,
        password: password,
        scope: ''
      }
      const authTokens = {}
      this.$http.post(loginUrl, postData).then(response => {
        if (response.status === 200) {
          authTokens.access_token = response.data.access_token
          authTokens.refresh_token = response.data.refresh_token
          window.localStorage.setItem('authTokens', JSON.stringify(authTokens))
          this.handleLogin()
        }
      }, error => {
        console.log(error)
      })
    },
    /**
      * handleLogin
      * @author Eduardo Reis Nobre
      * @description Function gets the headers with the token Bearer created @file /src/routes/auth.js
      * and then sends to the server, saves the profile of the token Bearer on the localStorage for
      * session creation and then saves to userStore.
      * @return {null}
      * @version 1.0
    */
    handleLogin () {
      let authUser = {}
      this.$http.get(user, {
        headers: getHeader()
      }).then(response => {
        authUser = response.data
        window.localStorage.setItem('authUser', JSON.stringify(authUser))
        this.$store.dispatch('setAuthUser', response.data)
      }).then(() => {
        this.$router.push({ name: 'overview' })
      }, error => {
        console.log(error)
      })
    }
  }
}
</script>
