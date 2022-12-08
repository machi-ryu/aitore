@extends('layouts.app')

@section('content')
<h2>自主トレ一詳細</h2>


<div class="row">
    {{-- 左部分 --}}
    <div class="column-left col-md-6">
        <div>{{ $post->title }}</div>
        <div>{{ $post->start_datetime }}</div>
        <div>{{ $post->end_datetime }}</div>
        <div>{{ $post->address }}</div>
    </div>

    {{-- 右部分 --}}
    <div class="column-right col-md-6">
        <div class="card h-25">
            <div class="body">
                {{ $post->menu_category }}
            </div>
        </div>
        <div class="card">
            <div class="body">
                {{ $post->address }}
            </div>
        </div>
        <div class="card">
            <div class="body">
                {{ $post->comment }}
            </div>
        </div>
    </div>



</div>







@endsection
