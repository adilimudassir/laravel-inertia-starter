<template>
  <v-card class="mt-7">
    <v-card-title>
      <inertia-link class="white--text text-decoration-none" :href="route('users.index')">
        <v-btn color="blue white--text" small top absolute left fab>
          <v-icon>mdi-keyboard-backspace</v-icon>
        </v-btn>
      </inertia-link>
      <v-tabs v-model="tab" centered fixed-tabs slider-color="blue">
        <v-tab>Profile</v-tab>
        <v-tab>Password</v-tab>
      </v-tabs>
    </v-card-title>
    <v-card-text>
      <v-tabs-items v-model="tab">
        <v-tab-item>
          <v-card>
            <v-card-title>
              <inertia-link
                class="white--text text-decoration-none"
                :href="route('users.edit', $page.user.id)"
                v-if="userCan('update-users')"
              >
                <v-btn color="red white--text" small top absolute right fab>
                  <v-icon>mdi-pencil</v-icon>
                </v-btn>
              </inertia-link>
            </v-card-title>
            <v-list-item two-line>
              <v-list-item-content>
                <v-list-item-title class="headline">{{ $page.user.name }}</v-list-item-title>
                <v-list-item-subtitle>Member since {{ $page.user.created_at }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
            <v-card-text>
              <v-list class="transparent">
                <v-list-item>
                  <v-list-item-content>
                    <v-list-item-title>Email</v-list-item-title>
                    <v-list-item-subtitle class="text-right">{{ $page.user.email }}</v-list-item-subtitle>
                  </v-list-item-content>
                </v-list-item>
                <v-list-item>
                  <v-list-item-content>
                    <v-list-item-title>Active</v-list-item-title>
                    <v-list-item-subtitle class="text-right">
                      <v-chip :color="$page.user.active ? 'green' : 'red'" text-color="white">
                        <span v-show="$page.user.active">
                          <v-avatar left>
                            <v-icon>mdi-checkbox-marked-circle</v-icon>
                          </v-avatar>Yes
                        </span>
                        <span v-show="!$page.user.active">
                          <v-avatar left>
                            <v-icon>mdi-close-circle</v-icon>
                          </v-avatar>No
                        </span>
                      </v-chip>
                    </v-list-item-subtitle>
                  </v-list-item-content>
                </v-list-item>
                <v-list-item>
                  <v-list-item-content>
                    <v-list-item-title>Confirmed</v-list-item-title>
                    <v-list-item-subtitle class="text-right">
                      <v-chip
                        :color="$page.user.email_verified_at ? 'green' : 'red'"
                        text-color="white"
                      >
                        <span v-show="$page.user.email_verified_at">
                          <v-avatar left>
                            <v-icon>mdi-checkbox-marked-circle</v-icon>
                          </v-avatar>Yes
                        </span>
                        <span v-show="!$page.user.email_verified_at">
                          <v-avatar left>
                            <v-icon>mdi-close-circle</v-icon>
                          </v-avatar>No
                        </span>
                      </v-chip>
                    </v-list-item-subtitle>
                  </v-list-item-content>
                </v-list-item>
                <v-list-item>
                  <v-list-item-content>
                    <v-list-item-title>Roles</v-list-item-title>
                    <v-list-item-subtitle class="text-right">
                      <ul type="none">
                        <li v-for="(role, index) in $page.user.roles" :key="index">
                          <v-chip label class="ma-1" color="defualt">{{ role }}</v-chip>
                        </li>
                      </ul>
                    </v-list-item-subtitle>
                  </v-list-item-content>
                </v-list-item>
              </v-list>
            </v-card-text>
            <v-card-actions></v-card-actions>
          </v-card>
        </v-tab-item>
        <v-tab-item>
          <v-card class="mt-7">
            <v-card-title class="mt-10">Change Your Password</v-card-title>
            <v-card-text>
              <ValidationObserver ref="observer">
                <form>
                  <ValidationProvider v-slot="{ errors }" name="Current Password" rules="required">
                    <v-text-field
                      v-model="form.current_password"
                      :error-messages="errors"
                      type="password"
                      label="Current Password"
                    ></v-text-field>
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
                    <v-text-field
                      v-model="form.password_confirmation"
                      type="password"
                      label="Confirm Password"
                    ></v-text-field>
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
        </v-tab-item>
      </v-tabs-items>
    </v-card-text>
  </v-card>
</template>
<script>
import Layout from "@/Components/Layout";
import { LoadingButtonMixin } from "@/Mixins/LoadingButtonMixin";
export default {
  metaInfo: { title: "Viwing User" },
  mixins: [LoadingButtonMixin],
  data: () => ({
    tab: null,
    form: {
      current_password: "",
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
          this.$inertia.post(
            this.route("users.change-password", this.$page.user.id),
            this.form
          );
        } else {
          this.loading = false;
        }
      });
    },
    clear() {
      this.form.current_password = this.form.password = this.form.password_confirmation =
        "";
      this.$refs.observer.reset();
    },
  },
};
</script>