<template>
    <v-row no-gutters>
      <v-col >
        <v-alert
          text
          type="info"
          :dismissible="true"
          class="white"
          v-if="$page.flash.info"
        >{{ $page.flash.info }}</v-alert>
        <v-alert
          text
          type="success"
          :dismissible="true"
          class="white"
          v-if="$page.flash.success"
        >{{ $page.flash.success }}</v-alert>
        <v-alert
          text
          type="error"
          :dismissible="true"
          class="white"
          v-if="$page.flash.error"
        >{{ $page.flash.error }}</v-alert>
        <v-alert
          text
          type="warning"
          :dismissible="true"
          class="white"
          v-if="$page.flash.warning"
        >{{ $page.flash.warning }}</v-alert>

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
      </v-col>
    </v-row>
</template>

<script>
export default {
  data: () => ({}),
  methods: {},
};
</script>