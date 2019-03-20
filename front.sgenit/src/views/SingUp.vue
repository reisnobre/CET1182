<template lang="html">
  <div class="page" id="singUp" v-if="event">
    <div class="wrapper">
      <header class="previewHeader">
        <img :src="event.banner_url" alt="">
        <h5 :style="{ color: getContrast50(resolvePrimary()) }">{{ parseDate(event.event_start) }} à {{ parseDate(event.event_end) }}</h5>
      </header>
      <div :class="[]" :style="{}">
        <h2>{{ event.title }}</h2>
        <p><strong :style="{}">Inscrições: </strong> {{ parseDate(event.inscriptions_start) }} à {{ parseDate(event.inscriptions_end) }}</p>
        <p>{{ event.description }}</p>
        <form @submit.prevent="registerInscription()" class="innerWrapper">
          <b-field label="Nome Completo" :style="{}">
            <b-input v-model="name" required></b-input>
          </b-field>
          <b-field label="Email" :style="{}">
            <b-input v-model="email" required></b-input>
          </b-field>
          <b-field label="Vínculo com a UESC">
            <b-select placeholder="" v-model="bond" expanded>
              <option :value="bond.id" v-for="(bond, index) in bonds" :key="index">{{ bond.bond }}</option>
            </b-select>
          </b-field>
          <b-field label="Curso ou área de formação" :style="{}">
            <b-input v-model="area" required></b-input>
          </b-field>
          <b-field label="Instituição em que estuda ou trabalha" :style="{}">
            <b-input v-model="institution" required></b-input>
          </b-field>
          <div class="field">
            <label class="label">Telefone</label>
            <p class="control is-clearfix">
              <input v-mask="'(##) # ####-####'" type="text" autocomplete="on" class="input" v-model="phone" required>
            </p>
          </div>
          <hr>
          <h5>Workshops</h5>
          <button type="submit" name="button" :style="{ background: resolveCrude(), color: getContrast50(resolveCrude()) }">Inscreva-se</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { event, bonds, inscriptions } from '../routes/api'
// import { getHeader } from '../routes/auth'
import parseDate from '../mixins/parseDate'
export default {
  name: 'singUp',
  mixins: [parseDate],
  data () {
    return {
      name: 'Eduardo Reis Nobre',
      email: 'eduardo.reisnobre@gmail.com',
      area: 'Ciência da Computação',
      institution: 'Universidade Estadual de Santa Cruz',
      phone: '(73) 9 8229-4939',
      event: null,
      bonds: [],
      bond: 1
    }
  },
  beforeMount () {
    this.getEvent()
    this.getBonds()
  },
  methods: {
    registerInscription () {
      let inscriptionData = {
        name: this.name,
        email: this.email,
        bond: this.bond,
        area: this.area,
        institution: this.institution,
        phone: this.phone,
        eventId: this.$route.params.id
      }
      console.log(inscriptionData)
      this.$http.post(inscriptions, inscriptionData).then(response => {
        console.log(response)
      }).then(() => {
      }, error => {
        console.log(error)
      })
    },
    getEvent () {
      this.$http.get(event + `/${this.$route.params.id}`).then(response => {
        this.event = response.data
      }, error => {
        console.log(error)
      })
    },
    getBonds () {
      this.$http.get(bonds).then(response => {
        this.bonds = response.data
      }, error => {
        console.log(error)
      })
    },
    resolvePrimary () {
      return this.event.theme.dark_vibrant || this.event.theme.light_vibrant
    },
    resolveSecundary () {
      return this.event.theme.dark_muted || this.event.theme.light_muted
    },
    resolveCrude () {
      return this.event.theme.vibrant || this.event.theme.muted
    },
    getContrast50 (hexcolor) {
      return (parseInt(hexcolor, 16) > 0xffffff / 2) ? 'black' : 'white'
    }
  }
}
</script>
