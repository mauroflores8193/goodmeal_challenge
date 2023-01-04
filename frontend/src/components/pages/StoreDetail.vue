<template>
  <div class="flex flex-col h-full text-sm">
    <div class="px-6">
      <Header :title="store.name" url-back="/"/>
    </div>
    <StoreHeader :icon="store.icon" :banner="store.banner"/>
    <div class="px-6 py-2 flex flex-col gap-4">
      <div class="font-medium">Acerca de la tienda</div>
      <div class="flex items-center gap-1">
        <div class="w-6">
          <MarkerIcon class="w-6 h-6"/>
        </div>
        <a
            :href="`https://www.google.com/maps/@${store.latitude},${store.longitude},16.5z`"
            target="_blank"
            class="text-pink-600 underline leading-6"
        >{{ store.location }}</a>
      </div>
      <div class="flex items-center gap-1">
        <div class="w-6">
          <ClockIcon class="w-4 h-4 m-auto"/>
        </div>
        <div>Horario de retiro: {{ attentionHours }}</div>
      </div>
      <div class="flex items-center gap-1">
        <div class="font-medium">Calificación</div>
        <StarIcon class="w-4 h-4 text-pink-500"/>
        <div>{{ store.score }} / 5.0</div>
      </div>
    </div>
    <div class="grid grid-cols-3 gap-x-px gap-y-2 text-sm overflow-y-auto px-6">
      <ProductCard v-for="(product, index) in store.products" :key="index" v-bind="product"/>
    </div>
  </div>
</template>

<script>
import Header from "../molecules/Header.vue";
import StoreHeader from "../organisms/StoreHeader.vue";
import MarkerIcon from '../../assets/images/icons/marker.svg'
import ClockIcon from '../../assets/images/icons/clock.svg'
import StarIcon from '../../assets/images/icons/star.svg'
import ProductCard from "../organisms/ProductCard.vue";
import storeApi from "../../api/store-api";

export default {
  name: "StoreDetail",
  components: { ProductCard, StoreHeader, Header, ClockIcon, MarkerIcon, StarIcon },
  data: () => ({ store: {} }),
  async created() {
    this.store = await storeApi.get(this.$route.params.id)
  },
  computed: {
    attentionHours() {
      return `Hoy ${this.store.startTime} - ${this.store.endTime}`
    }
  }
}
</script>