<template lang="html">
  <div class="subPage" id="createEvent">
    <form @submit.prevent="commitEventData()">
      <h4>Registrar um Evento</h4>
      <h5>Dados básicos</h5>
      <b-field label="Titulo">
        <b-input v-model="title" required></b-input>
      </b-field>
      <div class="columns">
        <div class="column">
          <div class="field datePickerWrapper">
            <label class="label">Periodo de Inscrição</label>
            <span class="control is-clearfix">
              <date-picker placeholder="Escolha uma data" :config="config" ref="datePickerInscription" @input="$refs.datePickerInscription.selectedDates = $event.split('to').join('a')" readonly required>
                <a class="" data-toggle>
                  <i class="material-icons __white">&#xE916;</i>
                </a>
                <a class="" data-clear>
                  <i class="material-icons __white">&#xE14C;</i>
                </a>
              </date-picker>
            </span>
          </div>
        </div>
        <div class="column">
          <div class="field datePickerWrapper">
            <label class="label">Duração do Evento</label>
            <span class="control is-clearfix">
              <transition name="fade" mode="out-in">
                <date-picker placeholder="Escolha uma data"
                  v-if="
                    ($refs.datePickerInscription &&
                    $refs.datePickerInscription.selectedDates &&
                    $refs.datePickerInscription.selectedDates.split(' a ').length > 1)"
                  :config="{
                    dateFormat: 'd/m/Y',
                    static: false,
                    minDate: this.setupDate($refs.datePickerInscription.selectedDates.split(' a ')[1].split('/').join(' ')),
                    wrap: true,
                    clickOpens: false,
                    mode: 'range'
                  }"
                  ref="datePickerEvent"
                  @input="$refs.datePickerEvent.selectedDates = $event.split('to').join('a')"
                readonly required>
                  <a class="" data-toggle>
                    <i class="material-icons __white">&#xE916;</i>
                  </a>
                  <a class="" data-clear>
                    <i class="material-icons __white">&#xE14C;</i>
                  </a>
                </date-picker>
              </transition>
            </span>
          </div>
        </div>
      </div>
      <h5>Detalhes</h5>
      <b-field label="Site">
        <b-input type="url" v-model="siteUrl" required></b-input>
      </b-field>
      <b-field label="Local">
        <b-input v-model="location" required></b-input>
      </b-field>
      <b-field label="Agência Financiadora">
        <b-input v-model="sponsor" placeholder="Preencher apenas se houver uma"></b-input>
      </b-field>
      <b-field label="Edital">
        <b-input v-model="edital" placeholder="001/2000"></b-input>
      </b-field>
      <div class="columns">
        <div class="column">
          <b-field label="Carga Horária - Ouvinte">
            <b-input v-model="hoursListener" required></b-input>
          </b-field>
        </div>
        <div class="column">
          <b-field label="Carga Horária - Organização">
            <b-input v-model="hoursStaff" required></b-input>
          </b-field>
        </div>
      </div>
      <b-field label="Descrição">
        <b-input maxlength="500" type="textarea" v-model="description" required></b-input>
      </b-field>
      <b-field>
        <b-upload v-model="files" accept="image/*">
          <span class="button is-primary" required>
            <b-icon icon="file_upload" class="__white"></b-icon>
            <span>Submeta banner do evento</span>
          </span>
        </b-upload>
        <div v-if="files && files.length">
          <span class="file-name">
            {{ files[0].name }}
          </span>
        </div>
      </b-field>
      <div class="themeWrapper">
        <img :src="dataURL" alt="" v-if="dataURL">
        <swatches v-if="swatches" :swatches="swatches"></swatches>
      </div>
      <hr>
      <h5 class="__hasIcon">Workshops <i class="material-icons" @click="$refs.datePickerInscription.selectedDates ? addWorkshop() : false">&#xE148;</i></h5>
      <transition-group name="slideDown" mode="out-in">
        <workshop :key="index" v-for="(workshop, index) in workshops" :eventStart="$refs.datePickerInscription.selectedDates.split(' a ')[0].split('/').join(' ')" :eventEnd="$refs.datePickerInscription.selectedDates.split(' a ')[1].split('/').join(' ')" :workshop.sync="workshop">
        </workshop>
      </transition-group>
      <hr>
      <b-field label="Template">
        <b-select placeholder="Selecione um template" expanded v-model="selectedIndex" required>
          <option :value="index" v-for="(template, index) in templates" :key="index">{{ template.title }}</option>
        </b-select>
      </b-field>
      <div class="" v-if="selectedIndex !== null">
        <label class="label">{{ templates[selectedIndex].title }}</label>
        <p class="__box">{{ templates[selectedIndex].description }}</p>
        <img :src="templates[selectedIndex].footer_image.url" alt="" v-if="selectedIndex !== null">
      </div>
      <button class="" type="submit" name="button">Vizualizar</button>
    </form>
  </div>
</template>

<script>
import { templates } from '../../../routes/api'
import { getHeader } from '../../../routes/auth'
import { mapState } from 'vuex'
import datePicker from '../../../mixins/datePicker'
import fileReader from '../../../mixins/fileReader'
import swatches from '../../../mixins/swatches'
import workshop from './event/Workshop'
import moment from 'moment'
moment.locale('pt-br')

export default {
  name: 'createEvent',
  mixins: [datePicker, fileReader, swatches],
  data () {
    return {
      title: 'WorkTech',
      description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer egestas vitae enim ac viverra. Donec non quam a orci luctus tincidunt. Fusce ornare, mi ac euismod ornare, tellus tortor condimentum risus, sit amet pretium est erat sed nibh. Sed viverra metus sed nibh eleifend, sed tempus nunc laoreet. Phasellus ultricies, erat vel tincidunt fermentum, diam tellus commodo sem, vitae interdum arcu dolor ac orci. Pellentesque semper sit amet velit eget aliquam.',
      siteUrl: 'http://www.nit.uesc.br/worktech',
      location: 'Universidade Estadual de Santa Cruz - UESC',
      sponsor: 'Fundação de Amparo à Pesquisa do Estado da Bahia – FAPESB-BA',
      edital: '007/2016',
      hoursListener: 16,
      hoursStaff: 60,
      workshops: [],
      templates: [],
      footer: null,
      selectedIndex: null
    }
  },
  computed: {
    ...mapState({
      eventStore: store => store.eventStore
    })
  },
  watch: {
    dataURL (newValue, oldValue) {
      this.makeSwatch(newValue)
    }
  },
  mounted () {
    this.getTemplates()
  },
  beforeDestroy () {
  },
  methods: {
    setup () {
      if (this.eventStore.title) {
        this.title = this.eventStore.title
        this.description = this.eventStore.description
        this.siteUrl = this.eventStore.siteUrl
        this.dataURL = this.eventStore.banner.url
        let p = new Promise((resolve, reject) => {
          if (this.$refs.datePickerInscription.datepicker.selectedDates.length < 2) {
            this.$refs.datePickerInscription.datepicker.selectedDates.push(moment(this.eventStore.inscriptionDates.start, 'DD MM YYYY').format())
            this.$refs.datePickerInscription.datepicker.selectedDates.push(moment(this.eventStore.inscriptionDates.end, 'DD MM YYYY').format())
          }
          this.$refs.datePickerInscription.selectedDates = this.eventStore.inscriptionDates.start + ' a ' + this.eventStore.inscriptionDates.end
          resolve()
        })
        p.then(() => {
          if (this.$refs.datePickerEvent.datepicker.selectedDates.length < 2) {
            this.$refs.datePickerEvent.datepicker.selectedDates.push(moment(this.eventStore.eventDates.start, 'DD MM YYYY').format())
            this.$refs.datePickerEvent.datepicker.selectedDates.push(moment(this.eventStore.eventDates.end, 'DD MM YYYY').format())
            console.log('resolving')
          }
          this.$refs.datePickerEvent.selectedDates = this.eventStore.eventDates.start + ' a ' + this.eventStore.eventDates.end
        })
        // this.selectedIndex = this.eventStore.selectedIndex
        // this.$refs.datePickerInscription.selectedDates = this.eventStore.inscriptionDates.start + ' a ' + this.eventStore.inscriptionDates.end
        // this.$refs.datePickerEvent.selectedDates = this.eventStore.eventDates.start + ' a ' + this.eventStore.eventDates.end
      }
    },
    translate (e) {
      this.$refs.datePickerInscription.selectedDates = e.split('to').join('a')
    },
    getTemplates () {
      this.$http.get(templates, {
        headers: getHeader()
      }).then(response => {
        this.templates = response.data
      }).then(() => {
        this.selectedIndex = 0
      }, error => {
        console.log(error)
      })
    },
    commitEventData () {
      let p = new Promise((resolve, reject) => {
        let eventData = {
          title: this.title,
          description: this.description,
          siteUrl: this.siteUrl,
          template: this.templates[this.selectedIndex],
          selectedIndex: this.selectedIndex,
          location: this.location,
          sponsor: this.sponsor,
          edital: this.edital,
          workshops: this.workshops,
          hoursListener: this.hoursListener,
          hoursStaff: this.hoursStaff,
          inscriptionDates: {
            start: this.$refs.datePickerInscription.selectedDates.split(' a ')[0],
            end: this.$refs.datePickerInscription.selectedDates.split(' a ')[1]
          },
          eventDates: {
            start: this.$refs.datePickerEvent.selectedDates.split(' a ')[0],
            end: this.$refs.datePickerEvent.selectedDates.split(' a ')[1]
          },
          banner: {
            fileName: this.files[0].name,
            url: this.dataURL,
            base64: this.dataURL.split(',')[1]
          },
          swatches: this.swatches
        }
        resolve(eventData)
      })
      p.then(eventData => {
        this.$store.dispatch('setEventData', eventData)
      }).then(() => {
        this.$router.push({ name: 'preview' })
      })
    },
    addWorkshop () {
      let workshop = {
        title: 'Workshop Titulo',
        description: 'Descrição',
        hours: 4,
        workshopDay: null
      }
      this.workshops.push(workshop)
    }
  },
  components: {
    workshop
  }
}
</script>
