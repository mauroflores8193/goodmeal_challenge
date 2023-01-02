<template>
  <Card class="py-2 flex items-center">
    <div class="flex-1">
      <div class="text-xl text-teal-500 font-bold mb-4">{{ pickUpDate }}</div>
      <DescriptionItem v-for="(item, index) in infoItems" v-bind="item" :key="index"/>
    </div>
    <router-link :to="'/order-detail/'+id">
      <ArrowRightCircleIcon class="w-7 h-7 text-gray-200"/>
    </router-link>
  </Card>
</template>

<script>
import DescriptionItem from "../molecules/DescriptionItem.vue"
import Card from "../molecules/Card.vue";
import ArrowRightCircleIcon from "../../assets/images/icons/arrow-right-circle.svg"

export default {
  name: "OrderCard",
  components: { Card, DescriptionItem, ArrowRightCircleIcon },
  props: {
    id: Number,
    storeName: String,
    total: Number,
    pickUpTime: String,
    pickUpDate: String,
  },
  computed: {
    infoItems: function () {
      return [
        { title: 'Tienda:', description: this.storeName },
        { title: 'N° de orden:', description: this.id },
        { title: 'Monto total:', description: this.total },
        { title: 'Horario:', description: this.pickUpTime },
      ]
    }
  }
}
</script>