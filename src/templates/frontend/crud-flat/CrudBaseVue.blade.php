<?=
"
<template>
  <div class=\"container-fluid mt--6\">
    <router-view v-slot=\"{ Component }\">
      <transition name=\"fade\" mode=\"out-in\">
        <component :is=\"Component\" />
      </transition>
    </router-view>
    <main-footer />
  </div>
</template>

<script lang=\"ts\" src=\"./base.ts\"></script>

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

"
?>