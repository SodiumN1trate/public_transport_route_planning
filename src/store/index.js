import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    error: null,
    user: null,
    isAuthorized: false
  },
  getters: {

  },
  mutations: {
    auth_success: function (state, user) {
      state.user = user
      state.isAuthorized = true
    },
    auth_error: function (state, error) {
      state.error = error
    }
  },
  actions: {
    login: function (context, form) {
      return new Promise((resolve, reject) => {
        axios.post('http://127.0.0.1:8000/api/login', form).then(response => {
          if(response.data.user){
            const user = response.data.user
            context.commit('auth_success', user)
          }
          else{
            const error = response.data.error
            context.commit('auth_error', error)
          }
          resolve(response)
        }).catch(err => {
          reject(err)
        })
      })
    },
    countUp: function (context) {
      context.commit('countUp')
    }
  },
  modules: {
  }
})
