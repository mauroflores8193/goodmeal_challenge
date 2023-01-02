<template>
  <div class="button-icon" :class="{'text-pink-500' : active}">
    <ArticleIcon class="w-10 h-10" v-if="active"/>
    <ArticleOutLinedIcon class="w-10 h-10 text-bg-pink-500" v-if="!active"/>
    <div>Órdenes</div>
  </div>
</template>

<script>
import ArticleIcon from '../../assets/images/icons/article.svg'
import ArticleOutLinedIcon from '../../assets/images/icons/article-outlined.svg'

export default {
  name: "OrdersButton",
  props: {
    active: Boolean
  },
  components: { ArticleIcon, ArticleOutLinedIcon }
}
</script>