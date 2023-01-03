<template>
  <div class="text-white font-medium w-fit px-2 py-1 text-xs rounded-full" :class="bgColor">
    {{ emoticon }} {{ discount }}% dcto.
  </div>
</template>

<script>
export default {
  name: "TagDiscount",
  props: {
    discount: Number
  },
  computed: {
    emoticon: function () {
      const emoticons = ['🤯', '😍', '😱', '🤩']
      return emoticons[(Math.random() * emoticons.length) | 0]
    },
    bgColor: function () {
      const bgColors = ['bg-pink-400', 'bg-orange-400', 'bg-amber-400', 'bg-green-400', 'bg-emerald-400', 'bg-blue-400', 'bg-purple-400']
      return bgColors[(Math.random() * bgColors.length) | 0]
    }
  }
}
</script>