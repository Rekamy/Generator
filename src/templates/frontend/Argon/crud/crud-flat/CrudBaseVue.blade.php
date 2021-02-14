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

"
?>