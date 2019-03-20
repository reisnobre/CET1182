<template lang="html">
  <div class="subPage" id="users">
    <header class="resourceHeader">
      <h4>Usuários</h4>
    </header>
    <b-table
    :data="users"
    :bordered="true"
    :striped="true"
    :paginated="true"
    :per-page="5"
    :pagination-simple="true"
    v-if="users.length > 0"
    default-sort="name">
      <template slot-scope="props">
        <b-table-column field="name" label="Nome" sortable width="200">
          <router-link :to="{ name: 'user', params: { id: props.row.id } }">{{ props.row.name }}</router-link>
        </b-table-column>
        <b-table-column field="email" label="Email" sortable width="200">
          {{ props.row.email }}
        </b-table-column>
        <b-table-column field="role" label="Tipo de Usuário" sortable width="200">
          {{ props.row.role.description }}
        </b-table-column>
      </template>
    </b-table>
    <router-link tag="button" :to="{ name: 'create', query: { target: 'user' } }">Criar</router-link>
  </div>
</template>

<script>
import { users } from '../../routes/api'
import { getHeader } from '../../routes/auth'
export default {
  name: 'users',
  data () {
    return {
      users: []
    }
  },
  mounted () {
    this.getUsers()
  },
  methods: {
    getUsers () {
      this.$http.get(users, {
        headers: getHeader()
      }).then(response => {
        this.users = response.data
      }, error => {
        console.log(error)
      })
    }
  }
}
</script>
