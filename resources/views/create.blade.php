@extends('layouts.app')

@section('content')
<h2>自主トレ投稿</h2>

<!-- <div id="preview">
    @{{ message }}
                <input type="file" name="file" ref="preview" @change="show">
                <div class="preview-box" v-if="url">
                    <img class="image-preview" v-bind:src="url">
                </div>
</div> -->

<form method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row row-top">
        {{-- 左部分 --}}
        <div class="column-left col-md-5">
            <label class="form-label">タイトル</label>
            <input class="form-control" type="text" name="title">
            <div id="datetime"></div>
            <div id="preview"></div>
        </div>

        {{-- 右部分 --}}
        <div class="column-right col-md-5">
            <div class="menu">
                <label class="form-label" for="date">メニュー</label>
                <!-- <input class="form-control" type="text" name="menu"> -->
                <select class="form-control" name="menu_category">
                    @foreach (Config::get('const.menu_category') as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <div class="place">
                <label class="form-label" for="date">場所</label>
                <input class="form-control" type="text" name="address">
            </div>
            <div class="comment">
                <label class="form-label" for="date">コメント</label>
                <!-- <input class="form-control" type="textarea" name="comment"> -->
                <textarea class="form-control" name="comment"></textarea>
            </div>
        </div>
    </div>
    <div class="d-grid gap-2 col-6 mx-auto page-bottom">
        <button type="submit" class="btn btn-primary">投稿</button>
    </div>
</form>

<!-- <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script> -->
<!-- <script>
let app = new Vue({
  el: '#preview',
  data: {
    message: 'Hello Vue!'
  }
})
</script> -->

@endsection
