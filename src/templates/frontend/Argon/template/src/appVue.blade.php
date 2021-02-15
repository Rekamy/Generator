<template>
  <!-- <div> -->
  <!-- <notifications></notifications> -->
  <component :is="layout">
    <router-view v-slot="{ Component }">
      <transition name="fade" mode="out-in">
        <component :is="Component"></component>
      </transition>
    </router-view>
  </component>
  <!-- </div> -->
</template>

<script lang="ts">
import { Vue } from "vue-class-component";

export default class App extends Vue {
  default = "";

  get layout() {
    return (this.$route.meta.layout || this.default) + "-layout";
  }
}
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: all 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  transform: translateX(20px);
}

.fade-enter-to,
.fade-leave-from {
  opacity: 1;
  transform: translateX(0);
}
</style>
