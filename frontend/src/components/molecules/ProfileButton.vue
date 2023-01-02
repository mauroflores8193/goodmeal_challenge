<template>
  <div class="button-icon" :class="{'text-pink-500' : active}">
    <UserIcon class="w-10 h-10" v-if="active" />
    <UserOutLinedIcon class="w-10 h-10" v-if="!active"/>
    <div>Perfil</div>
  </div>
</template>

<script>
import UserIcon from '../../assets/images/icons/user.svg'
import UserOutLinedIcon from '../../assets/images/icons/user-outlined.svg'
export default {
  name: "ProfileButton",
  props: {
    active: Boolean
  },
  components: { UserIcon, UserOutLinedIcon }
}
</script>