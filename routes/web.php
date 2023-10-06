<?php

use App\Http\Controllers\{DashboardController, UserController, WisataController};
use App\Models\Wisata;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [WisataController::class, 'homeUser']);
// return view('front.home');



Auth::routes();

// Route::resource('/user', UserController::class);
Route::get('/user/{id}', [UserController::class, "profile"])->name('user.profile');
Route::get('/edit-profile/{id}', [UserController::class, "editprofile"])->name('edit.profile');
Route::put('/update-profile/{id}', [UserController::class, "updateprofile"])->name('update.profile');
// Route::get('/user/hapus/{id}', [UserController::class, "delete"]);

Route::middleware(['auth', 'redirectBasedOnRole'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, "index"])->name('dashboard');
    // hanya admin yang dapat akses route ini
    Route::resource('/user', UserController::class);
    Route::get('/user/hapus/{id}', [UserController::class, "delete"]);

    // wisata
    Route::resource('/wisata', WisataController::class);
    Route::get('/wisata/hapus/{id}', [WisataController::class, "delete"]);
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
