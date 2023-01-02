<template>
  <div class="bg-teal-50 px-6 h-full text-sm">
    <Header title="Detalle de la orden" url-back="/orders"/>
    <Card class="py-12">
      <h2 class="text-lg font-medium mb-4">{{ store.name }}</h2>
      <DescriptionItem v-for="(item, index) in infoItems" v-bind="item" :key="index"/>
      <hr class="my-4"/>
      <div class="font-medium">Productos</div>
      <div v-for="(item, index) in order.detail" :key="index" class="flex justify-between">
        <div>{{ item.amount }}</div>
        <div>{{ item.name }}</div>
        <div>{{ item.price | formatPrice }}</div>
      </div>
      <hr class="my-4"/>
      <div class="flex justify-between">
        <div>Delivery</div>
        <div>{{ order.deliveryCost | formatPrice }}</div>
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

export default {
  name: "OrderDetail",
  components: {
    Card,
    Header,
    DescriptionItem,
  },
  data: function () {
    return {
      store: {
        name: 'Fork Bilbao',
        address: 'Av. Francisco Bilbao 2429',
        pickUpTime: '09:00 - 16:00 hrs',
      },
      order: {
        id: '466044',
        pickUpDate: '25/11/22',
        detail: [
          { amount: 2, name: 'Kit XXL', price: 13500 }
        ],
        deliveryCost: 3500,
        total: 30500
      }
    }
  },
  computed: {
    infoItems: function () {
      return [
        { title: 'Dirección:', description: this.store.address },
        { title: 'Horario de retiro:', description: this.store.pickUpTime },
        { title: 'Fecha de retiro:', description: this.order.pickUpDate },
        { title: 'N° de orden:', description: this.order.id },
      ]
    }
  }
}
</script>