import datePicker from 'vue-bulma-datepicker'
import moment from 'moment'

moment.locale('pt-br')

export default {
  data () {
    return {
      config: {
        dateFormat: 'd/m/Y',
        static: false,
        minDate: moment().format('DD MM YYYY').split(' ').join('/'),
        wrap: true,
        clickOpens: false,
        mode: 'range'
      }
    }
  },
  beforeMount () {
  },
  mounted () {
    // console.log(moment)
  },
  methods: {
    setupDate (date = undefined) {
      return moment(date, 'DD MM YYYY').format('DD/MM/YYYY')
    }
  },
  components: {
    datePicker
  }
}
