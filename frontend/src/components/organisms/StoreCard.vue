<template>
  <div class="bg-white rounded-2xl border-4 border-gray-200">
    <div class="relative">
      <img :src="banner" class="rounded-t-xl h-18 w-full"/>
      <img :src="icon" class="rounded-full absolute -bottom-6 right-8 w-16 h-16 bg-white"/>
      <FavoriteButton :active="isFavorite" class="absolute right-4 top-0" />
      <TagAttentionHours :label="attentionHours" class="absolute left-4 top-2"/>
      <TagDeliveryType :label="deliveryType" class="absolute left-4 bottom-2"/>
    </div>
    <div class="px-4 py-3">
      <div class="font-bold text-xl">{{ storeName }}</div>
      <div class="flex gap-2 mb-1">
        <div class="font-bold text-sm text-pink-600">Desde {{ minProductPrice | formatPrice }}</div>
        <div class="text-sm text-gray-400 text-bold line-through">{{ minProductRealPrice | formatPrice }}</div>
      </div>
      <div class="flex gap-6">
        <div class="flex items-center gap-1">
          <WalkingIcon class="w-5 h-5" />
          <div>{{ distanceTime }}</div>
        </div>
        <div class="flex items-center gap-1 flex-1">
          <MarkerIcon class="w-6 h-6" />
          <div>{{ distanceKm }}</div>
        </div>
        <div class="flex items-center gap-1">
          <div class="text-xl font-bold">{{ ordersCount }}</div>
          <BuyBagIcon class="w-7 h-7" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import WalkingIcon from '../../assets/images/icons/walking.svg'
import MarkerIcon from '../../assets/images/icons/marker.svg'
import BuyBagIcon from '../../assets/images/icons/buy-bag.svg'
import FavoriteButton from "../molecules/FavoriteButton.vue";
import TagDeliveryType from "../atoms/TagDeliveryType.vue";
import TagAttentionHours from "../atoms/TagAttentionHours.vue";

export default {
  name: "StoreCard",
  components: { TagAttentionHours, TagDeliveryType, FavoriteButton, WalkingIcon, MarkerIcon, BuyBagIcon },
  props: {
    storeName: String,
    banner: String,
    attentionHours: String,
    deliveryType: String,
    icon: String,
    minProductPrice: Number,
    minProductRealPrice: Number,
    distanceTime: String,
    distanceKm: String,
    ordersCount: Number,
    isFavorite: Boolean
  }
}
</script>