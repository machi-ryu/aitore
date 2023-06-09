@extends('layouts.app')

@section('content')
<div class="row">
    <div class="page-title col-md-auto"><h2>マイページ</h2></div>
    <div class="col-md-auto">
        <a class="btn btn-primary px-3" href="{{ route('create') }}">
            <i class="bi bi-pencil-square me-1"></i>
            投稿
        </a>
    </div>
    <div class="col-md-6">
        <ul class="tab-area">
            <li class="tab active">
                <i class="bi bi-list-task me-1"></i>一覧
            </li>
            <li class="tab">
                <i class="bi bi-calendar3 me-1"></i>カレンダー
            </li>
        </ul>
    </div>
</div>

<div class="panel-area">
    <!-- 一覧表示 -->
    <div class="panel active">

        <!-- 検索 -->
        <div class="row">
            <div class=col-xl-9>
                <search-component
                    route-index="{{ route('mypage.index') }}"
                    :stations="{{ json_encode($stations) }}"
                    :menu-categorys="{{ json_encode(Config::get('const.menu_category')) }}"
                ></search-component>
            </div>
        </div>

        <!-- 切り替えタブ -->
        <div class="row">
            <ul class="nav tab-area2 justify-content-center">
                <li class="tab2 px-5 pt-2 active">予定</li>
                <li class="tab2 px-5 pt-2">履歴</li>
            </ul>
        </div>

        <div class="">
            <!-- 予定 -->
            <div class="panel2 active">
                <div class="row">
                    <div class="col-xl-9">
                        @foreach($posts as $post)
                            <div
                                @guest
                                    class="card mb-2"
                                @else
                                    @if ($post->user_id == Auth::user()->id)
                                        class="card mb-2 organizer"
                                    @elseif ($post->joins_exists)
                                        class="card mb-2 joiner"
                                    @else
                                        class="card mb-2"
                                    @endif
                                @endguest
                            >
                                <div class="card-body row post-card">
                                    <div class="col-1 my-2 datetime">
                                            <div class="text-center my-3 lh-1">
                                                <div>{{ $post->startTimeYear($post->start_datetime) }}</div>
                                                <div class="fs-4">{{ $post->startTimeMonthDay($post->start_datetime) }}</div>
                                            </div>
                                            <div class="text-center lh-1">
                                                <div>{{ $post->startTime($post->start_datetime) }}</div>
                                                <div>〜</div>
                                                <div>{{ $post->endTimeFormat($post->end_datetime) }}</div>
                                            </div>
                                    </div>
                                    <div class="col-7 my-2 position-relative">
                                        <div class="index-station">
                                            <i class="bi bi-flag"></i>
                                            {{ $post->station->station_name }}
                                            /
                                            {{ $post->station->line->line_name }}
                                        </div>
                                        <div>
                                            <i class="bi bi-tag"></i>
                                            <span class="index-menu">{{ Config::get('const.menu_category')[$post->menu_category] }}</span>
                                        </div>
                                        <div class="index-title">
                                            {{ $post->title }}
                                        </div>
                                        <div class="index-join position-absolute bottom-0 start-0 ms-3">
                                            <i class="bi bi-people-fill"></i>
                                            参加 {{ $post->total_count }}人
                                            (
                                            <i class="bi bi-emoji-laughing"></i>{{ $post->level1_count }}
                                            <i class="bi bi-emoji-smile"></i>{{ $post->level2_count }}
                                            <i class="bi bi-emoji-expressionless"></i>{{ $post->level3_count }}
                                            )
                                        </div>
                                    </div>
                                    <img class="col-2 d-none d-md-block index_image" src="{{ asset($post->thumbnail) }}">
                                    <div class="col-2 h-100 position-relative">
                                        <div class="position-absolute top-0 end-0">
                                            <div class="updated_at">
                                                <i class="bi bi-clock"></i>
                                                {{ $post->updatedatFormat($post->updated_at) }}
                                            </div>
                                        </div>
                                        <div class="position-absolute bottom-50 end-0">
                                            <div class="">
                                                <div class="user_icon">
                                                    <img src="{{ asset($post->user->icon) }}">
                                                </div>
                                                <div class="user_name">
                                                    {{ $post->user->name }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="position-absolute bottom-0 end-0 w-100">
                                            <!-- <a class="btn btn-outline-primary h-100 d-flex align-items-center" href="{{ route('show', ['id' => $post->id]) }}">詳細</a> -->
                                            <a class="btn btn-outline-primary w-100" href="{{ route('show', ['id' => $post->id]) }}">詳細</a>
                                            <div class="d-flex">
                                                @if ($post->user_id == Auth::user()->id)
                                                    <a class="btn btn-primary" href="{{ route('edit', ['id' => $post->id]) }}">
                                                        <i class="bi bi-pencil-square"></i>
                                                        編集
                                                    </a>
                                                    <delete-modal
                                                        action="{{ route('destroy', ['id' => $post->id]) }}"
                                                    ></delete-modal>
                                                @endif
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="col-xl-3 border">
                        <!-- ランキング -->
                    </div>
                </div>
            </div>

            <!-- 履歴 -->
            <div class="panel2">
                <div class="row">
                    <div class="col-xl-9">
                        @foreach($history_posts as $post)
                            <div
                                @guest
                                    class="card mb-2"
                                @else
                                    @if ($post->user_id == Auth::user()->id)
                                        class="card mb-2 organizer"
                                    @elseif ($post->joins_exists)
                                        class="card mb-2 joiner"
                                    @else
                                        class="card mb-2"
                                    @endif
                                @endguest
                            >
                                <div class="card-body row post-card">
                                    <div class="col-1 my-2 datetime">
                                            <div class="text-center my-3 lh-1">
                                                <div>{{ $post->startTimeYear($post->start_datetime) }}</div>
                                                <div class="fs-4">{{ $post->startTimeMonthDay($post->start_datetime) }}</div>
                                            </div>
                                            <div class="text-center lh-1">
                                                <div>{{ $post->startTime($post->start_datetime) }}</div>
                                                <div>〜</div>
                                                <div>{{ $post->endTimeFormat($post->end_datetime) }}</div>
                                            </div>
                                    </div>
                                    <div class="col-7 my-2 position-relative">
                                        <div class="index-station">
                                            <i class="bi bi-flag"></i>
                                            {{ $post->station->station_name }}
                                            /
                                            {{ $post->station->line->line_name }}
                                        </div>
                                        <div>
                                            <i class="bi bi-tag"></i>
                                            <span class="index-menu">{{ Config::get('const.menu_category')[$post->menu_category] }}</span>
                                        </div>
                                        <div class="index-title">
                                            {{ $post->title }}
                                        </div>
                                        <div class="index-join position-absolute bottom-0 start-0 ms-3">
                                            <i class="bi bi-people-fill"></i>
                                            参加 {{ $post->total_count }}人
                                            (
                                            <i class="bi bi-emoji-laughing"></i>{{ $post->level1_count }}
                                            <i class="bi bi-emoji-smile"></i>{{ $post->level2_count }}
                                            <i class="bi bi-emoji-expressionless"></i>{{ $post->level3_count }}
                                            )
                                        </div>
                                    </div>
                                    <img class="col-2 d-none d-md-block index_image" src="{{ asset($post->thumbnail) }}">
                                    <div class="col-2 h-100 position-relative">
                                        <div class="position-absolute top-0 end-0">
                                            <div class="updated_at">
                                                <i class="bi bi-clock"></i>
                                                {{ $post->updatedatFormat($post->updated_at) }}
                                            </div>
                                        </div>
                                        <div class="position-absolute bottom-50 end-0">
                                            <div class="">
                                                <div class="user_icon">
                                                    <img src="{{ asset($post->user->icon) }}">
                                                </div>
                                                <div class="user_name">
                                                    {{ $post->user->name }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="position-absolute bottom-0 end-0 w-75">
                                            <!-- <a class="btn btn-outline-primary h-100 d-flex align-items-center" href="{{ route('show', ['id' => $post->id]) }}">詳細</a> -->
                                            <a class="btn btn-outline-primary w-100" href="{{ route('show', ['id' => $post->id]) }}">詳細</a>
                                            <!-- <delete-modal
                                            action="{{ route('destroy', ['id' => $post->id]) }}"
                                            ></delete-modal> -->
                                        </div>

                                    </div>

                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="col-xl-3 border">
                        <!-- ランキング -->
                    </div>
                </div>
            </div>
        </div>

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
        $('.tab2').on('click', function() {
            $('.tab2, .panel2').removeClass('active');

            $(this).addClass('active');

            var index = $('.tab2').index(this);
            $('.panel2').eq(index).addClass('active');
        });
    });
</script>
