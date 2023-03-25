@extends('layouts.app')

@section('content')
<div class="row">
    <div class="page-title col-md-3">自主トレ詳細</div>
</div>

<!-- <div class="row row-top"> -->
<div class="row mt-2">
    {{-- 左部分 --}}
    <div class="column-left col-md-5">
        <div class="h3">{{ $post->title }}</div>
        <div class="date-time">
            <div class="border-bottom w-25">時間</div>
            <div class="m-2">
                {{ $start_datetime }}
                 〜
                {{ $end_datetime }}
            </div>
        </div>
        <div class="menu">
            <div class="border-bottom w-25">メニュー</div>
            <div class="m-2">
                {{ Config::get('const.menu_category')[$post->menu_category] }}
            </div>
        </div>
        <div class="thumbnail">
            <div class="m-2">
                <img src="{{ asset($post->thumbnail) }}">
            </div>
        </div>
    </div>

    {{-- 右部分 --}}
    <div class="column-right col-md-5">
        <div class="comment">
            <div class="border-bottom w-25">詳細</div>
            <div class="m-2">
                {{ $post->comment }}
            </div>
        </div>
        <div class="station">
            <div class="border-bottom w-25">最寄駅</div>
            <div class="m-2">
                {{ $post->station->station_name }} /
                {{ $post->station->line->line_name }}
            </div>
        </div>
        <div class="address">
            <div class="border-bottom w-25">地図</div>
            <div class="map m-2">
                <!-- <div id="map"></div> -->
                <!-- <google-map style="height:100%; width:100%"></google-map> -->
                <google-map
                    address="{{ $post->address }}"
                    style="height:100%; width:100%"
                ></google-map>
            </div>
        </div>
    </div>
</div>

<!-- 参加ボタン -->
<div class="d-grid gap-2 col-6 mx-auto">
    <join-modal
    action="{{ route('join.store', ['id' => $post->id]) }}"
    is_join="{{ $is_join }}"
    ></join-modal>

    <!-- 参加キャンセル(参加してる場合にキャンセルボタンが表示される) -->
    <join-cancel-modal
    action="{{ route('join.cancel', ['id' => $post->id]) }}"
    is_join="{{ $is_join }}"
    ></join-cancel-modal>

</div>






@endsection
