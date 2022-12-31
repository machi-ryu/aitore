@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3"><h2>マイページ</h2></div>
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

@foreach($posts as $post)
    <div class="row mt-2">
        <div class="card col-md-10 mx-auto">
            <div class="card-body row">
                <div class="col-md-3">
                    <div>{{ $post->start_datetime }}</div>
                    <div>{{ $post->end_datetime }}</div>
                </div>
                <div class="col-md-3">
                    画像
                </div>
                <div class="col-md-5">
                    <div>{{ $post->title }}</div>
                    <div>{{ $post->address }}</div>
                    <div>{{ $post->comment }}</div>
                </div>
                <div class="col-md-1 d-flex align-items-center">
                    <a class="btn btn-outline-primary h-100 d-flex align-items-center" href="{{ route('show', ['id' => $post->jisyutore_post_id]) }}">詳細</a>
                    <a class="btn btn-outline-secondary h-100 d-flex align-items-center" href="{{ route('destroy', ['id' => $post->jisyutore_post_id]) }}">削除</a>
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection
