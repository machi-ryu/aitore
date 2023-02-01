<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Line;

class Station extends Model
{
    use HasFactory;

    protected $table = 'stations';
    protected $fillable = [
        'line_id',
        'station_name',
    ];


    /**
     * リレーション
     */
    public function line()
    {
        return $this->belongsTo(Line::class);
    }
}
