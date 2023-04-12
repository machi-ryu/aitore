<template>
  <div class="text-center">
    <v-dialog v-model="dialog" scrollable width="400" > <template v-slot:activator="{ props }"> <!-- <v-btn --> <div class="hidden"
          color="primary"
          v-bind="props"
          width="100%"
        >
          <!-- Open Dialog -->
          <button class="btn btn-outline-secondary h-100 d-flex align-items-center justify-content-center">
            <i class="bi bi-trash">削除</i>
          </button>
        </div>
        <!-- </v-btn> -->
      </template>

      <v-card>
        <form method="GET" :action="action">
          <v-card-title>削除しますか？</v-card-title>
          <v-card-actions class="row">
              <input type="hidden" name="_token" :value="csrf">
              <div class="col-sm">
                <v-btn block type="submit">はい</v-btn>
              </div>
              <div class="col-sm">
                <v-btn block @click="dialog = false">いいえ</v-btn>
              </div>
          </v-card-actions>
        </form>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
  export default {
    name: 'DeleteModal',
    props: ['action'],
    data() {
      return {
        dialog: false,
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    }
    },
    methods:{
    },
  }
</script>

<style scoped>
</style>
