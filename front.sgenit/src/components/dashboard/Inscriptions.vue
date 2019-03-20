<template lang="html">
  <div class="subPage" id="printList" v-if="dashboardStore.event">
    <h4>{{ dashboardStore.event.title }} - Lista de Inscritos</h4>
    <b-table
    :data="dashboardStore.event.inscriptions"
    :bordered="true"
    :striped="true"
    :narrowed="true"
    :paginated="false"
    :pagination-simple="true"
    v-if="dashboardStore.event && dashboardStore.event.inscriptions.length > 0"
    default-sort="name"
    class="">
      <template slot-scope="props">
        <b-table-column field="name" label="Nome" width="200">
          {{ props.row.name }}
        </b-table-column>
        <b-table-column field="area" label="Email" width="250">
          {{ props.row.email }}
        </b-table-column>
        <b-table-column field="signature" label="Assinatura">

        </b-table-column>
      </template>
    </b-table>
    <button class="__hasIcon" type="button" name="button" @click="print()">
      <i class="material-icons">&#xE8AD;</i>
      Imprimir
    </button>
  </div>
</template>

<script>
import { mapState } from 'vuex'
export default {
  name: 'inscriptions',
  computed: {
    ...mapState({
      dashboardStore: store => store.dashboardStore
    })
  },
  beforeRouteEnter (to, from, next) {
    next($this => {
      if ($this.dashboardStore.event !== null) next()
      else next({ name: 'events' })
    })
  },
  watch: {
    'dashboardStore.event': function (newVal, oldVal) {
      console.log(newVal)
    }
  },
  methods: {
    print () {
      window.print()
    }
  }
}
</script>
