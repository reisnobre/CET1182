<template lang="html">
  <div class="swatches" v-if="swatches">
    <div class="swatche" v-if="swatches[key] !== null" v-for="(key, index) in Object.keys(swatches)" :style="{background: swatches[key].getHex()}" :key="index">
    </div>
  </div>
</template>

<script>
export default {
  name: 'swatches',
  props: ['swatches']
}
</script>

<style lang="scss">
</style>
