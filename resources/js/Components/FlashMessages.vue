<template>
  <div class="text-center ma-2">
    <v-scale-transition mode="out-in" origin="center center">
      <v-snackbar
        :color="color"
        class="elevation-2"
        top
        right
        v-model="show"
      >
        {{ message }}
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
  data: () => ({
    show: false
  }),
  methods: {
    close() {
      // this.$store.dispatch("clearMessage");
      this.show = false;
    },
  },
  computed: {
    color() {
      if (this.$page.flash == null || typeof(this.$page.flash) == undefined) return
      return this.$page.flash.type;
    },
    message() {
      if (this.$page.flash == null || typeof(this.$page.flash) == undefined) return
      // if(this.show) {
      //   this.show = false;
      //   setTimeout(() => {
      //     this.show = true;
      //   }, 50);
      // }
      this.show = true;
      return this.$page.flash.message;
    }
  }
};
</script>