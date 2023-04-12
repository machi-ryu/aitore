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
          <v-btn
            append-icon="mdi-hand-back-right-outline"
            elevation="4"
            size="large"
            rounded="xl"
            >参加する
          </v-btn>
        </div>
        <!-- </v-btn> -->
      </template>

      <v-card>
        <form method="POST" v-bind:action="action">
          <v-card-title>どれくらい参加できる？</v-card-title>
          <v-card-text style="height:150">
            <input type="hidden" name="_token" :value="csrf">

            <input type="radio" class="btn-check" name="join_level" value="1" id="join_level1" checked>
            <label class="btn btn-outline-secondary form-control" for="join_level1">絶対いく</label>
            <input type="radio" class="btn-check" name="join_level" value="2" id="join_level2">
            <label class="btn btn-outline-secondary form-control" for="join_level2">たぶんいける</label>
            <input type="radio" class="btn-check" name="join_level" value="3" id="join_level3">
            <label class="btn btn-outline-secondary form-control" for="join_level3">きびしめだが、いきたい</label>
            <!-- <v-radio-group>
            <v-radio
              v-for="(value, key) in join_list"
              :key="key"
              :value="key"
              :label="value"
            ></v-radio>
            </v-radio-group> -->

          </v-card-text>
          <v-card-actions>
            <!-- <v-btn color="primary" @click="toShow(event.jisyutore_post_id)">詳細</v-btn> -->
            <!-- <button type="submit" class="btn btn-primary">送信</button> -->
            <v-btn type="submit">送信</v-btn>
            <v-btn text @click="dialog = false">閉じる</v-btn>
            <!-- <a :href="`/show/${event.jisyutore_post_id}`">詳細</a> -->
          </v-card-actions>
        </form>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
  export default {
    name: 'JoinModal',
    props: ['action', 'is_join'],
    data() {
      return {
        dialog: false,
        join_list: [
          '絶対いく',
          'たぶんいける',
          'きびしめだが、いきたい',
        ],
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    }
    },
    methods:{

    },
  }
</script>

<style scoped>
</style>
