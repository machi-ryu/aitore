@extends('layouts.app')

@section('content')
<div class="row">
    <div class="page-title col-md-3"><h2>マイページ</h2></div>
    <div class="col-md-1">
        <a class="btn btn-outline-primary h-100 d-flex align-items-center" href="{{ route('create') }}">投稿</a>
    </div>
    <div class="col-md-1">
        <a class="btn btn-outline-primary h-100 d-flex align-items-center" href="#">予定</a>
    </div>
    <div class="col-md-1">
        <a class="btn btn-outline-primary h-100 d-flex align-items-center" href="#">検索</a>
    </div>
</div>

<div class="row">
    <div>
        <ul class="tab-area">
            <li class="tab active">一覧</li>
            <li class="tab">カレンダー</li>
        </ul>
    </div>
</div>

<div class="panel-area">
    <!-- 一覧表示 -->
    <div class="panel active">
        @foreach($posts as $post)
            <div class="row mt-2">
                <div class="card">
                    <div class="card-body row post-card">
                        <img class="col-md-2 index_image" src="{{ asset($post->thumbnail) }}">
                        <div class="col-md-6">
                            <div class="datetime">
                                {{ $post->startTimeFormat($post->start_datetime) }}
                                〜
                                {{ $post->endTimeFormat($post->end_datetime) }}
                            </div>
                            <div><h4>{{ $post->title }}</h4></div>
                            <div class="menu_category">
                                {{ Config::get('const.menu_category')[$post->menu_category] }}
                                 |
                                {{ $post->station->station_name }}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <!-- <div>{{ $post->comment }}</div> -->
                            <div class="updated_at">
                                <i class="bi bi-clock"></i>
                                {{ $post->updatedatFormat($post->updated_at) }}
                            </div>
                            <div>参加人数</div>
                        </div>
                        <div class="col-md-2 d-flex align-items-center">
                            <a class="btn btn-outline-primary h-100 d-flex align-items-center" href="{{ route('show', ['id' => $post->jisyutore_post_id]) }}">詳細</a>
                            <a class="btn btn-outline-secondary h-100 d-flex align-items-center" href="{{ route('destroy', ['id' => $post->jisyutore_post_id]) }}">削除</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- カレンダー表示 -->
    <div class="panel">
        <calendar-app></calendar-app>
    </div>
</div>

@endsection

<script src="https://code.jquery.com/jquery.min.js"></script>
<script>
    $(function() {
        $('.tab').on('click', function() {
            $('.tab, .panel').removeClass('active');

            $(this).addClass('active');

            var index = $('.tab').index(this);
            $('.panel').eq(index).addClass('active');
        });
    });
</script>
