<template>
  <div class="card px-6 relative">
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