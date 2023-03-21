@extends('layouts.app')

@section('content')
<div class="row">
    <!-- <div class="col-md-3"><h4>自主トレ一覧</h4></div> -->
    <div class="page-title col-md-3">自主トレ一覧</div>
    <div class="col-md-1">
        <a class="btn btn-outline-primary h-100 d-flex align-items-center" href="{{ route('create') }}">投稿</a>
    </div>
    <div class="col-md-1">
        <a class="btn btn-outline-primary h-100 d-flex align-items-center" href="{{ route('mypage.index') }}">予定</a>
    </div>
    <div class="col-md-1">
        <a class="btn btn-outline-primary h-100 d-flex align-items-center" href="#">検索</a>
    </div>
</div>

@foreach($posts as $post)
    <div class="row mt-2">
        <!-- <div class="card col-md-10 mx-auto"> -->
        <div class="card">
            <div class="card-body row post-card">
                <img class="col-md-2 index_image" src="{{ asset($post->thumbnail) }}">
                <div class="col-md-6">
                    <!-- <div class="datetime">{{ $post->start_datetime }}〜{{ $post->end_datetime }}</div> -->
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
                <div class="col-md-4">
                    <div>
                        <div class="right">
                            <div class="user_icon">
                                <img src="{{ asset($post->user->icon) }}">
                            </div>
                            <div class="user_name">{{ $post->user->name }}</div>
                        </div>
                        <div class="updated_at right">
                            <i class="bi bi-clock"></i>
                            {{ $post->updatedatFormat($post->updated_at) }}
                        </div>
                    </div>
                    <div class="row clear">
                        <div class="col-md-6">
                            <!-- <div>{{ $post->comment }}</div> -->
                            <div>参加人数 {{ $post->total_count }}人</div>
                            <div>
                                (
                                <i class="bi bi-emoji-laughing"></i>{{ $post->level1_count }}
                                <i class="bi bi-emoji-smile"></i>{{ $post->level2_count }}
                                <i class="bi bi-emoji-expressionless"></i>{{ $post->level3_count }}
                                )
                            </div>
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <!-- <div>ユーザー名、アイコン {{ $post->user_id }}</div> -->
                            <a class="btn btn-outline-primary h-100 d-flex align-items-center" href="{{ route('show', ['id' => $post->id]) }}">詳細</a>
                            <!-- <a class="btn btn-outline-secondary h-100 d-flex align-items-center" href="{{ route('destroy', ['id' => $post->id]) }}">削除</a> -->
                            <delete-modal
                            action="{{ route('destroy', ['id' => $post->id]) }}"
                            ></delete-modal>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection
