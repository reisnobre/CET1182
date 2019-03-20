import Vibrant from 'node-vibrant'
import swatches from '../components/dashboard/create/Swatches'
export default{
  data () {
    return {
      swatches: null
    }
  },
  computed: {
  },
  methods: {
    /**
    * @name makeSwatch
    * @author Eduardo Reis Nobre
    * @arg imgUrl: {String} to be inject on Vibrant instance.
    * @arg logo: {Boolean} @default {false}, It's a preDefTheme of a logo sent by the user
    * @desc Generate a palette of colors based on a given image that is a imgUrl @arg, send the generated
    * swatches to the creationStore
    */
    makeSwatch (imgUrl, logo = false) {
      let vibrant = new Vibrant(imgUrl)
      vibrant.getPalette(() => {
        let swatches = vibrant.swatches()
        // if (logo) this.palette = swatches
        return swatches
      }).then(swatches => {
        this.swatches = swatches
      })
    }
  },
  components: {
    swatches
  }
}
