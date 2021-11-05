<template>
  <div id="app">
    <form @submit.prevent="getFormValues">
      <input type="text" name="location">
      <input type="text" name="destination">
      <button>Meklēt</button>
    </form>
    <h1>Lokācija: {{ location }}</h1>
    <h1>Galamērķis: {{ destination }}</h1>
    <h1>{{ transports }}</h1>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'App',
  data: function () {
    return {
      location: "",
      destination: "",
      transports: []
    }
  },
  methods: {
    getFormValues: function (submitEvent) {
      this.location = submitEvent.target.elements.location.value;
      this.destination = submitEvent.target.elements.destination.value;
      axios.get("http://127.0.0.1:8000/api/transports").then((response) =>{
        this.transports = response.data.data;
      })
    }
  }
}
</script>

<style>

</style>
