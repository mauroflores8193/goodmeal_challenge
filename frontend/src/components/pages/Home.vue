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
import storeApi from "../../api/store-api";

export default {
  name: 'Home',
  components: { Header, StoreCard, Nav },
  data: () => ({ stores: [] }),
  async created() {
    this.stores = await storeApi.getAll()
  }
}
</script>
