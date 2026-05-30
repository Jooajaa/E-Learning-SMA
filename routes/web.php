<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// =====================
// DASHBOARD CONTROLLERS
// =====================

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Guru\DashboardController as GuruDashboard;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboard;

// =====================
// CONTROLLER FUAD
// =====================

// Guru
use App\Http\Controllers\Guru\MateriController as GuruMateriController;
use App\Http\Controllers\Guru\TugasController as GuruTugasController;
use App\Http\Controllers\Guru\PengumpulanTugasController as GuruPengumpulanController;

// Siswa
use App\Http\Controllers\Siswa\MateriController as SiswaMateriController;
use App\Http\Controllers\Siswa\TugasController as SiswaTugasController;
use App\Http\Controllers\Siswa\PengumpulanTugasController as SiswaPengumpulanController;


// =====================
// PUBLIC ROUTES
// =====================

Route::get('/', function () {
    return view('welcome');
});


// =====================
// DASHBOARD
// =====================

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// =====================
// PROFILE
// =====================

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


// =====================
// ADMIN ROUTES
// =====================

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboard::class, 'index'])
            ->name('dashboard');
    });


// =====================
// GURU ROUTES
// =====================

Route::middleware(['auth', 'role:guru'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {

        Route::get('/dashboard', [GuruDashboard::class, 'index'])
            ->name('dashboard');

        // MATERI
        Route::resource('materi', GuruMateriController::class);

        // TUGAS
        Route::resource('tugas', GuruTugasController::class);

        // PENGUMPULAN
        Route::get(
            '/pengumpulan',
            [GuruPengumpulanController::class, 'index']
        )->name('pengumpulan.index');

        Route::put(
            '/pengumpulan/{id}/komentar',
            [GuruPengumpulanController::class, 'komentar']
        )->name('pengumpulan.komentar');
    });


// =====================
// SISWA ROUTES
// =====================

Route::middleware(['auth', 'role:siswa'])
    ->prefix('siswa')
    ->name('siswa.')
    ->group(function () {

        Route::get('/dashboard', [SiswaDashboard::class, 'index'])
            ->name('dashboard');

        // MATERI
        Route::get(
            '/materi',
            [SiswaMateriController::class, 'index']
        )->name('materi.index');

        Route::get(
            '/materi/{id}',
            [SiswaMateriController::class, 'show']
        )->name('materi.show');

        // TUGAS
        Route::get(
            '/tugas',
            [SiswaTugasController::class, 'index']
        )->name('tugas.index');

        Route::get(
            '/tugas/{id}',
            [SiswaTugasController::class, 'show']
        )->name('tugas.show');

        // PENGUMPULAN
        Route::get(
            '/pengumpulan',
            [SiswaPengumpulanController::class, 'index']
        )->name('pengumpulan.index');

        Route::post(
            '/pengumpulan',
            [SiswaPengumpulanController::class, 'store']
        )->name('pengumpulan.store');
    });


// =====================
// AUTH ROUTES
// =====================

require __DIR__.'/auth.php';