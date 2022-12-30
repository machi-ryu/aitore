<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
