<template>
  <v-app-bar
    :clipped-left="$vuetify.breakpoint.lgAndUp"
    app
    color="blue darken-3"
    dark
  >
    <v-app-bar-nav-icon @click.stop="closeDrawer()"></v-app-bar-nav-icon>
    <v-toolbar-title style="width: 300px" class="ml-0 pl-4">
      <span>{{ $page.app.name }}</span>
    </v-toolbar-title>
    <v-spacer></v-spacer>
    <v-menu
      v-model="menu"
      :close-on-content-click="false"
      :nudge-width="200"
      offset-x
    >
      <template v-slot:activator="{ on, attrs }">
        <v-btn dark v-bind="attrs" v-on="on" icon>
          <v-icon>mdi-account-tie</v-icon>
        </v-btn>
      </template>
      <v-card>
        <v-list>
          <v-list-item>
            <v-list-item-avatar>
              <v-icon>mdi-account-tie</v-icon>
            </v-list-item-avatar>
            <v-list-item-content color="grey lighten-4">
              <v-list-item-title>{{ $page.auth.user.name }}</v-list-item-title>
              <v-list-item-subtitle>{{
                $page.auth.user.email
              }}</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
          <v-divider></v-divider>
          <v-list-item-group color="primary">
            <inertia-link
              class="black--text text-decoration-none"
              :href="route('auth.logout')"
              method="post"
            >
              <v-list-item link>
                <v-list-item-icon>
                  <v-icon>mdi-logout</v-icon>
                </v-list-item-icon>
                <v-list-item-content>
                  <v-list-item-title>Logout</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </inertia-link>
          </v-list-item-group>
        </v-list>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" text @click="menu = false">Close</v-btn>
        </v-card-actions>
      </v-card>
    </v-menu>
  </v-app-bar>
</template>
<script>
export default {
  props: ["drawer"],
  data() {
    return {
      menu: null,
      localDrawer: this.drawer,
    };
  },
  watch: {
    drawer: {
      handler(newValue) {
        this.localDrawer = newValue;
      },
      deep: true,
    },
  },
  methods: {
    closeDrawer() {
      this.localDrawer = !this.localDrawer;
      this.$emit("update:drawer", this.localDrawer);
    },
  },
};
</script>