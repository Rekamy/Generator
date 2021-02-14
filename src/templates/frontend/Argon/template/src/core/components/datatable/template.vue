<template>
  <table :class="tableClass">
    <slot />
  </table>
</template>
<style>
@import "https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css";
@import "https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css";
@import "https://demos.creative-tim.com/argon-dashboard-pro/assets/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css";
</style>
<script scoped lang="ts" src="./index.ts"></script>
