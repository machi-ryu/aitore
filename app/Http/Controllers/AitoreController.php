<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JisyutorePost;

class AitoreController extends Controller
{
    public function index()
    {
        $posts = JisyutorePost::all();
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

    public function store(Request $request)
    {

    }
}
