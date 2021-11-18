<template>
  <div>
    <form  @submit.prevent="getUserCredentials" class="login-box">
      <h1>Admin page</h1>
      <input type="text" name="name" v-model="form.name" placeholder="Lietotājvārds" required><br/><br/>
      <input type="password" name="password" v-model="form.password" placeholder="Parole" required><br/><br/>
      <button>Ieiet</button>
    </form>
<!--    <h3>{{ this.$store.state.user }}</h3>-->
<!--    <h3 v-if="this.$store.state.errorMessage">Kļūda: {{ this.$store.state.errorMessage }}</h3>-->
<!--    <h3>{{ this.$store.getters.checkIsAuthenticated }}</h3>-->
    <h3>{{ this.$store.state.error }}</h3>
  </div>
</template>

<script>
export default {
  name: "Login",
  data: function (){
    return {
      form: {
        username: "",
        password: ""
      }
    }
  },
  methods: {
    getUserCredentials: function (){
      this.$store.dispatch('login', this.form).then(() => {
        if(this.$store.state.user){
          this.$router.push('/admin')
        }
      })
    },
  }
}
</script>

<style scoped>
h3 {
  color: #db4444;
}
</style>