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
    public function index()
    {
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
            ])->get();

        return view('index', compact('posts'));
    }


    public function show($id)
    {
        $post = JisyutorePost::find($id);

        $join = Join::where('jisyutore_post_id', $id)
                    ->where('user_id', Auth::id())
                    ->first();
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
        return view('show', compact('post', 'is_join'));
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
