<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LetterController::class, 'index']);
Route::resource('letter', LetterController::class);
Route::get('/letter/download/{id}', [LetterController::class, 'download'])->name('letter.download');
Route::resource('category', CategoryController::class);
Route::get('/about', function () {
    return view('page.about');
})->name('about');
