<template lang="html">
  <div class="page" id="home">
    <div class="wrapper">
      <section class="" id="hero">

      </section>
      <section class="" id="events">
        <h2>Eventos</h2>
        <div class="innerWrapper">
          <vue-event :event="vEvent" v-for="(vEvent, index) in events" :key="index"></vue-event>
        </div>
      </section>
    </div>
  </div>
</template>

<script>
import { events } from '../routes/api'
// import { getHeader } from '../routes/auth'
import vueEvent from '../components/home/Event.vue'
export default {
  name: 'home',
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
      this.$http.get(events).then(response => {
        this.events = response.data
      }, error => {
        console.log(error)
      })
    }
  },
  components: {
    vueEvent
  }
}
</script>
