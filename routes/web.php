<?php

use App\Http\Controllers\{AlgoritmaController, DashboardController, GraphController, TestController, UserController, WisataController};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your applica xtion. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [WisataController::class, 'homeUser']);
// return view('front.home');
Route::get('/test', [TestController::class, 'index'])->name('testing');


Auth::routes();

// Route::resource('/user', UserController::class);
Route::get('/user/{id}', [UserController::class, "profile"])->name('user.profile');
Route::get('/edit-profile/{id}', [UserController::class, "editprofile"])->name('edit.profile');
Route::put('/update-profile/{id}', [UserController::class, "updateprofile"])->name('update.profile');
// Route::get('/user/hapus/{id}', [UserController::class, "delete"]);

// hanya admin yang dapat akses route ini
Route::middleware(['auth', 'redirectBasedOnRole'])->prefix('/admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, "index"])->name('dashboard');
    Route::resource('/user', UserController::class);
    Route::get('/user/hapus/{id}', [UserController::class, "delete"]);

    // wisata
    Route::resource('/wisata', WisataController::class);
    Route::get('/wisata/hapus/{id}', [WisataController::class, "delete"]);

    // graph
    Route::resource('/graph', GraphController::class);
    Route::get('/graph/hapus/{id}', [GraphController::class, "delete"]);

    // rute
    Route::resource('/rute', AlgoritmaController::class);
    Route::get('/rute/hapus/{id}', [AlgoritmaController::class, "delete"]);
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
