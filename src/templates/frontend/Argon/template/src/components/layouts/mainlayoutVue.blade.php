<template>
  <!-- Sidenav -->
  <sidebar />
  <!-- Main content -->
    <div class="main-content" id="panel">
      <!-- Topnav -->
      <top-nav />
      <!-- Header -->
      <main-header />
      <!-- Content -->
      <slot />
    </div>
</template>

<script lang="ts">
import { Vue } from "vue-class-component";

export default class MainLayout extends Vue {
  name: string = "main-layput";
}
</script>

