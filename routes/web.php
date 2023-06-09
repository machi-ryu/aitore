<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AitoreController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\Auth\EditController;
use App\Http\Controllers\StationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     // return view('welcome');
// });

Route::get('/', [AitoreController::class, 'index'])->name('index');
Route::get('/show/{id}', [AitoreController::class, 'show'])->name('show');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/create', [AitoreController::class, 'create'])->name('create');
    Route::post('/store', [AitoreController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [AitoreController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [AitoreController::class, 'update'])->name('update');
    Route::get('/destroy/{id}', [AitoreController::class, 'destroy'])->name('destroy');

    // join
    Route::post('/join/store/{id}', [AitoreController::class, 'joinStore'])->name('join.store');
    Route::post('/join/cancel/{id}', [AitoreController::class, 'joinCancel'])->name('join.cancel');
});

Route::group(['middleware' => 'auth'], function(){
    Route::get('/mypage/index', [MyPageController::class, 'index'])->name('mypage.index');
    Route::get('/mypage/calendar', [MyPageController::class, 'getEvents'])->name('mypage.calendar');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function(){
    Route::get('/auth/edit', [EditController::class, 'edit'])->name('user.edit');
    Route::post('/auth/update', [EditController::class, 'update'])->name('user.update');
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/vue', function () {
//     return view('vue');
// });
// Route::get('/app', function () {
//     return view('app');
// });

Route::get('/line', [StationController::class, 'line']);
Route::get('/station', [StationController::class, 'station']);
// Route::get('/linestation/{id}', [StationController::class, 'linestation']);
Route::get('/station/{id}', [StationController::class, 'lineStation']);
