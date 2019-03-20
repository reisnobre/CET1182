<template>
  <div id="app">
    <transition name="fade" mode="out-in">
      <router-view :scroll="scroll"></router-view>
    </transition>
  </div>
</template>

<script>
export default {
  name: 'app',
  data () {
    return {
      scroll: 0
    }
  },
  mounted () {
  },
  components: {
  }
}
</script>

<style lang="scss">
  @import "scss/main.scss";
</style>
