<template>
  <div id="app">
    <div class="container">
      <div class="row gx-5">
        <div class="col align-self-center">
          <img width="200px" alt="memorar logo" src="./assets/logo.png">
          <Formulario class="mt-5" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Formulario from './components/Formulario.vue'

export default {
  name: 'App',
  components: {
    Formulario
  }
}
</script>

<style>
  #app {
    font-family: 'Work Sans', sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 60px;
  }
</style>
