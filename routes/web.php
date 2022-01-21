<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengaduan;


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('pengaduan', 'PengaduanController@index')
    ->name('pengaduan.index');

Route::get('pengaduan/create', 'PengaduanController@create')
    ->name('pengaduan.create')
    ->middleware('auth');

Route::post('pengaduan/', 'PengaduanController@store')
    ->name('pengaduan.store')
    ->middleware('auth');

Route::get('pengaduan/{pengaduan}', 'PengaduanController@show')
    ->name('pengaduan.show');

Route::post('pengaduan/{pengaduan}/tanggapan', 'TanggapanController@store')
    ->name('pengaduan.tanggapan.store')
    ->middleware('auth');

