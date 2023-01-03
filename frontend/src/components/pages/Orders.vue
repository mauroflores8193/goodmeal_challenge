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

export default {
  name: "Orders",
  components: { OrderCard, Header, Nav },
  data: function () {
    return {
      orders: [
        {
          id: 466044,
          storeName: 'Fork Bilbao',
          total: 30500,
          pickUpTime: '09:00 - 16:00 hrs',
          pickUpDate: '25/11/22',
        },
        {
          id: 466044,
          storeName: 'Fork Bilbao',
          total: 30500,
          pickUpTime: '09:00 - 16:00 hrs',
          pickUpDate: '25/11/22',
        }
      ]
    }
  }
}
</script>