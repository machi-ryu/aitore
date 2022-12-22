<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'nearest_station',
        'menu_category',
        'address',
        'comment',
        'user_id',
    ];
}
