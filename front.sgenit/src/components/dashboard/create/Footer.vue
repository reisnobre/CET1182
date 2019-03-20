<template lang="html">
  <div class="subPage" id="createTemplate">
    <form @submit.prevent="dataURL ? createFooter() : false">
      <h4>Registrar Rodapé</h4>
      <b-field label="Titulo">
        <b-input value="" required v-model="title"></b-input>
      </b-field>
      <label class="label">Arquivo</label>
      <b-field>
        <b-upload v-model="files" accept="image/*">
          <span class="button is-primary" required>
            <b-icon icon="file_upload"></b-icon>
            <span>Clique aqui para submeter seu arquivo</span>
          </span>
        </b-upload>
        <div v-if="files && files.length">
          <span class="file-name">
            {{ files[0].name }}
          </span>
        </div>
      </b-field>
      <button type="submit" name="button" :class="state.status !== undefined && state.status ? 'success' : 'error' ">Cadastrar</button>
      <b-field label="Erros" type="is-danger" :message="state.message" v-if="state.message.length > 0"></b-field>
    </form>
  </div>
</template>

<script>
import { footers } from '../../../routes/api'
import { getHeader } from '../../../routes/auth'
import erros from '../../../mixins/handleErros'
import fileReader from '../../../mixins/fileReader'
export default {
  name: 'createFooter',
  mixins: [erros, fileReader],
  data () {
    return {
      title: null,
      state: {
        type: '',
        status: undefined,
        message: [],
        errors: null
      }
    }
  },
  methods: {
    /**
    * createTemplate
    * @author Eduardo Reis Nobre // Change with your name
    * @arg {integer} arg1: just a integer arg
    * @arg {integer} arg2: just a second integer arg
    * @return {integer} the return of the function, type must be {null} if doesn't have a return
    * @version * optional, required only if is a major function
    * @requires * optional
    * @todo * optional
    * @see * optional
    */
    createFooter () {
      let footerData = {
        title: this.title,
        original_name: this.files[0].name,
        file_base64: this.dataURL.split(',')[1]
      }
      this.$http.post(footers, footerData, {
        headers: getHeader()
      }).then(response => {
        this.$router.push({ name: 'footers' })
      }, error => {
        console.log(error)
      })
    },
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
        if (this.width === 1500 && this.height === 160) {
          let x = (canvas.width - this.width) * 0.5 // this = image loaded
          let y = (canvas.height - this.height) * 0.5
          ctx.drawImage(this, x, y)
          dataURL = canvas.toDataURL('image/png')
          $that.dataURL = dataURL
        } else {
          $that.state.message.push('Imagem de tamanho incorreto')
          setTimeout(() => {
            $that.files = null
            $that.state.message = []
          }, 3000)
        }
        canvas = null
      }
    }
  }
}
</script>
