@extends('layouts.app')

@section('content')
<h2>自主トレ投稿編集</h2>

<form method="POST" action="{{ route('update', ['id' => $post->id]) }}" enctype="multipart/form-data">
    @csrf
    <div class="row row-top">
        {{-- 左部分 --}}
        <div class="column-left col-md-5">
            <label class="form-label">タイトル</label>
            <input class="form-control" type="text" name="title" value="{{ $post->title }}">
            <!-- <div id="datetime">
                <label class="form-label" for="datetime">日時</label>
                <input class="form-control" type="datetime-local" name="start_datetime" v-model="start" @change="inputDatetime">
                <input class="form-control" type="datetime-local" name="end_datetime" v-bind:value="value">
            </div> -->
            <date-time
                start="{{ $post->start_datetime }}"
                end="{{ $post->end_datetime }}"
            ></date-time>
            <preview
                image_path="{{ asset($post->thumbnail) }}"
            ></preview>
        </div>

        {{-- 右部分 --}}
        <div class="column-right col-md-5">
            <div class="menu">
                <label class="form-label" for="date">メニュー</label>
                <!-- <input class="form-control" type="text" name="menu"> -->
                <select class="form-control" name="menu_category">
                    @foreach (Config::get('const.menu_category') as $key => $value)
                        <option value="{{ $key }}"
                            @if ($post->menu_category == $key)
                                selected
                            @endif
                        >{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <div class="place">
                <select-station
                    selected_line="{{ $post->station->line_id }}"
                    selected_station="{{ $post->station_id }}"
                ></select-staion>
            </div>
            <div class="address">
                <google-map
                    address="{{ $post->address }}"
                    style="height:100%; width:100%;"
                ></google-map>
            </div>
            <div class="comment">
                <label class="form-label" for="date">コメント</label>
                <!-- <input class="form-control" type="textarea" name="comment"> -->
                <textarea class="form-control" name="comment">{{ $post->comment }}</textarea>
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
