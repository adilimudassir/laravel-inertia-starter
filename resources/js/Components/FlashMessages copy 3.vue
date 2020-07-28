<template>
  <div class="text-center ma-2">
    <v-snackbar color="success" top center v-model="snackbar" v-if="$page.flash.success">
      {{ $page.flash.success }}
      <template v-slot:action="{ attrs }">
        <v-btn color="white" text v-bind="attrs" @click="snackbar = false">Close</v-btn>
      </template>
    </v-snackbar>
  </div>
</template>

<script>
export default {
  data: () => ({
    snackbar: true,
  }),
};
</script>