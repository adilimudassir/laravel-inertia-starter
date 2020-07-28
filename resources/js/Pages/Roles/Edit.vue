<template>
  <v-card outlined class="mt-7">
    <v-card-title>
      <v-subtitle class="mt-10">
        Edit User
      </v-subtitle>
      <v-spacer></v-spacer>
      <inertia-link class="white--text text-decoration-none" :href="route('users.show', $page.user.id)">
        <v-btn color="blue white--text" small top absolute left fab>
          <v-icon>mdi-keyboard-backspace</v-icon>
        </v-btn>
      </inertia-link>
    </v-card-title>
    <v-card-text>
      <ValidationObserver ref="observer">
        <form>
          <ValidationProvider v-slot="{ errors }" name="Name" rules="required|min:2">
            <v-text-field v-model="form.name" :error-messages="errors" label="Name" required></v-text-field>
          </ValidationProvider>
          <ValidationProvider v-slot="{ errors }" rules="" name="Permissions">
            <v-subheader>
              Permissions
            </v-subheader>
            <v-row>
              <v-col  cols="12" xl="2" lg="2" md="4" sm="4" xs="6" v-for="(permission, index) in $page.permissions" :key="index">
                <v-checkbox
                v-model="form.permissions"
                :error-messages="errors"
                :label="permission.name"
                type="checkbox"
                :value="permission.name"
              >{{permission.name}}</v-checkbox>
            </v-col>
            </v-row>
          </ValidationProvider>
          <v-btn
            :loading="loading"
            :disabled="loading"
            @click="submit"
            class="mr-4"
            right
            color="success"
          >Submit</v-btn>
          <v-btn @click="clear">clear</v-btn>
        </form>
      </ValidationObserver>
    </v-card-text>
  </v-card>
</template>
<script>
import Layout from "@/Components/Layout";
import { LoadingButtonMixin } from "@/Mixins/LoadingButtonMixin";

export default {
  metaInfo: { title: 'Edit Role' },
  mixins: [LoadingButtonMixin],
  data: () => ({
    form: {
      name: "",
      permissions: [],
    },
  }),
  layout: Layout,
  mounted() {
    this.form.name = this.$page.role.name;
    this.form.permissions = this.$page.role.permissions;
  },
  methods: {
    submit() {
      this.loader = "loading";
      this.$refs.observer.validate().then((validated) => {
        if (validated) {
          this.$inertia.patch(this.route("role.update", this.$page.role.id), this.form);
        } else {
          this.loading = false;
        }
      });
    },
    clear() {
      this.form.name = "";
      this.form.permissions = [];
      this.$refs.observer.reset();
    },
  },
};
</script>