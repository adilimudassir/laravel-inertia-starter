<template>
  <v-dialog v-model="dialog" persistent max-width="450">
      <template v-slot:activator="{ on, attrs }">
        <v-btn small color="red white--text" v-bind="attrs" v-on="on">
            <v-icon>{{ icon }}</v-icon>
        </v-btn>
      </template>
      <v-card>
        <v-card-title class="headline justify-center">{{ header }}</v-card-title>
        <v-card-text class="text-center justify-center">
          {{ text }}
        </v-card-text>
        <v-card-actions>
          <v-btn color="red" text v-on:click="cancel">Cancel</v-btn>
          <v-spacer></v-spacer>
          <v-btn color="green" text v-on:click="performAction">Proceed</v-btn>
        </v-card-actions>   
      </v-card>
    </v-dialog>
</template>
<script>
export default {
  props: {
    header: {
      type:String,
      default: "Delete this Item?"
    },
    text: {
      type: String,
      default: "This process is irreversible, Proceed with caution"
    },
    icon: {
      type: String,
      default: 'mdi-delete'
    }
  },
  data() {
    return {
      dialog: false,
    };
  },
  methods: {
      cancel() {
          this.dialog = false;
      },
      performAction() {
          this.$emit('performAction');
          this.dialog = false;
      }
  }
};
</script>