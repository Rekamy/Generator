<template>
  <!-- Sidenav -->
  <nav
    class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white"
    id="sidenav-main"
  >
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header align-items-center">
        <router-link to="/" class="navbar-brand">
          <img
            src="/assets/img/brand/MBSP.png"
            class="navbar-brand-img"
            alt="..."
          />
        </router-link>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse pb-4" id="sidenav-collapse-main">
          <!-- Nav items -->
          <template v-for="menuContainer in menus" key="menuContainer">
            <template v-if="menuContainer.type == 'divider'">
              <!-- Divider -->
              <hr class="my-3" :key="menuContainer.type" />
            </template>

            <template v-if="menuContainer.type == 'header'">
              <!-- Heading -->
              <h6
                class="navbar-heading p-0 text-muted"
                :key="menuContainer.type"
              >
                <span class="docs-normal">{{ menuContainer.name }}</span>
              </h6>
            </template>

            <template v-if="menuContainer.type == 'single'">
              <ul
                :class="menuContainer.class"
                v-for="menu in menuContainer.items"
                :key="menu"
              >
                <li class="nav-item">
                  <template v-if="typeof menu.route == 'string'">
                    <router-link
                      :to="menu.route"
                      class="nav-link"
                      :hasChildren="menu"
                      :class="$route.path == menu.route ? 'active' : ''"
                    >
                      <i :class="menu.class"></i>
                      <span class="nav-link-text">{{ menu.name }}</span>
                    </router-link>
                  </template>
                  <template v-if="typeof menu.link == 'string'">
                    <a :href="menu.link" class="nav-link" target="_blank">
                      <i :class="menu.class"></i>
                      <span class="nav-link-text">{{ menu.name }}</span>
                    </a>
                  </template>
                </li>
              </ul>
            </template>
          </template>
        </div>
      </div>
    </div>
  </nav>
</template>
<style scoped>
.navbar-brand {
    padding: 0.5rem;
    height: 100%;
    width: 100%;
}
.navbar-vertical .navbar-brand-img, .navbar-vertical .navbar-brand > img {
    height: 100%;
    max-height: 100%;
}
</style>
<script lang="ts">
import { Options, Vue } from "vue-class-component";
import PerfectScrollbar from "perfect-scrollbar";

@Options({
  props: {
    menus: [],
  },
})
export default class Sidebar extends Vue {
  name: string = "sidebar";
  menus: object[] = [];

  mounted() {
    new PerfectScrollbar("#sidenav-main");
  }

  created() {
    this.menus = [
      {
        type: "single",
        class: "navbar-nav",
        childContainerClass: "nav-item",
        items: [
          {
            type: "menu",
            name: "Dashboard",
            route: "/dashboard",
            // class: "ni ni-tv-2 text-primary",
            class: "ni fas fa-edit text-primary",
          },
        ],
      },
      {
        type: "divider",
      },
      {
        type: "header",
        name: "CRUD",
      },
      {
        type: "single",
        class: "navbar-nav",
        childContainerClass: "nav-item",
        items: [
          {
            type: "menu",
            name: "Clients",
            route: "/crud/client",
            class: "ni ni-tv-2 text-primary",
          }
        ],
      },
    ];
  }
}
</script>

