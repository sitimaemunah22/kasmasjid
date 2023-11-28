<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisPemasukanController;
use App\Http\Controllers\JenisPengeluaranController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\DonaturController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\UserController;
use App\Models\jenis_pengeluaran;
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
Route::get('', function() {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register',[AuthController::class, 'buatakun']);

Route::prefix('/dashboard')->group(function () {
    /* Dashboard */
    Route::get('/', [DashboardController::class, 'index']);
    Route::middleware(['role:admin'])->group(function () {
        /* User */
        Route::controller(UserController::class)->group(function () {
            Route::get('/user', 'index');
            Route::post('/user/tambah', 'store');
            Route::post('/user/{id}/edit', 'update')->where('id', '[0-9+]');
            Route::delete('/user/{id}/delete', 'delete')->where('id', '[0-9]+');
        });

      


    });

    /* Surat */
    

    Route::get('/pemasukan', [PemasukanController::class, 'index'])->name('pemasukan.index');
    Route::get('/pemasukan/tambah', [PemasukanController::class, 'tambah'])->name('pemasukan.tambah');
    Route::post('/pemasukan/simpan', [PemasukanController::class, 'simpan'])->name('simpan.pemasukan');

   

    Route::get('/jenispemasukan/tambah', [PemasukanController::class, 'tambah'])->name('jenispemasukan.tambah');
    Route::post('/jenispemasukan/simpan', [PemasukanController::class, 'simpan'])->name('simpan.pemasukan');

    Route::controller(PengeluaranController::class)->group(function () {

        Route::get('/pengeluaran', 'index');
        Route::post('/pengeluaran', 'store');
        Route::get('/pengeluaran/download', 'download');
        Route::post('/pengeluaran/{id}', 'update');
        Route::delete('/pengeluaran/{id}', 'delete');
    });

    
    Route::controller(PemasukanController::class)->group(function () {

        Route::get('/pemasukan', 'index');
        Route::post('/pemasukan', 'store');
        Route::get('/pemasukan/download', 'download');
        Route::post('/pemasukan/{id}', 'update');
        Route::delete('/pemasukan /{id}', 'delete');
    });

    Route::controller(JenisPemasukanController::class)->group(function () {
        Route::get('/dashboard/jenis', [JenisPemasukanController::class, 'index']);
        Route::post('/dashboard/jenis_pemasukan', 'store');
        Route::get('/dashboard/jenis_pemasukan/download', 'download');
        Route::post('/dashboard/jenis_pemasukan/{id}', 'update');
        Route::delete('/dashboard/jenis_pemasukan/{id}', 'delete');
    });


    Route::controller(JenisPengeluaranController::class)->group(function () {
        Route::get('/jenis_pengeluaran', 'index');
        Route::post('/jenis_pengeluaran', 'store');
        Route::get('/jenis_pengeluaran/download', 'download');
        Route::post('/jenis_pengeluaran/{id}', 'update');
        Route::delete('/jenis_pengeluaran/{id}', 'delete');
    });
   

    /* Log */
    Route::controller(LogController::class)->group(function () {
        Route::get('/log', 'index');
    });
});
