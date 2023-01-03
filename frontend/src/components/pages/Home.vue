<template>
  <div class="flex flex-col h-full">
    <Header title="Inicio"/>
    <div class="px-6 flex flex-col gap-4 flex-1 overflow-y-auto">
      <router-link :to="'/store/'+store.id" v-for="(store, index) in stores" :key="index">
        <StoreCard v-bind="store"/>
      </router-link>
    </div>
    <Nav/>
  </div>
</template>

<script>
import Nav from "../molecules/Nav.vue";
import StoreCard from "../organisms/StoreCard.vue";
import Header from "../molecules/Header.vue";

export default {
  name: 'Home',
  components: { Header, StoreCard, Nav },
  data: function () {
    return {
      stores: [
        {
          storeName: 'GoodMeal Market',
          banner: 'https://cdn.pixabay.com/photo/2017/03/22/12/14/easter-nest-2164822_960_720.jpg',
          attentionHours: 'Hoy 09:00 - 21:00 hrs',
          deliveryType: 'Retiro o delivery',
          icon: 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ab/Logo_TV_2015.png/200px-Logo_TV_2015.png',
          minProductPrice: 4500,
          minProductOldPrice: 9000,
          distanceTime: '45 min',
          distanceKm: '3.83 km',
          ordersCount: 11,
          isFavorite: true,
          id: 12345
        },
        {
          storeName: 'Natural King',
          banner: 'https://cdn.pixabay.com/photo/2017/07/23/16/01/nature-2531761__340.jpg',
          attentionHours: 'Hoy 09:00 - 21:00 hrs',
          deliveryType: 'Retiro o delivery',
          icon: 'https://www.shutterstock.com/image-vector/square-logo-design-vector-blue-260nw-706178086.jpg',
          minProductPrice: 4500,
          minProductOldPrice: 9000,
          distanceTime: '6 min',
          distanceKm: '0,51 km',
          ordersCount: 3,
          isFavorite: false,
          id: 12346
        }
      ]
    }
  }
}
</script>
