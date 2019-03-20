<template lang="html">
  <div class="subPage" id="createUser">
    <form @submit.prevent="createSu()">
      <h4>Criar usuário interno</h4>
      <b-field label="Nome">
        <b-input v-model="name" required></b-input>
      </b-field>
      <b-field label="Email"  :type="state.type">
        <b-input type="email" v-model="email" maxlength="30" required></b-input>
      </b-field>
      <div class="field">
        <label class="label">Cpf</label>
        <p class="control is-clearfix">
          <input v-mask="'###.###.###-##'" type="text" autocomplete="on" class="input" v-model="cpf" required>
        </p>
      </div>
      <b-field label="Senha">
        <b-input v-model="password" type="password" password-reveal required></b-input>
      </b-field>
      <button type="submit" name="button" :class="state.status !== undefined && state.status ? 'success' : 'error' ">Cadastrar</button>
      <b-field label="Erros" type="is-danger" :message="state.erros" v-if="state.erros"></b-field>
    </form>
  </div>
</template>

<script>
import { createSu } from '../../../routes/api'
import { getHeader } from '../../../routes/auth'
import erros from '../../../mixins/handleErros'
export default {
  name: 'createUser',
  mixins: [erros],
  data () {
    return {
      name: 'Alan Azevedo',
      email: 'aapsantos@uesc.br',
      cpf: '032.132.165-46',
      password: '$LSaP$*v',
      state: {
        type: '',
        status: undefined,
        message: '',
        errors: null
      }
    }
  },
  computed: {
  },
  methods: {
    /**
      * createSu
      * @author Eduardo Reis Nobre // Change with your name
      * @arg {integer} arg1: just a integer arg
      * @arg {integer} arg2: just a second integer arg
      * @return {integer} the return of the function, type must be {null} if doesn't have a return
      * @version * optional, required only if is a major function
      * @requires * optional
      * @todo * optional
      * @see * optional
    */
    createSu () {
      let suData = {
        name: this.name,
        email: this.email,
        cpf: this.cpf,
        role: 2,
        password: this.password
      }
      this.$http.post(createSu, suData, {
        headers: getHeader()
      }).then(response => {
        this.$router.push({ name: 'users' })
        this.state.status = true
        this.state.message = 'Registrado'
      }, error => {
        console.log(error)
        this.state.status = false
        this.state.message = 'Error ao Registrar'
      })
    }
  }
}
</script>
