<template>
  <div class="flex flex-col h-full">
    <Header title="Perfil"/>
    <div class="px-6 flex flex-col gap-4 flex-1 overflow-y-auto">
    </div>
    <Footer />
  </div>
</template>

<script>
import Header from "../molecules/Header.vue";
import Footer from "../molecules/Footer.vue";

export default {
  name: "Profile",
  components: { Header, Footer }
}
</script>