<template>
  <div class="text-center ma-2">
    <v-snackbar color="success" v-model="snackbar">
      {{ text }}
      <template v-slot:action="{ attrs }">
        <v-btn color="pink" text v-bind="attrs" @click="snackbar = false">Close</v-btn>
      </template>
    </v-snackbar>
  </div>
</template>

<script>
export default {
  data: () => ({
    snackbar: false,
    success: null,
    info: null,
    error: null,
    warning: null,
    text: "Hello, I'm a snackbar",
  }),
  watch: {
    'success': {
      handler: function() {
        this.snackbar = true;
        this.text = this.$page.flash.success
      },
      deep: true
    }
  },
  activated() {
    console.log(this.$page.flash.success)
    this.success = this.$page.flash.success;
    this.info = this.$page.flash.info;
    this.error = this.$page.flash.error;
    this.warning = this.$page.flash.warning;
  }
};
</script>