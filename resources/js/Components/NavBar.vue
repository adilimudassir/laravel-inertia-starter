<template>
  <v-navigation-drawer
    v-model="localDrawer"
    :clipped="$vuetify.breakpoint.lgAndUp"
    app
  >
    <v-list>
      <inertia-link
        class="black--text text-decoration-none"
        :href="route('dashboard')"
      >
        <v-list-item link>
          <v-list-item-icon>
            <v-icon>mdi-view-dashboard</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Dashboard</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </inertia-link>
      <v-subheader>Authentication</v-subheader>
      <v-divider></v-divider>
      <inertia-link
        v-if="userCan('read-users')"
        class="black--text text-decoration-none"
        :href="route('users.index')"
      >
        <v-list-item link>
          <v-list-item-icon>
            <v-icon>mdi-account</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Users</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </inertia-link>
      <inertia-link
        v-if="userCan('read-roles')"
        class="black--text text-decoration-none"
        :href="route('roles.index')"
      >
        <v-list-item link>
          <v-list-item-icon>
            <v-icon>mdi-lock</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Roles</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </inertia-link>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
export default {
  props: ["drawer"],
  data() {
    return {
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
};
</script>