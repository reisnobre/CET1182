<template lang="html">
  <div class="subPage" id="templates">
    <header class="resourceHeader">
      <h4>Templates</h4>
    </header>
    <b-table
    :data="templates"
    :bordered="true"
    :striped="true"
    :paginated="true"
    :per-page="5"
    :pagination-simple="true"
    v-if="templates.length > 0"
    default-sort="title">
      <template slot-scope="props">
        <b-table-column field="title" label="Titulo" sortable width="200">
          <router-link :to="{ name: 'template', params: { id: props.row.id } }">{{ props.row.title }}</router-link>
        </b-table-column>
        <b-table-column field="description" label="Descrição">
          {{ props.row.description }}
        </b-table-column>
      </template>
    </b-table>
    <router-link class="" tag="button" :to="{ name: 'create', query: { target: 'template' } }">Criar</router-link>
  </div>
</template>

<script>
import { templates } from '../../routes/api'
import { getHeader } from '../../routes/auth'
export default {
  name: 'templates',
  data () {
    return {
      templates: []
    }
  },
  mounted () {
    this.getTemplates()
  },
  methods: {
    getTemplates () {
      this.$http.get(templates, {
        headers: getHeader()
      }).then(response => {
        this.templates = response.data
      }, error => {
        console.log(error)
      })
    }
  }
}
</script>
