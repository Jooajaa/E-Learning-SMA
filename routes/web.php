<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Guru\DashboardController as GuruDashboard;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboard;

use App\Http\Controllers\Guru\KuisController as GuruKuisController;
use App\Http\Controllers\Guru\NilaiController as GuruNilaiController;
use App\Http\Controllers\Guru\AbsensiController as GuruAbsensiController;
use App\Http\Controllers\Guru\JadwalController as GuruJadwalController;
use App\Http\Controllers\Guru\SoalKuisController as GuruSoalKuisController;

use App\Http\Controllers\Siswa\KuisController as SiswaKuisController;
use App\Http\Controllers\Siswa\NilaiController as SiswaNilaiController;
use App\Http\Controllers\Siswa\AbsensiController as SiswaAbsensiController;
use App\Http\Controllers\Siswa\JadwalController as SiswaJadwalController;

use App\Http\Controllers\KalenderAkademikController;

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

// =====================
// ROUTE DASHBOARD UTAMA
// =====================
Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    }

    if ($user->hasRole('guru')) {
        return redirect()->route('guru.dashboard');
    }

    if ($user->hasRole('siswa')) {
        return redirect()->route('siswa.dashboard');
    }

    return redirect('/');
})->middleware(['auth'])->name('dashboard');

// =====================
// ROUTE PROFILE
// =====================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =====================
// ROUTE ADMIN
// =====================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    });

// =====================
// ROUTE GURU
// =====================
Route::middleware(['auth', 'role:guru'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {
        Route::get('/dashboard', [GuruDashboard::class, 'index'])->name('dashboard');

        // Evaluasi Ahlil - Guru
        Route::get('/kuis', [GuruKuisController::class, 'index'])->name('kuis.index');
        Route::get('/kuis/create', [GuruKuisController::class, 'create'])->name('kuis.create');
        Route::post('/kuis', [GuruKuisController::class, 'store'])->name('kuis.store');
        
        Route::get('/kuis/{kuis}/soal/create', [GuruSoalKuisController::class, 'create'])->name('kuis.soal.create');
        Route::post('/kuis/{kuis}/soal', [GuruSoalKuisController::class, 'store'])->name('kuis.soal.store');
        
        Route::get('/nilai', [GuruNilaiController::class, 'index'])->name('nilai.index');
        Route::get('/absensi', [GuruAbsensiController::class, 'index'])->name('absensi.index');
        Route::get('/jadwal', [GuruJadwalController::class, 'index'])->name('jadwal.index');
    });

// =====================
// ROUTE SISWA
// =====================
Route::middleware(['auth', 'role:siswa'])
    ->prefix('siswa')
    ->name('siswa.')
    ->group(function () {
        Route::get('/dashboard', [SiswaDashboard::class, 'index'])->name('dashboard');

        // Evaluasi Ahlil - Siswa
        Route::get('/kuis', [SiswaKuisController::class, 'index'])->name('kuis.index');
        Route::get('/kuis/{kuis}/kerjakan', [SiswaKuisController::class, 'kerjakan'])->name('kuis.kerjakan');
        Route::post('/kuis/{kuis}/submit', [SiswaKuisController::class, 'submit'])->name('kuis.submit');
        
        Route::get('/nilai', [SiswaNilaiController::class, 'index'])->name('nilai.index');
        Route::get('/absensi', [SiswaAbsensiController::class, 'index'])->name('absensi.index');
        Route::get('/jadwal', [SiswaJadwalController::class, 'index'])->name('jadwal.index');
    });

// =====================
// ROUTE KALENDER AKADEMIK
// =====================
Route::middleware(['auth'])->group(function () {
    Route::get('/kalender', [KalenderAkademikController::class, 'index'])->name('kalender.index');
});