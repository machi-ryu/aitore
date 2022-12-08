<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JisyutorePost extends Model
{
    use HasFactory;

    protected $table = 'jisyutore_posts';

    protected $guraded = ['id'];
}
