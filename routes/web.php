<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AitoreController;

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
Route::get('/create', [AitoreController::class, 'create'])->name('create');
Route::post('/store', [AitoreController::class, 'store'])->name('store');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/vue', function () {
//     return view('vue');
// });
// Route::get('/app', function () {
//     return view('app');
// });
