<template>
  <div>
    <StarIcon class="w-7 h-7 text-pink-500" v-if="active" />
    <StarOutLinedIcon class="w-7 h-7" v-if="!active"/>
  </div>
</template>

<script>
import StarIcon from '../../assets/images/icons/heart.svg'
import StarOutLinedIcon from '../../assets/images/icons/heart-outlined.svg'

export default {
  name: "FavoriteButton",
  props: {
    active: Boolean
  },
  components: { StarIcon, StarOutLinedIcon }
}
</script>