<template lang="html">
  <div class="subPage" id="event" v-if="dashboardStore.event">
    <h4>{{ dashboardStore.event.title }}</h4>
    <p>
      <strong>Inscriçoes: </strong> de {{ parseDate(dashboardStore.event.inscriptions_start) }} à
      {{ parseDate(dashboardStore.event.inscriptions_end) }}
    </p>
    <p>
      <strong>De: </strong> de {{ parseDate(dashboardStore.event.event_start) }} à
      {{ parseDate(dashboardStore.event.event_end) }}
    </p>
    <b-field>
    </b-field>
    <p class="__small">{{ dashboardStore.event.description }}</p>
    <h5>Inscrições</h5>
    <b-table
    :data="dashboardStore.event.inscriptions"
    :bordered="true"
    :striped="true"
    :paginated="true"
    :per-page="5"
    :pagination-simple="true"
    v-if="dashboardStore.event.inscriptions.length > 0"
    default-sort="name">
      <template slot-scope="props">
        <b-table-column field="name" label="Participação" sortable width="16">
          <b-checkbox v-model="props.row.status"></b-checkbox>
        </b-table-column>
        <b-table-column field="name" label="Nome" sortable>
          <router-link :to="{ name: 'inscription', params: { id: props.row.id } }">{{ props.row.name }}</router-link>
        </b-table-column>
        <b-table-column field="area" label="Área" sortable>
          {{ props.row.area }}
        </b-table-column>
        <b-table-column field="institution" label="Instituição" sortable>
          {{ props.row.institution }}
        </b-table-column>
        <!-- <b-table-column field="phone" label="Telefone" sortable width="150">
          {{ props.row.phone }}
        </b-table-column> -->
        <b-table-column field="bond" label="Vínculo" sortable>
          {{ props.row.bond.bond }}
        </b-table-column>
        <b-table-column field="bond" label="Modalidade" sortable>
          {{ props.row.genre.description }}
        </b-table-column>
      </template>
    </b-table>
    <router-link class="btn __hasIcon" :to="{ name: 'editEvent', params: { id: $route.params.id } }">
      <i class="material-icons">&#xE3C9;</i>
      Editar
    </router-link>
    <router-link class="btn __hasIcon" :to="{ name: 'inscriptions', params: {} }">
      <i class="material-icons">&#xE8AD;</i>
      Imprimir Lista
    </router-link>
  </div>
</template>

<script>
import { mapState } from 'vuex'
import { privateEvent } from '../../routes/api'
import { getHeader } from '../../routes/auth'
import parseDate from '../../mixins/parseDate'
export default {
  name: 'event',
  mixins: [parseDate],
  computed: {
    ...mapState({
      dashboardStore: store => store.dashboardStore
    })
  },
  beforeRouteEnter (to, from, next) {
    next($this => {
      if ($this.$route.params.id !== null) next()
      else next({ name: 'overview' })
    })
  },
  mounted () {
    this.getEvent(this.$route.params.id)
  },
  methods: {
    getEvent (id) {
      this.$http.get(privateEvent + `/${id}`, {
        headers: getHeader()
      }).then(response => {
        this.$store.dispatch('setEvent', response.data)
      }, error => {
        console.log(error)
      })
    }
  }
}
</script>
