<template>
  <div class="button-icon" :class="{'text-pink-500' : active}">
    <HomeIcon class="w-10 h-10" v-if="active" />
    <HomeOutLinedIcon class="w-10 h-10" v-if="!active"/>
    <div>Inicio</div>
  </div>
</template>

<script>
import HomeIcon from '../../assets/images/icons/home.svg'
import HomeOutLinedIcon from '../../assets/images/icons/home-outlined.svg'
export default {
  name: "HomeButton",
  props: {
    active: Boolean
  },
  components: { HomeIcon, HomeOutLinedIcon }
}
</script>