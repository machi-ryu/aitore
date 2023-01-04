@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3"><h2>自主トレ詳細</h2></div>
    @auth
        <div class="col-md-1">
            <a class="btn btn-outline-primary h-100 d-flex align-items-center" href="{{ route('edit', ['id' => $post->id]) }}">編集</a>
        </div>
    @endauth

</div>


<div class="row row-top">
    {{-- 左部分 --}}
    <div class="column-left col-md-5">
        <div>{{ $post->title }}</div>
        <div>{{ $post->start_datetime }}</div>
        <div>{{ $post->end_datetime }}</div>
        <!-- <div v-if="{{ $post->thumbnail }}">
            <img src="{{ asset('storage/thumbnail/' . $post->thumbnail) }}">
        </div>
        <div v-else>
            <img src="{{ asset('images/no_image.png') }}">
        </div> -->
        <div><img src="{{ asset($post->thumbnail) }}"></div>
    </div>

    {{-- 右部分 --}}
    <div class="column-right col-md-5">
        <div class="card menu">
            <div class="body">
                {{ $post->menu_category }}
            </div>
        </div>
        <div class="card place">
            <div class="body">
                {{ $post->address }}
            </div>
        </div>
        <div class="card comment">
            <div class="body">
                {{ $post->comment }}
            </div>
        </div>
    </div>
</div>

<!-- 参加ボタン -->
<div class="d-grid gap-2 col-6 mx-auto">
    <div id="join_modal">
        <!--  クリック要素  -->
        <!-- <span v-on:click="open" class="modal_open_btn">ここをクリック!!</span> -->
        <button v-show="{{ !$is_join }}" v-on:click="open" class="modal_open_btn btn btn-primary">参加する</button>

        <!--  モーダルウィンドウ  -->
        <div v-show="show" class="modal_contents">
            <!-- モーダルウィンドウの背景 -->
            <div v-on:click="close" class="modal_contents_bg"></div>
            <!--   モーダルウィンドウの中身   -->
            <div class="modal_contents_wrap">
                <p>モーダルウィンドウ</p>
                <form method="POST" action="{{ route('join.store', ['id' => $post->id]) }}">
                    @csrf
                    <input type="radio" class="btn-check" name="join_level" value="1" id="join_level1" checked>
                    <label class="btn btn-outline-secondary form-control" for="join_level1">絶対いく</label>
                    <input type="radio" class="btn-check" name="join_level" value="2" id="join_level2">
                    <label class="btn btn-outline-secondary form-control" for="join_level2">たぶんいける</label>
                    <input type="radio" class="btn-check" name="join_level" value="3" id="join_level3">
                    <label class="btn btn-outline-secondary form-control" for="join_level3">きびしめだが、いきたい</label>

                    <!--   モーダルウィンドウを閉じる   -->
                    <button v-on:click="close" class="btn btn-outline-primary">キャンセル</button>

                    <button type="submit" class="btn btn-primary">送信</button>
                </form>
            </div>
        </div>
    </div>

    <!-- 参加キャンセル(参加してる場合にキャンセルボタンが表示される) -->
    <div id="join_cancel">
        <button v-show="{{ $is_join }}" v-on:click="open" class="btn btn-secondary">参加キャンセル</button>

        <!--  モーダルウィンドウ  -->
        <div v-show="show" class="modal_contents">
            <!-- モーダルウィンドウの背景 -->
            <div v-on:click="close" class="modal_contents_bg"></div>
            <!--   モーダルウィンドウの中身   -->
            <div class="modal_contents_wrap">
                <p>参加キャンセルしますか？</p>
                <!--   モーダルウィンドウを閉じる   -->
                <button v-on:click="close" class="btn btn-outline-primary">いいえ</button>
                <form method="POST" action="{{ route('join.cancel', ['id' => $post->id]) }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">はい</button>
                </form>
            </div>
        </div>
    </div>

</div>







@endsection
