@extends('layouts.app')

@section('content')
<div class="page-title">自主トレ投稿</div>

<!-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif -->

<form method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
    @csrf
    <!-- <div class="row row-top"> -->
    <div class="row post-row">
        {{-- 左部分 --}}
        <div class="column-left col-md-5">
            <label class="form-label">タイトル</label>
            @error('title')<span class="ms-3 text-danger">{{ $message }}</span>@enderror
            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{ old('title') }}">
            <div id="datetime"></div>
            <div id="preview"></div>
            <date-time
                start="{{ old('start_datetime') }}"
                end="{{ old('end_datetime') }}"
                is-invalid-start="@error('start_datetime') true @enderror"
                is-invalid-end="@error('end_datetime') true @enderror"
                error-message="@error('start_datetime') {{ $message }} @enderror"
            ></date-time>
            <preview
                image_path="{{ asset('/images/no_image.png') }}"
                preview-path="{{ old('thumbnail') }}"
            ></preview>
        </div>

        {{-- 右部分 --}}
        <div class="column-right col-md-5">
            <div class="menu">
                <label class="form-label" for="date">メニュー</label>
                <select class="form-control" name="menu_category" value="{{ old('menu_category', '00') }}">
                <!-- <select class="form-control" name="menu_category"> -->
                    @foreach (Config::get('const.menu_category') as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <div class="place">
                <select-station
                    selected_line="{{ old('line_id', 0) }}"
                    selected_station="{{ old('station_id', 0) }}"
                ></select-staion>
            </div>
            <div class="comment">
                <label class="form-label">コメント</label>
                <textarea class="form-control post-comment" name="comment" value="{{ old('comment') }}"></textarea>
            </div>
            <div class="address">
                <google-map
                    address="{{ old('address', '神奈川県横浜市都筑区東山田町') }}"
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
