<template lang="html">
  <div class="subPage">
    <form @submit.prevent="updateInscription()" class="innerWrapper" v-if="inscription">
      <b-field label="Nome Completo" :style="{}">
        <b-input v-model="inscription.name" disabled></b-input>
      </b-field>
      <b-field label="Email" :style="{}">
        <b-input v-model="inscription.email" disabled></b-input>
      </b-field>
      <b-field label="Vínculo com a UESC">
        <b-select placeholder="" v-model="inscription.bond_id" expanded disabled>
          <option :value="bond.id" v-for="(bond, index) in bonds" :key="index">{{ bond.bond }}</option>
        </b-select>
      </b-field>
      <b-field label="Modalidade">
        <b-select placeholder="" v-model="inscription.genre_id" expanded>
          <option :value="genre.id" v-for="(genre, index) in genres" :key="index">{{ genre.description }}</option>
        </b-select>
      </b-field>
      <b-field label="Curso ou área de formação" :style="{}">
        <b-input v-model="inscription.area" disabled></b-input>
      </b-field>
      <b-field label="Instituição em que estuda ou trabalha" :style="{}">
        <b-input v-model="inscription.institution" disabled></b-input>
      </b-field>
      <div class="field">
        <label class="label">Telefone</label>
        <p class="control is-clearfix">
          <input v-mask="'(##) # ####-####'" type="text" autocomplete="on" class="input" v-model="inscription.phone" disabled>
        </p>
      </div>
      <button type="submit" name="button">Atualizar Inscrição</button>
    </form>
  </div>
</template>

<script>
import { inscription, genres, bonds } from '../../routes/api'
import { getHeader } from '../../routes/auth'
export default {
  name: 'inscription',
  data () {
    return {
      inscription: null,
      genres: [],
      bonds: []
    }
  },
  beforeMount () {
    this.getInscription()
    this.getGenres()
    this.getBonds()
  },
  methods: {
    getInscription () {
      this.$http.get(inscription + `/${this.$route.params.id}`, {
        headers: getHeader()
      }).then(response => {
        this.inscription = response.data
      }, error => {
        console.log(error)
      })
    },
    getGenres () {
      this.$http.get(genres, {
        headers: getHeader()
      }).then(response => {
        this.genres = response.data
      }, error => {
        console.log(error)
      })
    },
    getBonds () {
      this.$http.get(bonds, {
        headers: getHeader()
      }).then(response => {
        this.bonds = response.data
      }, error => {
        console.log(error)
      })
    },
    updateInscription () {
      let inscriptionData = {
        name: this.inscription.ame,
        email: this.inscription.email,
        bond: this.inscription.bond,
        area: this.inscription.area,
        institution: this.inscription.institution,
        phone: this.inscription.phone,
        eventId: this.inscription.event_id,
        genreId: this.inscription.genre_id
      }
      this.$http.post(inscription + `/${this.$route.params.id}`, inscriptionData, {
        headers: getHeader()
      }).then(response => {
        this.getInscription()
      }).then(() => {
        this.$router.push({ name: 'event', params: { id: this.inscription.event_id } })
      }, error => {
        console.log(error)
      })
    }
  }
}
</script>
