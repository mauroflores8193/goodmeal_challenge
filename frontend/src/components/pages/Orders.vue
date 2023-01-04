<template>
  <div class="flex flex-col h-full">
    <Header title="Mis órdenes"/>
    <div class="px-6 flex flex-col gap-4 flex-1 overflow-y-auto">
      <router-link v-for="(order, index) in orders" :key="index" :to="'/order-detail/'+order.id">
        <OrderCard v-bind="order"/>
      </router-link>
    </div>
    <Nav/>
  </div>
</template>

<script>
import Header from "../molecules/Header.vue";
import OrderCard from "../organisms/OrderCard.vue";
import Nav from "../molecules/Nav.vue";
import orderApi from "../../api/order-api";

export default {
  name: "Orders",
  components: { OrderCard, Header, Nav },
  data: () => ({ orders: [] }),
  async created() {
    this.orders = await orderApi.getAll()
  }
}
</script>