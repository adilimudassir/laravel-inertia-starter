<template>
  <v-card outlined class="mt-7">
    <v-card-title>
      New User
      <v-spacer></v-spacer>
      <inertia-link class="white--text text-decoration-none" :href="route('users.index')">
        <v-btn color="blue white--text" dark top absolute right fab>
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
            rules="required|min:2|confirmed:confirm_password"
          >
            <v-text-field
              v-model="form.password"
              :error-messages="errors"
              type="password"
              label="Password"
              required
            ></v-text-field>
          </ValidationProvider>
          <ValidationProvider name="Confirm Password" vid="confirm_password">
            <v-text-field v-model="form.confirm_password" type="password" label="Confirm Password"></v-text-field>
          </ValidationProvider>
          <ValidationProvider v-slot="{ errors }" name="Role" rules="required">
            <v-select
              v-model="form.role"
              :items="$page.roles"
              :error-messages="errors"
              label="Role"
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
  mixins: [LoadingButtonMixin],
  data: () => ({
    form: {
      name: "",
      email: "",
      role: "",
      status: true,
      confirmed: true,
      password: "",
      confirm_password: "",
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
      this.form.name = this.form.email = this.form.password = this.form.role = this.form.confirm_password =
        "";
      this.form.confirmed = this.form.status = true;
      this.$refs.observer.reset();
    },
  },
};
</script>