<template>
  <v-card class="mt-7 fill-height">
    <v-card-title>
      Roles
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
          :href="route('roles.create')"
          v-if="userCan('create-roles')"
        >
          <v-btn color="green white--text" small top absolute right fab>
            <v-icon>mdi-plus</v-icon>
          </v-btn>
        </inertia-link>
      </v-fab-transition>
    </v-card-title>
    <v-card-text>
      <v-data-table
        :headers="headers"
        :items="$page.roles"
        :search="search"
        :single-expand="true"
        :expanded.sync="expanded"
        item-key="name"
        show-expand
        class="elevation-2"
      >
        <template v-slot:expanded-item="{ headers, item }">
          <td :colspan="headers.length">
              <v-subheader>Permissions</v-subheader>
              <v-chip
                label
                class="ma-3"
                color="default"
                cols="4"
                v-for="(permission, index) in item.permissions"
                :key="permission"
              >{{ ++index }} - {{ permission }}</v-chip>

              <v-subheader>Users</v-subheader>
              <v-chip
                label
                class="ma-3"
                color="default"
                v-for="(user, key) in item.users"
                :key="key"
              >{{ ++key }} - {{ user }}</v-chip>
          </td>
        </template>
        <template v-slot:item.users_count="{ item }">
          <v-chip color="primary" text-color="white">{{ item.users_count }}</v-chip>
        </template>
        <template v-slot:item.actions="{ item }">
          <confirm-dialogue
            v-if="userCan('delete-roles')"
            v-on:confirmAction="deleteItem(item.id)"
          />
        </template>
      </v-data-table>
    </v-card-text>
  </v-card>
</template>
<script>
import Layout from "@/Components/Layout";
import ConfirmDialogue from '@/Components/ConfirmDialogue';
export default {
  metaInfo: { title: "Roles" },
  data: () => ({
    search: "",
    expanded: [],
    hidden: false,
    headers: [
      { text: "ID", value: "id" },
      { text: "Name", value: "name" },
      { text: "No of Users", value: "users_count" },
      { text: "Created", value: "created_at" },
      { text: "Action", value: "actions", sortable: false },
    ],
  }),
  layout: Layout,
  components: {
    ConfirmDialogue
  },
  methods: {
    deleteItem(id) {
      this.$inertia.delete(this.route("roles.delete", id));
    }
  }
};
</script>