<template lang="html">
  <div class="workshop">
    <b-field label="Titulo">
      <b-input v-model="workshop.title" required></b-input>
    </b-field>
    <b-field label="Descrição">
      <b-input maxlength="200" type="textarea" v-model="workshop.description" style="min-height: 70px;" required></b-input>
    </b-field>
    <div class="columns">
      <div class="column">
        <div class="field datePickerWrapper">
          <label class="label">Data do Workshop</label>
          <span class="control is-clearfix">
            <transition name="fade" mode="out-in">
              <date-picker placeholder="Escolha uma data"
                :config="{
                  dateFormat: 'd/m/Y',
                  static: false,
                  minDate: eventStart,
                  maxDate: eventEnd,
                  wrap: true,
                  clickOpens: false,
                  mode: 'range'
                }"
                ref="datePickerWorkshop"
                v-model="workshop.workshopDay"
                @input="$refs.datePickerWorkshop.selectedDates = $event.split('to').join('a')"
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
      <div class="column">
        <b-field label="Carga Horária">
          <b-input v-model="workshop.hours" required></b-input>
        </b-field>
      </div>
    </div>
  </div>
</template>

<script>
import datePicker from '../../../../mixins/datePicker'
export default {
  name: 'workshop',
  props: ['workshop', 'eventStart', 'eventEnd'],
  mixins: [datePicker],
  data () {
    return {}
  }
}
</script>
