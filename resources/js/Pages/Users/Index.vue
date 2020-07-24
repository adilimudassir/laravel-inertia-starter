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
        <inertia-link class="white--text text-decoration-none" :href="route('users.create')">
          <v-btn v-show="!hidden" color="green white--text" dark top absolute right fab>
            <v-icon>mdi-plus</v-icon>
          </v-btn>
        </inertia-link>
      </v-fab-transition>
    </v-card-title>
    <v-card-text>
      <v-data-table :headers="headers" :items="$page.users" :search="search" multi-sort></v-data-table>
    </v-card-text>
  </v-card>
</template>
<script>
import Layout from "@/Components/Layout";
export default {
  data: () => ({
    search: "",
    hidden: false,
    headers: [
      { text: "ID", value: "id" },
      { text: "Name", value: "name" },
      { text: "Email", value: "email" },
      { text: "Created", value: "created_at" },
    ],
  }),
  layout: Layout,
};
</script>