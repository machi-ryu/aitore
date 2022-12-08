@extends('layouts.app')

@section('content')
<h2>自主トレ一覧</h2>


@foreach($posts as $post)
    <div class="row">
        <div class="card col-md-6">
            <div class="card-header">
                <div>{{ $post->title }}</div>
            </div>
            <div class="card-body">
                <div>{{ $post->start_datetime }}</div>
                <div>{{ $post->end_datetime }}</div>
                <div>{{ $post->address }}</div>
                <a href="{{ route('show', ['id' => $post->id]) }}">詳細</a>
            </div>
        </div>
    </div>
@endforeach







@endsection
