<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Models\JisyutorePost;
use App\Models\Join;
use App\Models\Line;
use App\Models\Station;

class AitoreController extends Controller
{
    // public function index()
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
        $query_posts->where('start_datetime', '>=', $today)
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
        $query_history->where('start_datetime', '<', $today)
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

        return view('index', compact(['posts', 'history_posts', 'stations']));
    }


    public function show($id)
    {
        $post = JisyutorePost::find($id);

        $join = Join::where('jisyutore_post_id', $id)
                    ->where('user_id', Auth::id())
                    ->first();

        $start_datetime = $post->startTimeFormat($post->start_datetime);
        $end_datetime = $post->endTimeFormat($post->end_datetime);

        // レコードある場合
        if ($join) {
            if ($join->join_done_kubun == '1') {
                $is_join = true;
            } else {
                $is_join = false;
            }
        } else {
            $is_join = false;
        }

        // return view('show', compact('post'));
        return view('show', compact('post', 'is_join', 'start_datetime', 'end_datetime'));
    }

    public function create()
    {
        $lines = Line::all();
        // $lines = Line::get()->toArray();
        // $lines = Line::get()->toJson();
        $stations = Station::all();

        return view('create', compact('lines', 'stations'));
    }


    /**
     * 自主練の投稿
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $post = new JisyutorePost;
        $data = $request->all();

        // ディレクトリに画像を保存
        $file_name = $request->file('thumbnail')->getClientOriginalName();
        $image = $request->file('thumbnail')->storeAs('public/thumbnail', $file_name);

        // フォームから入らない値をセット
        $data['thumbnail'] = $file_name;
        $data['nearest_station'] = '9999';
        $data['user_id'] = Auth::id();

        $post->fill($data)->save();
        return redirect(route('index'));
    }


    /**
     * 自主練の投稿編集の画面
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
        $post = JisyutorePost::find($id);
        return view('edit', compact('post'));
    }


    /**
     * 自主練の投稿編集
     * @param Request $request
     * @return void
     */
    public function update(Request $request, $id)
    {
        $post = JisyutorePost::find($id);
        $data = $request->all();

        // ディレクトリに画像を保存
        if ($request->file('thumbnail')) {
            $file_name = $request->file('thumbnail')->getClientOriginalName();
            $image = $request->file('thumbnail')->storeAs('public/thumbnail', $file_name);
            $data['thumbnail'] = $file_name;
        }

        // フォームから入らない値をセット
        // $data['nearest_station'] = '9999';
        // $data['user_id'] = Auth::id();

        $post->fill($data)->save();
        return redirect(route('index'));
    }


    /**
     * 自主練の投稿削除
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        $post = JisyutorePost::find($id);
        $post->delete();

        return redirect(route('index'));
    }


    /**
     * 参加の登録
     */
    public function joinStore(Request $request, $id)
    {
        Join::updateOrCreate(
            [
                'jisyutore_post_id' => $id,
                'user_id' => Auth::id(),
            ],
            [
                'join_level' => $request->input('join_level'),
                'join_done_kubun' => '1',
            ],
        );

        // 最後は予定ベー時(マイページ)一覧へ飛ばす。今はとりあえずindexへ。
        return redirect(route('mypage.index'));
    }


    /**
     * 参加キャンセル
     */
    public function joinCancel($id)
    {
        $join = Join::where('jisyutore_post_id', $id)
                    ->where('user_id', Auth::id())
                    ->update(['join_done_kubun' => '0']);

        return redirect(route('mypage.index'));
    }
}
