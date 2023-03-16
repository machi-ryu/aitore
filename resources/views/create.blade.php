@extends('layouts.app')

@section('content')
<div class="page-title">自主トレ投稿</div>

<form method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
    @csrf
    <!-- <div class="row row-top"> -->
    <div class="row post-row">
        {{-- 左部分 --}}
        <div class="column-left col-md-5">
        <!-- <div class="column-left"> -->
            <label class="form-label">タイトル</label>
            <input class="form-control" type="text" name="title">
            <div id="datetime"></div>
            <div id="preview"></div>
            <date-time></date-time>
            <preview
                image_path="{{ asset('/images/no_image.png') }}"
            ></preview>
        </div>

        {{-- 右部分 --}}
        <div class="column-right col-md-5">
        <!-- <div class="column-right"> -->
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
                <select-station
                    selected_line="0"
                    selected_station="0"
                ></select-staion>
            </div>
            <div class="comment">
                <label class="form-label">コメント</label>
                <textarea class="form-control post-comment" name="comment"></textarea>
            </div>
            <div class="address">
                <google-map
                    address="神奈川県横浜市都筑区東山田町"
                    style="height:90%; width:100%;"
                ></google-map>
            </div>
        </div>
    </div>
    <!-- <div class="d-grid gap-2 col-6 mx-auto page-bottom"> -->
    <div class="d-grid gap-2 post-btn">
        <button type="submit" class="btn btn-primary btn-lg">投稿</button>
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
