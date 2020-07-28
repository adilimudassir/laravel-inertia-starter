<template>
  <v-card outlined class="mt-7">
    <v-card-title class="mt-10">
        Edit User
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
            <v-text-field v-model="form.name" :error-messages="errors" label="Name"></v-text-field>
          </ValidationProvider>
          <ValidationProvider v-slot="{ errors }" name="Email" rules="required|email">
            <v-text-field v-model="form.email" :error-messages="errors" label="E-mail" required></v-text-field>
          </ValidationProvider>
          <ValidationProvider v-slot="{ errors }" name="Roles" rules="required">
            <v-select
              v-model="form.roles"
              :items="$page.roles"
              :error-messages="errors"
              label="Roles"
              data-vv-name="role"
              required
              multiple
              chips
              hint="Select all that applies"
              persistent-hint
              item-text="name"
              item-value="id"
            ></v-select>
          </ValidationProvider>
          <ValidationProvider v-slot="{ errors }" rules="required" name="Confirmed">
            <v-checkbox
              v-model="form.confirmed"
              :error-messages="errors"
              label="Confirmed"
              type="checkbox"
              required
            ></v-checkbox>
          </ValidationProvider>
          <ValidationProvider v-slot="{ errors }" rules="required" name="Active">
            <v-checkbox
              v-model="form.status"
              :error-messages="errors"
              label="Active"
              type="checkbox"
              required
            ></v-checkbox>
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
  metaInfo: { title: 'Edit User' },
  mixins: [LoadingButtonMixin],
  data: () => ({
    form: {
      name: "",
      email: "",
      roles: [],
      status: true,
      confirmed: true,
      password: "",
      confirm_password: "",
    },
  }),
  layout: Layout,
  mounted() {
    this.form.name = this.$page.user.name;
    this.form.email = this.$page.user.email;
    this.form.confirmed = this.$page.user.email_verified_at;
    this.form.status = this.$page.user.active;
    this.form.roles = this.$page.user.roles;
  },
  methods: {
    submit() {
      this.loader = "loading";
      this.$refs.observer.validate().then((validated) => {
        if (validated) {
          this.$inertia.patch(this.route("users.update", this.$page.user.id), this.form);
        } else {
          this.loading = false;
        }
      });
    },
    clear() {
      this.form.name = this.form.email = this.form.password = this.form.role = this.form.confirm_password =
        "";
      this.form.confirmed = this.form.status = true;
      this.$refs.observer.reset();
    },
  },
};
</script>