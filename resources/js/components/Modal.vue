
<script>
  export default {
    data() {
      return {
  //デフォルトはモーダルウィンドウを閉じる
      show: false
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
    }
  }
</script>
