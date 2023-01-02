import Vue from "vue";
import VueRouter from 'vue-router'

import Home from './components/pages/Home.vue'
import OrderDetail from "./components/pages/OrderDetail.vue"
import Orders from "./components/pages/Orders.vue";
import Profile from "./components/pages/Profile.vue";

Vue.use(VueRouter)

const routes = [
  { path: '/', name: "home", component: Home },
  { path: '/orders', component: Orders },
  { path: '/profile', component: Profile },
  { path: '/order-detail/:id', component: OrderDetail },
]

const router = new VueRouter({
  mode: "history",
  routes
});

export default router;