<template>
  <div class="card">
    <StoreHeader :icon="icon" :banner="banner">
      <FavoriteButton :active="isFavorite" class="absolute right-4 top-0" />
      <TagAttentionHours :label="attentionHours" class="absolute left-4 top-2"/>
      <TagDeliveryType :label="deliveryType" class="absolute left-4 bottom-2"/>
    </StoreHeader>
    <div class="px-4 py-3">
      <div class="font-bold text-xl">{{ storeName }}</div>
      <div class="flex gap-2 mb-1">
        <div class="price">Desde {{ minPrice | formatPrice }}</div>
        <div class="old-price">{{ minOldPrice | formatPrice }}</div>
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
import StoreHeader from "./StoreHeader.vue";

export default {
  name: "StoreCard",
  components: { StoreHeader, TagAttentionHours, TagDeliveryType, FavoriteButton, WalkingIcon, MarkerIcon, BuyBagIcon },
  props: {
    storeName: String,
    banner: String,
    attentionHours: String,
    deliveryType: String,
    icon: String,
    minPrice: Number,
    minOldPrice: Number,
    distanceTime: String,
    distanceKm: String,
    ordersCount: Number,
    isFavorite: Boolean
  }
}
</script>