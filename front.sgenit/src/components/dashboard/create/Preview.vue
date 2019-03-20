<template lang="html">
  <div class="subPage" id="preview" v-if="eventStore.title">
    <header class="previewHeader">
      <img :src="eventStore.banner.url" alt="">
      <h4 title="Previa de como seu evento será sua pagina de inscrição" :style="{ color: resolvePrimary().getBodyTextColor() }">Prévia</h4>
      <h5 :style="{ color: resolvePrimary().getBodyTextColor() }">De {{ eventStore.eventDates.start }} a {{ eventStore.eventDates.end }}</h5>
    </header>
    <div class="previewBody" :style="{}">
      <h2>{{ eventStore.title }}</h2>
      <p><strong :style="{}">Inscrições:</strong> de {{ eventStore.inscriptionDates.start }} a {{ eventStore.inscriptionDates.end }}</p>
      <p>{{ eventStore.description }}</p>
      <button type="button" name="button" :style="{ background: resolveCrude().getHex(), color: resolveCrude().getBodyTextColor() }" class="__disabled" title="Prévia">Inscreva-se</button>
      <button class="" type="button" name="button" @click="createEvent()">Registrar Evento</button>
      <div class="workshop" v-for="(workshop, index) in eventStore.workshops" :key="index">
        <h5 class="__hasSubtitle">{{ workshop.title }}</h5>
        <span class="__small __opaque"> {{ workshop.workshopDay.split('to').join('a') }} </span>
        <div class="__box">
          <p class="">{{ workshop.description }}</p>
          <span class="__small __opaque __right" style="display: block">Carga horária: {{ workshop.hours }} horas</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { events } from '../../../routes/api'
import { getHeader } from '../../../routes/auth'
import { mapState } from 'vuex'
export default {
  name: 'preview',
  computed: {
    ...mapState({
      eventStore: store => store.eventStore
    })
  },
  methods: {
    /**
    * resolvePrimary
    * @author Eduardo Reis Nobre // Change with your name
    * @desc Try to decide which colors gonna to be used as primary colors
    */
    resolvePrimary () {
      return this.eventStore.swatches.DarkVibrant || this.eventStore.swatches.LightVibrant
    },
    /**
    * resolveSecundary
    * @author Eduardo Reis Nobre // Change with your name
    * @desc Try to decide which colors gonna to be used as secundary colors
    */
    resolveSecundary () {
      return this.eventStore.swatches.DarkMuted || this.eventStore.swatches.LightMuted
    },
    /**
    * resolveCrude
    * @author Eduardo Reis Nobre // Change with your name
    * @desc Try to decide which colors gonna to be used as crude colors
    */
    resolveCrude () {
      return this.eventStore.swatches.Vibrant || this.eventStore.swatches.Muted
    },
    createEvent () {
      let eventData = {
        title: this.eventStore.title,
        siteUrl: this.eventStore.siteUrl,
        description: this.eventStore.description,
        templateId: this.eventStore.template.id,
        inscriptionsStart: this.eventStore.inscriptionDates.start,
        inscriptionsEnd: this.eventStore.inscriptionDates.end,
        eventStart: this.eventStore.eventDates.start,
        eventEnd: this.eventStore.eventDates.end,
        location: this.eventStore.location,
        sponsor: this.eventStore.sponsor,
        edital: this.eventStore.edital,
        workshops: this.eventStore.workshops,
        hoursListener: this.eventStore.hoursListener,
        hoursStaff: this.eventStore.hoursStaff,
        theme: {
          darkMuted: this.eventStore.swatches['DarkMuted'] ? this.eventStore.swatches['DarkMuted'].getHex() : null,
          darkVibrant: this.eventStore.swatches['DarkVibrant'] ? this.eventStore.swatches['DarkVibrant'].getHex() : null,
          lightMuted: this.eventStore.swatches['LightMuted'] ? this.eventStore.swatches['LightMuted'].getHex() : null,
          lightVibrant: this.eventStore.swatches['LightVibrant'] ? this.eventStore.swatches['LightVibrant'].getHex() : null,
          muted: this.eventStore.swatches['Muted'] ? this.eventStore.swatches['Muted'].getHex() : null,
          vibrant: this.eventStore.swatches['Vibrant'] ? this.eventStore.swatches['Vibrant'].getHex() : null
        },
        banner: {
          original_name: this.eventStore.banner.fileName,
          file_base64: this.eventStore.banner.base64
        }
      }
      this.$http.post(events, eventData, {
        headers: getHeader()
      }).then(response => {
        // this.$router.push({ name: 'home' })
      }).then(() => {
        // this.$store.dispatch('destroyEventData')
      }, error => {
        console.log(error)
      })
    }
  }
}
</script>
