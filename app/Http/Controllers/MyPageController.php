<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JisyutorePost;

class MyPageController extends Controller
{
    /**
     * 予定一覧
     */
    public function index()
    {
        $posts = JisyutorePost::Join('joins', 'jisyutore_posts.id', '=', 'joins.jisyutore_post_id')
                    ->where('joins.user_id', Auth::id())
                    ->where('joins.join_done_kubun', '1')
                    ->get();
        // $posts = $join->jisyutorepost;

        return view('mypage.index', compact('posts'));
    }
}
