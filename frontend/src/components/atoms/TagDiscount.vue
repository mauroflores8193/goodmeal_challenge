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
      let emoticon = '😍'
      if(this.discount > 20) {
        emoticon = '🤩'
      }else if(this.discount > 40) {
        emoticon = '😱'
      } else if(this.discount > 0) {
        emoticon = '🤯'
      }
      return emoticon
    },
    bgColor: function () {
      let bgColors = 'bg-pink-400'
      if(this.discount > 10) {
        bgColors ='bg-orange-400'
      }else if(this.discount > 20) {
        bgColors =  'bg-amber-400'
      } else if(this.discount > 30) {
        bgColors ='bg-green-400'
      } else if(this.discount > 40) {
        bgColors ='bg-emerald-400'
      } else if(this.discount > 50) {
        bgColors ='bg-blue-400'
      } else if(this.discount > 60) {
        bgColors ='bg-purple-400'
      }
      return bgColors
    }
  }
}
</script>