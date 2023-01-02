<template>
  <div class="bg-white px-6 rounded-2xl border-4 border-gray-200 relative">
    <TagRoundedBottom label="Rescatada" class="absolute top-0 right-6"/>
    <slot></slot>
  </div>
</template>

<script>
import TagRoundedBottom from "../atoms/TagRoundedBottom.vue"

export default {
  name: "Card",
  components: {
    TagRoundedBottom,
  },
}
</script>