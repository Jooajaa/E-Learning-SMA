<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Guru\DashboardController as GuruDashboard;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboard;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\MapelController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\PenugasanController;
use App\Http\Controllers\Admin\ResetPasswordController;
use App\Http\Controllers\Admin\ImportController;

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->name('dashboard');

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::resource('kelas', KelasController::class);
    Route::resource('mapel', MapelController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('guru', GuruController::class);
    Route::get('/penugasan', [PenugasanController::class, 'index'])->name('penugasan.index');
    Route::post('/penugasan/siswa-kelas', [PenugasanController::class, 'storeSiswaKelas'])->name('penugasan.siswa-kelas');
    Route::post('/penugasan/guru-mapel', [PenugasanController::class, 'storeGuruMapel'])->name('penugasan.guru-mapel');
    Route::post('/penugasan/guru-kelas', [PenugasanController::class, 'storeGuruKelas'])->name('penugasan.guru-kelas');
    Route::get('/reset-password/{user}', [ResetPasswordController::class, 'edit'])->name('reset-password.edit');
    Route::put('/reset-password/{user}', [ResetPasswordController::class, 'update'])->name('reset-password.update');
    Route::get('/import', [ImportController::class, 'index'])->name('import.index');
    Route::post('/import/siswa', [ImportController::class, 'importSiswa'])->name('import.siswa');
    Route::post('/import/guru', [ImportController::class, 'importGuru'])->name('import.guru');
});

// Guru Routes
Route::middleware(['auth'])->prefix('guru')->name('guru.')->group(function () {
    Route::get('/dashboard', [GuruDashboard::class, 'index'])->name('dashboard');
});

// Siswa Routes
Route::middleware(['auth'])->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/dashboard', [SiswaDashboard::class, 'index'])->name('dashboard');
});
