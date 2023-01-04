<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\JisyutorePost;

class Join extends Model
{
    use HasFactory;

    protected $table = 'joins';

    protected $fillable = [
        'jisyutore_post_id',
        'user_id',
        'join_level',
        'join_done_kubun',
    ];


    /**
     * 参加数を格納した配列
     */
    public function arrayJoinCount()
    {
        $join_count = [];
        $posts = JisyutorePost::all();
        foreach ($posts as $post) {
            $join_count[$post->id] = [];
            $join_count[$post->id][1] = [];
            $join_count[$post->id][2] = [];
            $join_count[$post->id][3] = [];
        }
        $joins = Join::Select('jisyutore_post_id', 'join_level', DB::raw('count(*) as count'))
                    ->where('join_done_kubun', '=', '1')
                    ->groupBy('jisyutore_post_id', 'join_level')
                    ->get();
        foreach ($joins as $join) {
            // post_idが配列にない場合に初期化する
            // !array_key_exists($join->jisyutore_post_id, $join_count) ? $join_count[$join->jisyutore_post_id] = [] : null;
            // $join_count[$join->jisyutore_post_id][$join->join_level] = [];
            $join_count[$join->jisyutore_post_id][$join->join_level] = $join->count;
        }
        return $join_count;

        // array_keyで存在確認してから、ない場合0を返すも入れる
    }
}
