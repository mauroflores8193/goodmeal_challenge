<template>
  <div class="bg-teal-500 text-white w-fit px-4 py-1 text-sm rounded-b-2xl">{{ label }}</div>
</template>

<script>
export default {
  name: "TagRoundedBottom",
  props: {
    label: String
  }
}
</script>