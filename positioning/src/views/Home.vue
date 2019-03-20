<template>
  <div id="home" class="wrapper">
    <!-- <div class="container" id="float"> -->
    <!--   <div v&#45;for="i in gridSize" class="item"> -->
    <!--     <div class="content"> -->
    <!--     </div> -->
    <!--   </div> -->
    <!-- </div> -->
    <hr>
    <div class="container" id="flex">
      <div v-for="i in gridSize" class="item">
        <div class="content">
        </div>
      </div>
    </div>
    <hr>
    <div class="container" id="grid">
      <div v-for="i in gridSize" class="item"></div>
    </div>
  </div>
</template>

<script>

export default {
  name: 'home',
  data () {
    return {
      gridSize: 4
    }
  },
  components: {
  }
}
</script>
