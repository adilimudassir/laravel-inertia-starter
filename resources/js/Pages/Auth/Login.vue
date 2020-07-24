<template>
  <v-app id="inspire">
    <v-main>
      <v-container class="fill-height grey lighten-5" fluid>
        <v-row align="center" justify="center">
          <v-col cols="12" sm="6" md="3">
            <flash-messages />
            <v-form @submit.prevent="submit()">
              <v-card class="elevation-12">
                <v-toolbar color="primary" dark flat>
                  <v-toolbar-title>Login form</v-toolbar-title>
                  <v-spacer></v-spacer>
                </v-toolbar>
                <v-card-text>
                  <v-text-field
                    v-model="form.email"
                    label="Email"
                    name="email"
                    prepend-icon="mdi-account"
                    type="email"
                  ></v-text-field>

                  <v-text-field
                    id="password"
                    label="Password"
                    name="password"
                    prepend-icon="mdi-lock"
                    type="password"
                    v-model="form.password"
                  ></v-text-field>
                </v-card-text>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn
                    color="primary"
                    type="submit"
                    :loading="loading"
                    :disabled="loading"
                    class="ma-2"
                  >Login</v-btn>
                </v-card-actions>
              </v-card>
            </v-form>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import FlashMessages from "@/Components/FlashMessages";
import { LoadingButtonMixin } from '@/Mixins/LoadingButtonMixin';
export default {
  components: {
    FlashMessages,
  },
  mixins: [LoadingButtonMixin],
  data() {
    return {  
      form: {
        email: "admin@admin.com",
        password: "secret",
      },
    };
  },
  methods: {
    submit() {
      this.loader = 'loading'
      this.$inertia
        .post(route("auth.login"), {
          email: this.form.email,
          password: this.form.password,
        })
    },
  },
};
</script>