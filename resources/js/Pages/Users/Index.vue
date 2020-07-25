<template>
  <v-card outlined class="mt-7">
    <v-card-title>
      Users
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
      <v-fab-transition>
        <inertia-link
          class="white--text small text-decoration-none mb-7"
          :href="route('users.create')"
        >
          <v-btn color="green white--text" small top absolute right fab>
            <v-icon>mdi-plus</v-icon>
          </v-btn>
        </inertia-link>
      </v-fab-transition>
    </v-card-title>
    <v-card-text>
      <v-data-table :headers="headers" :items="$page.users" :search="search" multi-sort class="elevation-2">
        <template v-slot:item.active="{ item }">
          <v-chip :color="item.active ? 'green' : 'red'" text-color="white">
            <span v-show="item.active">
              <v-avatar left>
                <v-icon>mdi-checkbox-marked-circle</v-icon>
              </v-avatar>Yes
            </span>
            <span v-show="!item.active">
              <v-avatar left>
                <v-icon>mdi-close-circle</v-icon>
              </v-avatar>No
            </span>
          </v-chip>
        </template>
        <template v-slot:item.verified="{ item }">
          <v-chip :color="item.verified ? 'green' : 'red'" text-color="white">
            <span v-show="item.verified">
              <v-avatar left>
                <v-icon>mdi-checkbox-marked-circle</v-icon>
              </v-avatar>Yes
            </span>
            <span v-show="!item.verified">
              <v-avatar left>
                <v-icon>mdi-close-circle</v-icon>
              </v-avatar>No
            </span>
          </v-chip>
        </template>
        <template v-slot:item.roles="{ item }">
            <v-chip label class="ma-1" color="primary" v-for="(role, index) in item.roles" :key="index">
              {{ role }}
            </v-chip> 
        </template>
        <template v-slot:item.actions="{ item }">
          <inertia-link
            class="white--white text-decoration-none"
            :href="route('users.show', item.id)"
          >
            <v-btn color="default">
              <v-icon large class="mr-2">mdi-chevron-right</v-icon>
            </v-btn>
          </inertia-link>
        </template>
      </v-data-table>
    </v-card-text>
  </v-card>
</template>
<script>
import Layout from "@/Components/Layout";
export default {
  metaInfo: { title: "Users" },
  data: () => ({
    search: "",
    hidden: false,
    headers: [
      { text: "ID", value: "id" },
      { text: "Name", value: "name" },
      { text: "Email", value: "email" },
      { text: "Active", value: "active" },
      { text: "Verified", value: "verified" },
      { text: "Roles", value: "roles" },
      { text: "Created", value: "created_at" },
      { text: "Action", value: "actions", sortable: false },
    ],
  }),
  layout: Layout,
};
</script>