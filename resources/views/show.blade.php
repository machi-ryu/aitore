@extends('layouts.app')

@section('content')
<h2>自主トレ一詳細</h2>


<div class="row row-top">
    {{-- 左部分 --}}
    <div class="column-left col-md-5">
        <div>{{ $post->title }}</div>
        <div>{{ $post->start_datetime }}</div>
        <div>{{ $post->end_datetime }}</div>
        <div><img src="{{ asset('/images/sample.jpg') }}"></div>
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
<div class="d-grid gap-2 col-6 mx-auto">
    <button class="btn btn-primary">参加する</button>
</div>







@endsection
