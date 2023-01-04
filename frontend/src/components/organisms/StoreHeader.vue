<template>
  <div class="relative">
    <img :src="banner" class="h-18 w-full" :class="bannerClass" alt="banner"/>
    <img :src="icon" class="rounded-full absolute -bottom-6 right-8 w-16 h-16 bg-white" alt="logo"/>
    <slot/>
  </div>
</template>

<script>
export default {
  name: "StoreHeader",
  props: {
    banner: String,
    icon: String,
    bannerClass: String
  }
}
</script>