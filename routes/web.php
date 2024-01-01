<?php

use App\Http\Controllers\{DaftarPoliController, DashboardController, DetailPeriksaController, DokterController, JadwalPeriksaController, ObatController, PasienController, PeriksaController, PoliController,  UserController};
use App\Models\PasienModel;
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

Route::get('/', function () {
    $no_rm = PasienModel::no_rm();
    return view('home', compact('no_rm'));
});
Route::post('/daftarpasien', [PasienController::class, "store_user"])->name('store-user');
Route::get('/daftarpolipasien', [DaftarPoliController::class, "polipasien"])->name('daftarpolipasien');
Route::post('/daftarpolipasiensimpan', [DaftarPoliController::class, "polipasiensimpan"])->name('polipasien.simpan');
Route::get('/suksesdaftarpoli', function () {
    return view('sukses');
})->name('suksesdaftarpoli');

// Route::get('/daftarpolipasien', [DaftarPoliController::class, "daftarpolipasien"])->name('daftarpolipasien');


Auth::routes();

Route::middleware(['auth', 'redirectBasedOnRole'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, "index"])->name('dashboard');
    Route::resource('/user', UserController::class);
    Route::get('/user/hapus/{id}', [UserController::class, "delete"]);

    // pasien
    Route::resource('/pasien', PasienController::class);
    Route::get('/pasien/hapus/{id}', [PasienController::class, "delete"]);

    // dokter
    Route::resource('/dokter', DokterController::class);
    Route::get('/dokter/hapus/{id}', [DokterController::class, "delete"]);
    Route::get('/periksapasien', [DokterController::class, "daftarperiksapasien"])->name('periksapasien');

    // obat
    Route::resource('/obat', ObatController::class);
    Route::get('/obat/hapus/{id}', [ObatController::class, "delete"]);

    // poli
    Route::resource('/poli', PoliController::class);
    Route::get('/poli/hapus/{id}', [PoliController::class, "delete"]);

    // periksa
    Route::resource('/periksa', PeriksaController::class);
    Route::get('/periksa/hapus/{id}', [PeriksaController::class, "delete"]);

    // daftarpoli
    Route::resource('/daftarpoli', DaftarpoliController::class);
    Route::get('/daftarpoli/hapus/{id}', [DaftarPoliController::class, "delete"]);

    // jadwalperiksa
    Route::resource('/jadwalperiksa', JadwalPeriksaController::class);
    Route::get('/jadwalperiksa/hapus/{id}', [JadwalPeriksaController::class, "delete"]);

    // detailperiksa
    Route::resource('/detailperiksa', DetailPeriksaController::class);
    Route::get('/detailperiksa/hapus/{id}', [DetailPeriksaController::class, "delete"]);
});