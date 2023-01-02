import Vue from 'vue'
import App from './App.vue'
import router from './router'

import './assets/styles/index.css'
Vue.filter("formatPrice", function (value) {
  return new Intl.NumberFormat('es-PE', { style: 'currency', currency: 'USD' }).format(value);
})

new Vue({
  router,
  render: h => h(App)
}).$mount("#app")
