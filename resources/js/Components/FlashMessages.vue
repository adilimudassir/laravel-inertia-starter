<template>
  <div class="text-center ma-2">
    <v-scale-transition mode="out-in" origin="center center">
      <v-snackbar
        :color="$store.state.flashMessage.type"
        class="elevation-2"
        top
        right
        v-model="$store.state.flashMessage.show"
      >
        {{ $store.state.flashMessage.text }}
        <template v-slot:action="{ attrs }">
          <v-btn color="white" text v-bind="attrs" @click="close()">Close</v-btn>
        </template>
      </v-snackbar>
    </v-scale-transition>

    <v-alert
      text
      border="left"
      color="red accent-4"
      :dismissible="true"
      class="white"
      v-if="Object.keys($page.errors).length > 0"
    >
      <ul>
        <li v-for="(error, index) in $page.errors" :key="index">{{ error[0] }}</li>
      </ul>
    </v-alert>
  </div>
</template>

<script>
export default {
  methods: {
    close() {
      this.$store.dispatch("clearMessage");
    },
  },
};
</script>