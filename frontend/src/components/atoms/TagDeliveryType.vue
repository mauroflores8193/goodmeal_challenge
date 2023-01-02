<template>
  <div class="bg-pink-100 text-pink-700 font-medium w-fit px-5 py-1 text-xs rounded-full">{{ label }}</div>
</template>

<script>
export default {
  name: "TagDeliveryType",
  props: {
    label: String
  }
}
</script>