<template>
  <div class="card p-2 flex flex-col gap-2">
    <div class="relative">
      <img :src="image" class="w-full h-20" alt=""/>
      <PlusCircleIcon class="absolute top-0 right-0 w-8 h-8 text-pink-500 bg-white rounded-full"/>
    </div>
    <div class="flex gap-1 flex-wrap">
      <div class="price">{{ price | formatPrice }}</div>
      <div class="text-sm text-gray-400 text-bold line-through">{{ realPrice | formatPrice }}</div>
    </div>
    <TagDiscount :discount="discount" class="m-auto"/>
    <div class="text-gray-500 text-xs">{{ name }}</div>
  </div>
</template>

<script>
import PlusCircleIcon from '../../assets/images/icons/plus-circle.svg'
import TagDiscount from "../atoms/TagDiscount.vue";

export default {
  name: "ProductCard",
  components: { TagDiscount, PlusCircleIcon },
  props: {
    id: Number,
    name: String,
    image: String,
    price: Number,
    realPrice: Number,
    discount: Number,
  }
}
</script>