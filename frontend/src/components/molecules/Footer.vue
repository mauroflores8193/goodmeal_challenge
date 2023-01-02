<template>
  <nav class="flex h-20 justify-around items-center">
    <router-link to="/">
      <HomeButton :active="$route.path === '/'"/>
    </router-link>
    <router-link to="/orders">
      <OrdersButton :active="$route.path === '/orders'"/>
    </router-link>
    <router-link to="/profile">
      <ProfileButton :active="$route.path === '/profile'"/>
    </router-link>
  </nav>
</template>

<script>
import HomeButton from "./HomeButton.vue";
import OrdersButton from "./OrdersButton.vue";
import ProfileButton from "./ProfileButton.vue";

export default {
  name: "Footer",
  components: { ProfileButton, OrdersButton, HomeButton }
}
</script>