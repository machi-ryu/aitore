<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Join;

class JisyutorePost extends Model
{
    use HasFactory;

    protected $table = 'jisyutore_posts';

    // protected $guarded = ['id'];
    protected $fillable = [
        'title',
        'thumbnail',
        'start_datetime',
        'end_datetime',
        'station_id',
        'menu_category',
        'address',
        'comment',
        'user_id',
    ];


    // public function eventDatetime($id)
    // {
    //     $post = JisyotorePost::find($id);
    //     $start_datetime = date('Y/m/d(aaa) hh:mm', strtotime($post->start_datetime));
    //     $end_datetime = date('hh:mm', strtotime($post->end_datetime));

    //     $event_datetime = $start_datetime . '〜' . $end_datetime;
    //     return $event_datetime;
    // }


    /**
     * 開始日時を加工
     */
    // public function getStartDatetimeAttribute($value)
    // {
    //     $day = date('w', strtotime($value));
    //     $week = ['日', '月', '火', '水', '木', '金', '土'];
    //     $start_datetime = date('Y/m/d (' . $week[$day] . ') H:i', strtotime($value));
    //     return $start_datetime;
    // }


    /**
     * 終了日時を加工
     */
    // public function getEndDatetimeAttribute($value)
    // {
    //     $end_datetime = date('H:i', strtotime($value));
    //     return $end_datetime;
    // }


    /**
     * 画像取得時に登録ない場合はno_image.pngをセット
     */
    public function getThumbnailAttribute($value)
    {
        if (empty($value)) {
            $thumbnail = 'images/no_image.png';
        } else {
            $thumbnail = 'storage/thumbnail/' . $value;
        }
        return $thumbnail;
    }


    /**
     * updated_atのフォーマット加工
     */
    // public function getUpdatedAtAttribute($value)
    // {
    //     $updated_at = date('Y/n/j H:i', strtotime($value));
    //     return $updated_at;
    // }


    /**
     * リレーション
     */
    public function joins()
    {
        return $this->hasMany(Join::class);
    }


    /**
     * リレーション
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * リレーション
     */
    public function station()
    {
        return $this->belongsTo(Station::class);
    }


    /**
     * 参加人数も結合してSELECT
     */
    public function selectWithCount()
    {
        $sql = <<< SQL
            SELECT *
            FROM aitore.jisyutore_posts AS post
            LEFT JOIN (
                SELECT
                    jisyutore_post_id, COUNT(*) AS lv1_count
                FROM
                    aitore.joins
                WHERE
                    join_done_kubun = '1'
                        AND join_level = '1'
                GROUP BY jisyutore_post_id , join_level) AS lv1 ON post.id = lv1.jisyutore_post_id
                    LEFT JOIN
                (SELECT
                    jisyutore_post_id, COUNT(*) AS lv2_count
                FROM
                    aitore.joins
                WHERE
                    join_done_kubun = '1'
                        AND join_level = '2'
                GROUP BY jisyutore_post_id , join_level) AS lv2 ON post.id = lv2.jisyutore_post_id

                LEFT JOIN (
                	SELECT jisyutore_post_id, count(*) as lv3_count  FROM aitore.joins
                	where join_done_kubun = '1'
                    and join_level = '3'
                	group by jisyutore_post_id, join_level
                	) AS lv3
                ON post.id = lv3.jisyutore_post_id

                LEFT JOIN (
                	SELECT jisyutore_post_id, count(*) as total FROM aitore.joins
                	where join_done_kubun = '1'
                	group by jisyutore_post_id
                	) AS total
                ON post.id = total.jisyutore_post_id
        SQL;
        $posts = DB::select($sql);

        return $posts;
    }


    /**
     * 日付フォーマット変換 start_datetime
     */
    public function startTimeFormat($datetime)
    {
        $datetime_format = date('Y/m/d G:i', strtotime($datetime));
        return $datetime_format;
    }

    public function startTimeYear($datetime)
    {
        $datetime_format = date('Y', strtotime($datetime));
        return $datetime_format;
    }

    public function startTimeMonthDay($datetime)
    {
        $datetime_format = date('n/j', strtotime($datetime));
        return $datetime_format;
    }

    public function startTime($datetime)
    {
        $datetime_format = date('G:i', strtotime($datetime)); return $datetime_format; }

    /**
     * 日付フォーマット変換 end_datetime
     */
    public function endTimeFormat($datetime)
    {
        $datetime_format = date('G:i', strtotime($datetime));
        return $datetime_format;
    }


    public function updatedatFormat($datetime)
    {
        $updated_at = date('Y/n/j G:i', strtotime($datetime));
        return $updated_at;
    }


    /**
     * getIndex
     */
    public function getIndex()
    {
        $query = $this::query();
        // $posts = $this::withCount([
        $query->withCount([
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
            ->withExists([
                'joins' => function (Builder $query) {
                    $query->where('join_done_kubun', '1')
                        ->where('user_id', Auth::id());
                }
            ])
            ->Join('stations', 'jisyutore_posts.station_id', '=', 'stations.id')
            ->Join('users', 'jisyutore_posts.user_id', '=', 'users.id')
            ->get();

            return $query;
    }

}
