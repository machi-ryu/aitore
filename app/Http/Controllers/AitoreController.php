<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\JisyutorePost;
use App\Models\Join;

class AitoreController extends Controller
{
    public function index()
    {
        $posts = JisyutorePost::all();
        // $posts = JisyutorePost::orderBy('updated_at', 'desc')->get();
        return view('index', compact('posts'));
    }


    public function show($id)
    {
        $post = JisyutorePost::find($id);
        return view('show', compact('post'));
    }

    public function create()
    {
        return view('create');
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
        $join = new Join;
        // $data = $request->all();

        $data = [
            'jisyutore_post_id' => $id,
            'user_id' => Auth::id(),
            'join_level' => $request->input('join_level'),
            'join_done_kubun' => '1',
        ];
        $join->fill($data)->save();

        // 最後は予定ベー時(マイページ)一覧へ飛ばす。今はとりあえずindexへ。
        return redirect(route('index'));
    }
}
