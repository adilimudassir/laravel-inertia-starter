<template>
  <v-app id="inspire">
    <v-navigation-drawer v-model="drawer" :clipped="$vuetify.breakpoint.lgAndUp" app>
      <v-list>
        <inertia-link class="black--text text-decoration-none" :href="route('dashboard')">
          <v-list-item link>
            <v-list-item-icon>
              <v-icon>mdi-view-dashboard</v-icon>
            </v-list-item-icon>
            <v-list-item-content>
              <v-list-item-title>Dashboard</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </inertia-link>
        <inertia-link class="black--text text-decoration-none" :href="route('users.index')">
          <v-list-item link>
            <v-list-item-icon>
              <v-icon>mdi-account-multiple-outline</v-icon>
            </v-list-item-icon>
            <v-list-item-content>
              <v-list-item-title>Users</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </inertia-link>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar :clipped-left="$vuetify.breakpoint.lgAndUp" app color="blue darken-3" dark>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title style="width: 300px" class="ml-0 pl-4">
        <span class="hidden-sm-and-down">{{ $page.app.name }}</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn icon></v-btn>
      <div class="text-center">
        <v-menu v-model="menu" :close-on-content-click="false" :nudge-width="200" offset-x>
          <template v-slot:activator="{ on, attrs }">
            <v-btn dark v-bind="attrs" v-on="on" icon>
              <v-icon>mdi-account-settings</v-icon>
            </v-btn>
          </template>
          <v-card>
            <v-list>
              <v-list-item>
                <v-list-item-avatar>
                  <img src="https://cdn.vuetifyjs.com/images/john.jpg" alt="John" />
                </v-list-item-avatar>
                <v-list-item-content>
                  <v-list-item-title>{{ $page.auth.user.name }}</v-list-item-title>
                  <v-list-item-subtitle>{{ $page.auth.user.email }}</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
            </v-list>
            <v-divider></v-divider>
            <v-list>
              <v-list-item-group color="primary">
                <inertia-link
                  class="black--text text-decoration-none"
                  :href="route('auth.logout')"
                  method="post"
                >
                  <v-list-item>
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
      </div>
    </v-app-bar>
    <v-main>
      <v-container fluid>
        <flash-messages />
        <slot />
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import FlashMessages from "@/Components/FlashMessages";
export default {
  data: () => ({
    drawer: null,
    menu: false,
  }),
  components: {
    FlashMessages,
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