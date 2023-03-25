<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Models\JisyutorePost;

class MyPageController extends Controller
{
    /**
     * 予定一覧
     */
    public function index()
    {
        $today = date('ymd');

        // 予定
        $posts = JisyutorePost::withCount([
            'joins as level1_count' => function (Builder $query) {
                $query->where('join_level', '1')->where('join_done_kubun', '1');
            },
            'joins as level2_count' => function (Builder $query) {
                $query->where('join_level', '2')->where('join_done_kubun', '1');
            },
            'joins as level3_count' => function (Builder $query) {
                $query->where('join_level', '3')->where('join_done_kubun', '1');
            },
            'joins as total_count' => function (Builder $query) {
                $query->where('join_done_kubun', '1');
            },
            ])
            ->Join('joins', 'jisyutore_posts.id', '=', 'joins.jisyutore_post_id')
            ->where('joins.user_id', Auth::id())
            ->where('joins.join_done_kubun', '1')
            ->where('start_datetime', '>=', $today)
            ->orderBy('start_datetime')->get();

        // 履歴
        $history_posts = JisyutorePost::withCount([
            'joins as level1_count' => function (Builder $query) {
                $query->where('join_level', '1')->where('join_done_kubun', '1');
            },
            'joins as level2_count' => function (Builder $query) {
                $query->where('join_level', '2')->where('join_done_kubun', '1');
            },
            'joins as level3_count' => function (Builder $query) {
                $query->where('join_level', '3')->where('join_done_kubun', '1');
            },
            'joins as total_count' => function (Builder $query) {
                $query->where('join_done_kubun', '1');
            },
            ])
            ->Join('joins', 'jisyutore_posts.id', '=', 'joins.jisyutore_post_id')
            ->where('joins.user_id', Auth::id())
            ->where('joins.join_done_kubun', '1')
            ->where('start_datetime', '<', $today)
            ->orderBy('start_datetime', 'desc')->get();

        return view('mypage.index', compact(['posts', 'history_posts']));
    }


    /**
     * 予定表へのデータ表示API
     */
    public function getEvents()
    {
        $my_posts = JisyutorePost::Join('joins', 'jisyutore_posts.id', '=', 'joins.jisyutore_post_id')
                    ->where('joins.user_id', Auth::id())
                    ->where('joins.join_done_kubun', '1')
                    ->get()->toArray();

        return $my_posts;
    }

}
