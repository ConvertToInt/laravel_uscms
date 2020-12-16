<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UploadsController;

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

Route::get('/uploads', [UploadsController::class, 'index'])->middleware('can:viewAny,App\Models\Upload');

Route::get('/uploads/create', [UploadsController::class, 'create'])->middleware('can:create,App\Models\Upload');

Route::post('/uploads', [UploadsController::class, 'store'])->middleware('can:create,App\Models\Upload');

Route::get('/uploads/{upload}/edit/', [UploadsController::class, 'edit'])->middleware('can:update,upload');

Route::get('/uploads/{upload}', [UploadsController::class, 'show'])->middleware('can:view,upload');

Route::get('/uploads/{upload}/file/{origName?}', [UploadsController::class, 'file'])->middleware('can:view,upload');

Route::delete('/uploads/{upload}', [UploadsController::class, 'destroy'])->middleware('can:delete,upload');

Route::put('/uploads/{upload}', [UploadsController::class, 'update'])->middleware('can:update,upload');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
