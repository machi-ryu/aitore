<template>
  <div class="text-center">
    <v-dialog
      v-model="dialog"
      scrollable
      width="400"
    >
      <template v-slot:activator="{ props }">
        <!-- <v-btn -->
        <div
          class="hidden"
          color="primary"
          v-bind="props"
          width="100%"
        >
          <!-- Open Dialog -->
          {{ event.start_time }}
          {{ event.title }}
        </div>
        <!-- </v-btn> -->
      </template>

      <v-card>
        <v-card-text style="height:150">
          <!-- Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. -->
          <div>{{ event.start_time }}</div>
          <div>{{ event.title }}</div>
          <div>{{ event.comment }}</div>
        </v-card-text>
        <v-card-actions>
          <v-btn color="primary" @click="toShow(event.jisyutore_post_id)">詳細</v-btn>
          <v-btn text @click="dialog = false">閉じる</v-btn>
          <!-- <a :href="`/show/${event.jisyutore_post_id}`">詳細</a> -->
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
  export default {
    props: ['event'],
    data () {
      return {
        dialog: false,
      }
    },
    methods: {
      toShow(post_id) {
        location.href = '/show/' + post_id;
      }
    },
  }
</script>

<style scoped>
/* v-btn {
  height: 25px;
  overflow: hidden;
} */
</style>
