<template>
  <footer class="footer pt-0">
    <div class="row align-items-center justify-content-lg-between">
      <div class="col-lg-6">
        <div class="copyright text-center text-lg-left text-muted">
          &copy; 2020
          <a
            href="https://www.mbsp.gov.my/"
            class="font-weight-bold ml-1"
            target="_blank"
            >MBSP Majlis Bandaraya Seberang Perai
          </a>
        </div>
      </div>
      <div class="col-lg-6">
        <ul
          class="nav nav-footer justify-content-center justify-content-lg-end"
        >
          <li class="nav-item">
            <a
              href="https://www.sarraglobal.com/"
              class="nav-link"
              target="_blank"
              >Sarra Global</a
            >
          </li>
          <li class="nav-item">
            <a href="https://www.mbsp.gov.my/" class="nav-link" target="_blank"
              >Documentation</a
            >
          </li>
        </ul>
      </div>
    </div>
  </footer>
</template>

<script lang="ts">
import { Vue } from "vue-class-component";

export default class MainFooter extends Vue {
  name: string = "main-footer";
}
</script>

