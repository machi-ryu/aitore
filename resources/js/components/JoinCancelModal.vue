<template>
  <div>
        <!--  クリック要素  -->
        <button v-if="is_join == true" v-on:click="open" class="btn btn-secondary">参加キャンセル</button>

        <!--  モーダルウィンドウ  -->
        <div v-show="show" class="modal_contents">
            <!-- モーダルウィンドウの背景 -->
            <div v-on:click="close" class="modal_contents_bg"></div>
            <!--   モーダルウィンドウの中身   -->
            <div class="modal_contents_wrap">
                <p>参加キャンセルしますか？</p>
                <!--   モーダルウィンドウを閉じる   -->
                <button v-on:click="close" class="btn btn-outline-primary">いいえ</button>
                <form method="POST" :action="action">
                    <input type="hidden" name="_token" :value="csrf">
                    <button type="submit" class="btn btn-primary">はい</button>
                </form>
            </div>
        </div>

  </div>
</template>

<script>
  export default {
    name: 'JoinCancelModal',
    props: ['action', 'is_join'],
    data() {
      return {
  //デフォルトはモーダルウィンドウを閉じる
      show: false,
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    }
    },
    methods:{
  //モーダルウィンドウを開く要素をクリックしたら
      open: function(){
        this.show = true
      },
  //モーダルウィンドウを閉じる要素をクリックしたら
      close: function(){
        this.show = false
      },
    },
  }
</script>

<style scoped>
/* モーダルウィンドウを開く要素 */
.modal_open_btn {
    display: inline-block;
    cursor: pointer;
    padding-top: 30px;
  }
  /* モーダルウィンドウ要素 */
  .modal_contents {
    position: absolute;
    top: 0;
    left: 0;
    z-index:100;
    width: 100%;
    height: 100%;
    width: 100%;
  }
  /* モーダルウィンドウの背景要素 */
  .modal_contents_bg {
    background: rgba(0,0,0,.8);
    width: 100%;
    height: 100%;
  }
  /* モーダルウィンドウの中身*/
  .modal_contents_wrap {
    position: absolute;
    top: 50%;
    left: 50%;
    background-color: #fff;
    width: 50%;
    height: 50%;
    margin: auto;
    transform: translate(-50%,-50%);
    padding: 30px;
  }
  /* モーダルウィンドウを閉じる要素 */
  .modal_close_btn {
    display: inline-block;
    cursor: pointer;
    margin-top: 10px;
  }
</style>
