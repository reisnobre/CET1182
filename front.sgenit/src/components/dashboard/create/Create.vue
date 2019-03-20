<template lang="html">
  <div class="subPage" id="create">
    <transition name="fade" mode="out-in">
      <component :is="target || resolveTarget()" @target="target = $event"></component>
    </transition>
  </div>
</template>

<script>
import translate from '../../../mixins/translate'
import createUser from './User'
import createEvent from './Event'
import createTemplate from './Template'
import createFooter from './Footer'
import preview from './Preview'
export default {
  name: 'create',
  data () {
    return {
      target: null
    }
  },
  mixins: [translate],
  // beforeRouteEnter (to, from, next) {
  //   next($this => {
  //     if (Object.keys($this.$route.query).length) next()
  //     else next({ name: 'dashboard' })
  //   })
  // },
  methods: {
    resolveTarget () {
      let target = this.$route.query.target
      if (target === 'user') return 'createUser'
      else if (target === 'event') return 'createEvent'
      else if (target === 'template') return 'createTemplate'
      else if (target === 'footer') return 'createFooter'
    }
  },
  components: {
    createUser,
    createEvent,
    createTemplate,
    createFooter,
    preview
  }
}
</script>
