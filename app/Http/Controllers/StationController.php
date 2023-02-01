<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Line;
use App\Models\Station;

class StationController extends Controller
{
    /**
     * プルダウン生成用 line
     */
    public function line()
    {
        $lines = Line::all();
        return $lines;
    }


    /**
     * プルダウン生成用 station
     */
    public function station()
    {
        $stations = Station::all();
        return $stations;
    }


    /**
     * プルダウン連動用 station
     */
    public function lineStation($id)
    {
        $stations = Station::where('line_id', $id)->get();
        return $stations;
    }
}
