<template>
  <div>

    <div class="title">
      <h1>Hoku maps</h1>
      <p>Maršruta plānošana</p>
    </div>

    <div id="route-select-box">
      <form @submit.prevent="getRoutes"  id="route-select-box-content">
        <label>Izvēlieties no kurienes:</label>
        <br />
        <select name="location">
          <option>Izvēlieties pieturu...</option>
          <option v-for="(stop, id) of orderStops" :key="id">{{ stop.name }}</option>
        </select>
        <br />
        <br />
        <label>Izvēlieties uz kurieni:</label>
        <br />
        <select  name="destination">
          <option>Izvēlieties pieturu...</option>
          <option v-for="(stop, id) of orderStops" :key="id">{{ stop.name }}</option>
        </select>
        <br />
        <br />
        <button>Meklēt</button>
      </form>
    </div>
    <template v-if="results">
      <template v-if="results.length > 0">
        <h3 style="margin-top: 3%">Maršrutu saraksts</h3>
        <div id="results-box">
          <div id="results-box-content">
            <ul v-for="(result, id) of results" :key="id">
              <h3>{{ id+1 }}. maršruts</h3>
              <li v-for="(stop, id) of result" :key="id" v-bind:style="{color: stop.color }">{{ stop.name }} - {{ stop.transport_name }}. {{ stop.transport_type }}</li>
            </ul>
          </div>
        </div>
      </template>
      <h3 style="margin-top: 3%" v-else>Nevar atrast maršrutu</h3>
    </template>

  </div>
</template>

<script>
import axios from 'axios'
import _ from 'lodash'
export default {
  name: 'Home',
  data: function (){
    return {
      allStops: null,
      results: null,
      location_stop: null,
      destination_stop: null
    }
  },
  created: function () {
    // Get all stops from API
    axios.get("http://127.0.0.1:8000/api/stops").then((response) => {
      this.allStops = response.data.data

    })
  },
  computed: {
    orderStops: function () {
      return _.orderBy(this.allStops, 'name')
    }
  },
  methods: {
    getRoutes: function (form){
      this.storeUserStops(form.target.elements.location.value, 1)
      this.storeUserStops(form.target.elements.destination.value, 2)
      axios.get(`http://127.0.0.1:8000/api/routes/${this.location_stop['id']}/${this.destination_stop['id']}`).then(response =>{
        this.results = response.data
      })

    },
    storeUserStops: function (name, which){
      this.allStops.forEach(stop =>{
        if(stop['name'] === name){
          if(which === 1){
            this.location_stop = {
              "id": stop['id'],
              "name": name
            }
          }
          else if(which === 2){
            this.destination_stop = {
              "id": stop['id'],
              "name": name
            }
          }
        }
      })
    }

  }
}
</script>

<style>
#route-select-box {
  margin-top: 4%;
}

#route-select-box-content {
  margin-right: auto;
  margin-left: auto;
  border: 2px solid #2c3e50;
  border-radius: 10px;
  padding: 2%;
}

#results-box, #route-select-box {
  margin-top: 1%;
  display: flex;
  justify-content: center;
}

#results-box-content {
  padding-right: 2%;
  border: 2px solid #2c3e50;
  border-radius: 10px;
  display: flex;
  flex-direction: row;
  justify-content: center;

}

</style>