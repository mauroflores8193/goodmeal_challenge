<template>
  <div class="flex flex-col h-full">
    <Header title="Perfil"/>
    <div class="px-6 flex flex-col gap-4 flex-1 overflow-y-auto">
    </div>
    <Nav />
  </div>
</template>

<script>
import Header from "../molecules/Header.vue";
import Nav from "../molecules/Nav.vue";

export default {
  name: "Profile",
  components: { Header, Nav }
}
</script>