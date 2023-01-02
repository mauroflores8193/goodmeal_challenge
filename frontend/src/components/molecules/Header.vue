<template>
  <div class="h-16 flex relative items-center">
    <router-link v-if="urlBack" :to="urlBack" class="absolute left-0">
      <ArrowLeftIcon class="w-8 h-8" />
    </router-link>
    <h1 class="text-lg font-medium mx-auto">{{ title }}</h1>
  </div>
</template>

<script>
import ArrowLeftIcon from "../../assets/images/icons/arrow-left.svg"
export default {
  name: "Header",
  components: {
    ArrowLeftIcon
  },
  props: {
    title: String,
    urlBack: String
  }
}
</script>