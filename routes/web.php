<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UrlController;
use App\Models\Url;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

// user route
Route::get('/homepage', function () {
    return view('home');
})->middleware('auth')->name('homepage');

Route::resource('urls', UrlController::class)->middleware('auth');
Route::get('{short_url}', [UrlController::class, 'shortUrl'])->prefix('urls/shorturl/')->name('short-url');

// admin route
Route::get('/dashboard', [UrlController::class, 'listData'])->middleware(['auth', 'auth.checkrole'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
