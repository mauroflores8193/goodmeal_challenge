<template>
  <div class="bg-teal-50 px-6 h-full text-sm">
    <Header title="Detalle de la orden" url-back="/orders"/>
    <Card class="py-12">
      <h2 class="text-lg font-medium mb-4">{{ order.storeName }}</h2>
      <DescriptionItem v-for="(item, index) in infoItems" v-bind="item" :key="index"/>
      <hr class="my-4"/>
      <div class="font-medium">Productos</div>
      <div v-for="(detail, index) in order.details" :key="index" class="flex justify-between gap-2">
        <div>{{ detail.amount }}</div>
        <div>{{ detail.name }}</div>
        <div>{{ detail.total | formatPrice }}</div>
      </div>
      <hr class="my-4"/>
      <div class="flex justify-between" v-if="order.shippingCost > 0">
        <div>Delivery</div>
        <div>{{ order.shippingCost | formatPrice }}</div>
      </div>
      <div class="flex justify-between">
        <div class="font-medium">Monto total</div>
        <div class="font-medium">{{ order.total | formatPrice }}</div>
      </div>
    </Card>
  </div>
</template>

<script>
import DescriptionItem from "../molecules/DescriptionItem.vue"
import Header from "../molecules/Header.vue";
import Card from "../molecules/Card.vue";
import orderApi from "../../api/order-api";

export default {
  name: "OrderDetail",
  components: {
    Card,
    Header,
    DescriptionItem,
  },
  data: () => ({ order: {} }),
  async created() {
    this.order = await orderApi.get(this.$route.params.id)
  },
  computed: {
    deliveryTime() {
      return `${this.order.deliveryStarTime} - ${this.order.deliveryEndTime} hrs`
    },
    infoItems: function () {
      return [
        { title: 'Dirección:', description: this.order.storeAddress },
        { title: 'Horario de retiro:', description: this.deliveryTime },
        { title: 'Fecha de retiro:', description: this.order.deliveryDate },
        { title: 'N° de orden:', description: this.order.id },
      ]
    }
  }
}
</script>