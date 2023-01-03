<template>
  <div class="flex flex-col h-full text-sm">
    <div class="px-6">
      <Header :title="name" url-back="/"/>
    </div>
    <StoreHeader :icon="icon" :banner="banner"/>
    <div class="px-6 py-2 flex flex-col gap-4">
      <div class="font-medium">Acerca de la tienda</div>
      <div class="flex items-center gap-1">
        <div class="w-6">
          <MarkerIcon class="w-6 h-6"/>
        </div>
        <a href="#" target="_blank" class="text-pink-600 underline leading-6">{{ location }}</a>
      </div>
      <div class="flex items-center gap-1">
        <div class="w-6">
          <ClockIcon class="w-4 h-4 m-auto"/>
        </div>
        <div>Horario de retiro: {{ attentionHours }}</div>
      </div>
      <div class="flex items-center gap-2">
        <div class="font-medium">Calificación</div>
        <StarIcon class="w-4 h-4 text-pink-500"/>
        <div>{{ score }} / 5.0</div>
      </div>
    </div>
    <div class="grid grid-cols-3 gap-x-px gap-y-2 text-sm flex-1 overflow-y-auto px-6">
      <ProductCard v-for="(product, index) in products" :key="index" v-bind="product"/>
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

export default {
  name: "StoreDetail",
  components: { ProductCard, StoreHeader, Header, ClockIcon, MarkerIcon, StarIcon },
  data: function () {
    return {
      name: 'GoodMeal Market',
      icon: 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ab/Logo_TV_2015.png/200px-Logo_TV_2015.png',
      banner: 'https://cdn.pixabay.com/photo/2017/03/22/12/14/easter-nest-2164822_960_720.jpg',
      attentionHours: 'Hoy 09:00 - 21:00 hrs',
      location: 'Av nueva los leones 50, Providencia, Santiago, (Caracol los leones) Zona de delivery Store central',
      latitude: '',
      longitude: '',
      score: 4.4,
      products: [
        { id: 1, name: 'Pack 10 mix almendras pasas y maníi', image: 'https://thumbs.dreamstime.com/z/gourmet-meal-2431449.jpg', price: '4000', discount: 50, realPrice: '8000' },
        { id: 1, name: 'Pack 10 mix almendras pasas y maníi', image: 'http://www.theglutengal.com/wp-content/uploads/2008/09/8-12-08-square-meal.jpg', price: '4000', discount: 50, realPrice: '8000' },
        { id: 1, name: 'Pack 10 mix almendras pasas y maníi', image: 'https://miro.medium.com/max/1400/1*sNhk33H9Te79RJqBuYxBsQ.jpeg', price: '4000', discount: 50, realPrice: '8000' },
        { id: 1, name: 'Pack 10 mix almendras pasas y maníi', image: 'https://thumbs.dreamstime.com/z/plated-pork-main-meal-gourmet-square-white-plate-63563837.jpg', price: '4000', discount: 50, realPrice: '8000' },
        { id: 1, name: 'Pack 10 mix almendras pasas y maníi', image: 'https://www.foodnavigator-usa.com/var/wrbm_gb_food_pharma/storage/images/publications/food-beverage-nutrition/foodnavigator-usa.com/article/2022/01/14/the-meal-plan-from-the-future-squareat-gives-new-meaning-to-square-meals/13156569-1-eng-GB/The-meal-plan-from-the-future-SquarEat-gives-new-meaning-to-square-meals.jpg', price: '', discount: 50 },
        { id: 1, name: 'Pack 10 mix almendras pasas y maníi', image: 'https://media-cldnry.s-nbcnews.com/image/upload/newscms/2021_34/1765653/squareat-inline-02-khu-210825.png', price: '', discount: 50 },
      ]
    }
  }
}
</script>