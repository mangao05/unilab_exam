// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import Vuex from 'vuex'
import axios from 'axios'
import { Form, HasError, AlertError } from 'vform'
import {store} from './store/index'


import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'


Vue.config.productionTip = false


window.Form = Form
window.axios = axios


Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.use(Vuex)

axios.defaults.baseURL = 'http://127.0.0.1:8000/api/'
/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  components: { App },
  template: '<App/>'
})
