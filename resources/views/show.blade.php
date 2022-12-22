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
        <div><img src="{{ asset('storage/thumbnail/' . $post->thumbnail) }}"></div>
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
