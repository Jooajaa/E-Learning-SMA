<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KalenderAkademikController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\MapelController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\PenugasanController;
use App\Http\Controllers\Admin\ResetPasswordController;
use App\Http\Controllers\Admin\ImportController;
use App\Http\Controllers\Admin\JadwalController as AdminJadwalController;

use App\Http\Controllers\Guru\DashboardController as GuruDashboard;
use App\Http\Controllers\Guru\KuisController as GuruKuisController;
use App\Http\Controllers\Guru\NilaiController as GuruNilaiController;
use App\Http\Controllers\Guru\AbsensiController as GuruAbsensiController;
use App\Http\Controllers\Guru\JadwalController as GuruJadwalController;
use App\Http\Controllers\Guru\SoalKuisController as GuruSoalKuisController;
use App\Http\Controllers\Guru\MateriController as GuruMateriController;
use App\Http\Controllers\Guru\TugasController as GuruTugasController;
use App\Http\Controllers\Guru\PengumpulanTugasController as GuruPengumpulanTugasController;

use App\Http\Controllers\Siswa\DashboardController as SiswaDashboard;
use App\Http\Controllers\Siswa\KuisController as SiswaKuisController;
use App\Http\Controllers\Siswa\NilaiController as SiswaNilaiController;
use App\Http\Controllers\Siswa\AbsensiController as SiswaAbsensiController;
use App\Http\Controllers\Siswa\JadwalController as SiswaJadwalController;
use App\Http\Controllers\Siswa\MateriController as SiswaMateriController;
use App\Http\Controllers\Siswa\TugasController as SiswaTugasController;
use App\Http\Controllers\Siswa\PengumpulanTugasController as SiswaPengumpulanTugasController;

Route::get('/', function () {
    return view('welcome');
});

require __DIR__ . '/auth.php';

// Redirect dashboard sesuai role
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

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
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

        // Jadwal Pelajaran
        Route::resource('jadwal', AdminJadwalController::class);
    });

// Guru Routes
Route::middleware(['auth', 'role:guru'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {
        Route::get('/dashboard', [GuruDashboard::class, 'index'])->name('dashboard');

        // Fitur Ahlil - Evaluasi
        Route::get('/kuis', [GuruKuisController::class, 'index'])->name('kuis.index');
        Route::get('/kuis/create', [GuruKuisController::class, 'create'])->name('kuis.create');
        Route::post('/kuis', [GuruKuisController::class, 'store'])->name('kuis.store');
        Route::get('/kuis/{kuis}', [GuruKuisController::class, 'show'])->name('kuis.show');

        Route::get('/kuis/{kuis}/soal/create', [GuruSoalKuisController::class, 'create'])->name('kuis.soal.create');
        Route::post('/kuis/{kuis}/soal', [GuruSoalKuisController::class, 'store'])->name('kuis.soal.store');

        Route::get('/nilai', [GuruNilaiController::class, 'index'])->name('nilai.index');
        Route::get('/absensi', [GuruAbsensiController::class, 'index'])->name('absensi.index');
        Route::get('/jadwal', [GuruJadwalController::class, 'index'])->name('jadwal.index');

        // Fitur Fuad - Pembelajaran
        Route::get('/materi', [GuruMateriController::class, 'index'])->name('materi.index');
        Route::get('/materi/create', [GuruMateriController::class, 'create'])->name('materi.create');
        Route::post('/materi', [GuruMateriController::class, 'store'])->name('materi.store');
        Route::get('/materi/{materi}', [GuruMateriController::class, 'show'])->name('materi.show');
        Route::get('/materi/{materi}/edit', [GuruMateriController::class, 'edit'])->name('materi.edit');
        Route::put('/materi/{materi}', [GuruMateriController::class, 'update'])->name('materi.update');
        Route::delete('/materi/{materi}', [GuruMateriController::class, 'destroy'])->name('materi.destroy');

        Route::get('/tugas', [GuruTugasController::class, 'index'])->name('tugas.index');
        Route::get('/tugas/create', [GuruTugasController::class, 'create'])->name('tugas.create');
        Route::post('/tugas', [GuruTugasController::class, 'store'])->name('tugas.store');
        Route::get('/tugas/{tugas}', [GuruTugasController::class, 'show'])->name('tugas.show');
        Route::get('/tugas/{tugas}/edit', [GuruTugasController::class, 'edit'])->name('tugas.edit');
        Route::put('/tugas/{tugas}', [GuruTugasController::class, 'update'])->name('tugas.update');
        Route::delete('/tugas/{tugas}', [GuruTugasController::class, 'destroy'])->name('tugas.destroy');

        Route::get('/pengumpulan', [GuruPengumpulanTugasController::class, 'index'])->name('pengumpulan.index');
        Route::put('/pengumpulan/{pengumpulan}/nilai', [GuruPengumpulanTugasController::class, 'beriNilai'])->name('pengumpulan.nilai');
    });

// Siswa Routes
Route::middleware(['auth', 'role:siswa'])
    ->prefix('siswa')
    ->name('siswa.')
    ->group(function () {
        Route::get('/dashboard', [SiswaDashboard::class, 'index'])->name('dashboard');

        // Fitur Ahlil - Evaluasi
        Route::get('/kuis', [SiswaKuisController::class, 'index'])->name('kuis.index');
        Route::get('/kuis/{kuis}/kerjakan', [SiswaKuisController::class, 'kerjakan'])->name('kuis.kerjakan');
        Route::post('/kuis/{kuis}/submit', [SiswaKuisController::class, 'submit'])->name('kuis.submit');

        Route::get('/nilai', [SiswaNilaiController::class, 'index'])->name('nilai.index');
        Route::get('/absensi', [SiswaAbsensiController::class, 'index'])->name('absensi.index');
        Route::post('/absensi', [SiswaAbsensiController::class, 'store'])->name('absensi.store');
        Route::get('/jadwal', [SiswaJadwalController::class, 'index'])->name('jadwal.index');

        // Fitur Fuad - Pembelajaran
        Route::get('/materi', [SiswaMateriController::class, 'index'])->name('materi.index');
        Route::get('/materi/{materi}', [SiswaMateriController::class, 'show'])->name('materi.show');

        Route::get('/tugas', [SiswaTugasController::class, 'index'])->name('tugas.index');
        Route::get('/tugas/{tugas}', [SiswaTugasController::class, 'show'])->name('tugas.show');

        Route::get('/pengumpulan', [SiswaPengumpulanTugasController::class, 'index'])->name('pengumpulan.index');
        Route::post('/pengumpulan', [SiswaPengumpulanTugasController::class, 'store'])->name('pengumpulan.store');
    });

// Kalender Akademik
Route::middleware(['auth'])->group(function () {
    Route::get('/kalender', [KalenderAkademikController::class, 'index'])->name('kalender.index');
});