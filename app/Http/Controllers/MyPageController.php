<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Models\JisyutorePost;
use App\Models\Station;

class MyPageController extends Controller
{
    /**
     * 予定一覧
     */
    public function index(Request $request)
    {
        $today = date('ymd');
        $menu_category = $request->input('menu_category');
        $station_ids = $request->input('stations');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $keyword = $request->input('keyword');

        $jisyutore_post = new JisyutorePost();
        $query_posts = $jisyutore_post->getIndex();

        // 予定データ取得
        $query_posts->leftJoin('joins', 'jisyutore_posts.id', '=', 'joins.jisyutore_post_id')
        ->where('start_datetime', '>=', $today)
        ->where(function (Builder $query) {
            $query->where('joins.user_id', Auth::id())
                ->where('joins.join_done_kubun', '1')
                ->orWhere('jisyutore_posts.user_id', Auth::id());
        })
        ->orderBy('start_datetime');
        if (($menu_category != null) && ($menu_category != '00')) {
           $query_posts->where('menu_category', $menu_category);
        }
        if ($station_ids) {
            $query_posts->whereIn('station_id', $station_ids);
        }
        if ($start_date) {
            $query_posts->where('start_datetime', '>=', $start_date);
        }
        if ($end_date) {
            $query_posts->where('start_datetime', '<=', $end_date);
        }
        if ($keyword) {
            $query_posts->where(function (Builder $query) use ($keyword) {
                $query->orWhere('title', 'like', '%' . $keyword . '%')
                    ->orWhere('station_name', 'like', '%' . $keyword . '%')
                    ->orWhere('users.name', 'like', '%' . $keyword . '%');
            });
        }
        $posts = $query_posts->get();

        // 履歴データ取得
        $query_history = $jisyutore_post->getIndex();
        $query_history->leftJoin('joins', 'jisyutore_posts.id', '=', 'joins.jisyutore_post_id')
        ->where('start_datetime', '<', $today)
        ->where(function (Builder $query) {
            $query->where('joins.user_id', Auth::id())
                ->where('joins.join_done_kubun', '1')
                ->orWhere('jisyutore_posts.user_id', Auth::id());
        })
        ->orderBy('start_datetime', 'desc');
        if (($menu_category != null) && ($menu_category != '00')) {
           $query_history->where('menu_category', $menu_category);
        }
        if ($station_ids) {
            $query_history->whereIn('station_id', $station_ids);
        }
        if ($end_date) {
            $query_history->where('start_datetime', '<=', $end_date);
        }
        if ($keyword) {
            $query_history->where(function (Builder $query) use ($keyword) {
                $query->orWhere('title', 'like', '%' . $keyword . '%')
                    ->orWhere('station_name', 'like', '%' . $keyword . '%')
                    ->orWhere('users.name', 'like', '%' . $keyword . '%');
            });
        }
        $history_posts = $query_history->get();

        // station取得
        $stations = Station::all();

        return view('mypage.index', compact(['posts', 'history_posts', 'stations']));
    }


    /**
     * 予定表へのデータ表示API
     */
    public function getEvents()
    {
        $my_posts = JisyutorePost::Join('joins', 'jisyutore_posts.id', '=', 'joins.jisyutore_post_id')
                    ->where('joins.user_id', Auth::id())
                    ->where('joins.join_done_kubun', '1')
                    ->orWhere('jisyutore_posts.user_id', Auth::id())
                    ->get()->toArray();

        return $my_posts;
    }

}
