<template lang="html">
  <div class="event">
    <h5>{{ event.title }} - </h5>
    <a class="" target="_blank" href="http://nit.uesc.br/wibtec/#/">Site</a>
    <img :src="event.banner_url" alt="">
    <span class="__small">
      Inscrições {{ parseDate(event.inscriptions_start) }} à {{ parseDate(event.inscriptions_end) }}
    </span>
    <p>{{ event.description }}</p>
    <router-link class="btn" :to="{ name: 'singUp', params: { id: event.id } }" replace>Inscreva-se</router-link>
  </div>
</template>

<script>
import moment from 'moment'
export default {
  name: 'event',
  props: ['event'],
  mounted () {
  },
  methods: {
    parseDate (date) {
      return moment(date).format('DD/MM/YYYY')
    }
  }
}
</script>
