<template lang="html">
  <div class="subPage" id="events">
    <header class="resourceHeader">
      <h4>Eventos</h4>
    </header>
    <b-table
    :data="events"
    :bordered="true"
    :striped="true"
    :paginated="true"
    :per-page="5"
    :pagination-simple="true"
    v-if="events.length > 0"
    default-sort="title">
      <template slot-scope="props">
        <b-table-column field="name" label="Nome" sortable width="200">
          <router-link :to="{ name: 'event', params: { id: props.row.id } }">{{ props.row.title }}</router-link>
        </b-table-column>
        <b-table-column field="inscriptions_end" label="Inscrições" sortable>
          {{ parseDate(props.row.inscriptions_start) }} à {{ parseDate(props.row.inscriptions_end) }}
        </b-table-column>
        <b-table-column field="inscriptions_end" label="Duração" sortable>
          {{ parseDate(props.row.event_start) }} à {{ parseDate(props.row.event_end) }}
        </b-table-column>
        <b-table-column field="inscriptions" label="Inscritos" sortable width="32">
          {{ props.row.inscriptions.length }}
        </b-table-column>
      </template>
    </b-table>
    <router-link class="" tag="button" :to="{ name: 'create', query: { target: 'event' } }">Criar</router-link>
  </div>
</template>

<script>
import { privateEvents } from '../../routes/api'
import { getHeader } from '../../routes/auth'
import parseDate from '../../mixins/parseDate'
export default {
  name: 'users',
  mixins: [parseDate],
  data () {
    return {
      events: []
    }
  },
  mounted () {
    this.getEvents()
  },
  methods: {
    /**
    * generalFunction
    * @author Eduardo Reis Nobre
    * @arg {integer} arg1: just a integer arg
    * @arg {integer} arg2: just a second integer arg
    * @return {integer} the return of the function, type must be {null} if doesn't have a return
    * @version * optional, required only if is a major function
    * @requires * optional
    * @todo * optional
    * @see * optional
    */
    getEvents () {
      this.$http.get(privateEvents, {
        headers: getHeader()
      }).then(response => {
        this.events = response.data
      }, error => {
        console.log(error)
      })
    }
  }
}
</script>
