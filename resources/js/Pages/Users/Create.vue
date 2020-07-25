<template>
  <v-card outlined class="mt-7">
    <v-card-title class="mt-10">
      New User
      <v-spacer></v-spacer>
      <inertia-link class="white--text text-decoration-none" :href="route('users.index')">
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
          <ValidationProvider v-slot="{ errors }" name="Email" rules="required|email">
            <v-text-field v-model="form.email" :error-messages="errors" label="E-mail" required></v-text-field>
          </ValidationProvider>
          <ValidationProvider
            v-slot="{ errors }"
            name="Password"
            rules="required|min:2|confirmed:password_confirmation"
          >
            <v-text-field
              v-model="form.password"
              :error-messages="errors"
              type="password"
              label="Password"
              required
            ></v-text-field>
          </ValidationProvider>
          <ValidationProvider name="Confirm Password" vid="password_confirmation">
            <v-text-field v-model="form.password_confirmation" type="password" label="Confirm Password"></v-text-field>
          </ValidationProvider>
          <ValidationProvider v-slot="{ errors }" name="Roles" rules="required">
            <v-select
              v-model="form.roles"
              :items="$page.roles"
              :error-messages="errors"
              label="Roles"
              data-vv-name="roles"
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
  metaInfo: { title: "New User" },
  mixins: [LoadingButtonMixin],
  data: () => ({
    form: {
      name: "",
      email: "",
      roles: [],
      status: true,
      confirmed: true,
      password: "",
      password_confirmation: "",
    },
  }),
  layout: Layout,
  methods: {
    submit() {
      this.loader = "loading";
      this.$refs.observer.validate().then((validated) => {
        if (validated) {
          this.$inertia.post(this.route("users.store"), this.form);
        } else {
          this.loading = false;
        }
      });
    },
    clear() {
      this.form.name = this.form.email = this.form.password = this.form.roles = this.form.password_confirmation =
        "";
      this.form.confirmed = this.form.status = true;
      this.$refs.observer.reset();
    },
  },
};
</script>