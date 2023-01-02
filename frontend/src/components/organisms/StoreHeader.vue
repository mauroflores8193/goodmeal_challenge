<template>
  <div class="relative">
    <img :src="banner" class="rounded-t-xl h-18 w-full"/>
    <img :src="icon" class="rounded-full absolute -bottom-6 right-8 w-16 h-16 bg-white"/>
    <slot/>
  </div>
</template>

<script>
export default {
  name: "StoreHeader",
  props: {
    banner: String,
    icon: String
  }
}
</script>