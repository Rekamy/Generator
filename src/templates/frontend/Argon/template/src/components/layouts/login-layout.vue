<template>
  <div class="bg-default g-sidenav-show g-sidenav-pinned">
    <!-- Navbar -->
    <LoginTopNav />
    <!-- Main content -->
    <LoginHeader>
        <slot />
    </LoginHeader>
    <LoginFooter />
  </div>
</template>

<script lang="ts">
import { Vue } from "vue-class-component";

export default class LoginLayout extends Vue {
  name: string = "login-layout";
}
</script>

