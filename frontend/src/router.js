import Vue from "vue";
import VueRouter from 'vue-router'

import Home from './components/pages/Home.vue'
import OrderDetail from "./components/pages/OrderDetail.vue"

Vue.use(VueRouter)

const routes = [
  { path: '/', name: "home", component: Home },
  { path: '/order-detail', component: OrderDetail },
  { path: '/orders', component: Home },
]

const router = new VueRouter({
  mode: "history",
  routes
});

export default router;