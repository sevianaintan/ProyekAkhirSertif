<?php

use App\Http\Controllers\SkinCareController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [SkinCareController::class, 'index']);
Route::post('/', [SkinCareController::class, 'tambahSkinCare'])->name('tambah.skin.care');
Route::post('/update/{skin_care_id}', [SkinCareController::class, 'updateSkinCare'])->name('update.skin.care');
Route::post('/hapus/{skin_care_id}', [SkinCareController::class, 'hapusSkinCare'])->name('hapus.skin.care');
