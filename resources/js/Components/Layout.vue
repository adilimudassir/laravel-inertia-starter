<template>
  <v-app id="inspire">
    <nav-bar :drawer="drawer" />
    <app-bar :drawer.sync="drawer" />
    <v-main class="grey lighten-3">
      <v-container fluid>
        <flash-messages />
        <v-scale-transition origin="center center" mode="out-in" scroll-region>
          <slot />
        </v-scale-transition>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import FlashMessages from "@/Components/FlashMessages";
import NavBar from '@/Components/NavBar';
import AppBar from '@/Components/AppBar';
export default {
  data() {
    return {
      drawer: null,
    }
  },
  components: {
    FlashMessages,
    NavBar,
    AppBar
  },
  methods: {
    isUrl(...urls) {
      if (urls[0] === "") {
        return this.url === "";
      }

      return urls.filter((url) => this.url.startsWith(url)).length;
    },
  },
};
</script>