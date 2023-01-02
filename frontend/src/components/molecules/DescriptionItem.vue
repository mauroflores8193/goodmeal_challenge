<template>
  <div class="flex gap-1">
    <div class="font-medium">{{ title }}</div>
    <div>{{ description }}</div>
  </div>
</template>

<script>
export default {
  name: "DescriptionList",
  props: {
    title: String,
    description: String
  }
}
</script>