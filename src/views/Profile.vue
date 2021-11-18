<template>
  <div class="upload-box">
    <h4>Logged as: {{this.$store.state.user.name}}</h4>
    <br />
    Lai pievienotu JSON failu nepieciešams to augšupielādēt.
    <br />
    <input type="file" @change="onFileSelected">
    <br />
    <br />
    <button @click="onUpload">Mainīt</button>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: "Profile",
  data: function (){
    return {
      file: null
    }
  },
  created: function () {
    if(!this.$store.state.isAuthorized){
      this.$router.push('/login')
    }
  },
  methods: {
    onFileSelected: function (event) {
        this.file = event.target.files[0]
        console.log(this.file);
    },
    onUpload: function (){
      const fd = new FormData()
      fd.append('json', this.file, this.file.name)
      axios.post("http://127.0.0.1:8000/api/upload_json", fd).then(response =>{
        console.log(response)
      })
    }
  }
}
</script>