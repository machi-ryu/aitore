<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class EditController extends Controller
{
    public function edit()
    {
        $user = User::find(Auth::id());
        return view('auth.edit', compact('user'));
    }


    public function update(Request $request)
    {
        $user = User::find(Auth::id());
        $data = $request->all();

        // ディレクトリに画像を保存
        if ($request->file('thumbnail')) {
            $file_name = $request->file('thumbnail')->getClientOriginalName();
            $image = $request->file('thumbnail')->storeAs('public/user', $file_name);
            $data['icon'] = $file_name;
        }
        $data['password'] = Hash::make($request->input('password'));

        $user->fill($data)->save();
        return redirect(route('index'));
    }
}
