<template>
  <div class="bg-pink-500 text-white font-medium w-fit px-2 py-1 text-sm rounded-full">{{ label }}</div>
</template>

<script>
export default {
  name: "TagAttentionHours",
  props: {
    label: String
  }
}
</script>