export default {
  data () {
    return {
      files: null,
      dataURL: null
    }
  },
  watch: {
    files (newVal, oldVal) {
      this.addFile(newVal[0])
    }
  },
  methods: {
    /**
    * @name addFile
    * @author Eduardo Reis Nobre
    * @arg e: {Object} , @event {change} html5 default behaviour on input of files
    * @desc grab this and saves in $that so you don't loose your scope on the futher function,
    * prevent the default behaviour  of the event and then gets the file {Object}
    * generate an url to get to the file and sends to a canvas that is center the image and them generate a data url
    * to be used later, and then remove the canvas element.
    */
    addFile (file) {
      let $that = this
      /* eslint-disable no-new */
      /* eslint-disable no-undef */
      let image = new Image()
      image.src = window.URL.createObjectURL(file)
      image.onload = function () {
        let canvas = document.createElement('CANVAS')
        let ctx = canvas.getContext('2d')
        let dataURL = null
        canvas.height = this.height
        canvas.width = this.width
        let x = (canvas.width - this.width) * 0.5 // this = image loaded
        let y = (canvas.height - this.height) * 0.5
        ctx.drawImage(this, x, y)
        dataURL = canvas.toDataURL('image/png')
        $that.dataURL = dataURL
        canvas = null
      }
    }
  }
}
