<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KategoriPerilakuController;
use App\Http\Controllers\JenisPerilakuController;
use App\Http\Controllers\JenisRewardController;
use App\Http\Controllers\LaporanPerilakuController;
use App\Http\Controllers\PembinaanController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\RekapController;
use Illuminate\Support\Facades\Route;

// Root redirect
Route::get('/', function () {
    return redirect()->route('login');
});

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard (protected)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // Master Data (admin only)
    Route::middleware('role:admin')->group(function () {
        Route::resource('jurusan', JurusanController::class);
        Route::resource('tahun-ajaran', TahunAjaranController::class);
        Route::resource('kelas', KelasController::class)->parameters(['kelas' => 'kelas']);
        Route::post('guru/import', [GuruController::class, 'import'])->name('guru.import');
        Route::resource('guru', GuruController::class);
        Route::post('siswa/import', [SiswaController::class, 'import'])->name('siswa.import');
        Route::resource('siswa', SiswaController::class);
        Route::resource('kategori-perilaku', KategoriPerilakuController::class);
        Route::resource('jenis-perilaku', JenisPerilakuController::class);
        Route::resource('jenis-reward', JenisRewardController::class);
        Route::resource('pengguna', \App\Http\Controllers\UserController::class);
    });

    // Data Siswa (view only untuk guru, bk, kesiswaan)
    Route::middleware('role:guru,bk,kesiswaan')->group(function () {
        Route::get('data-siswa', [SiswaController::class, 'lihatIndex'])->name('siswa.lihat');
        Route::get('data-siswa/{siswa}', [SiswaController::class, 'lihatShow'])->name('siswa.lihat.show');
        Route::get('wali-kelas', [SiswaController::class, 'waliKelasIndex'])->name('siswa.wali-kelas');
    });

    // Laporan Perilaku (guru, bk, kesiswaan)
    Route::middleware('role:guru,bk,kesiswaan,admin')->group(function () {
        Route::get('laporan-perilaku/cari-siswa', [LaporanPerilakuController::class, 'cariSiswa'])->name('laporan-perilaku.cari-siswa');
        Route::get('laporan-perilaku/rekap/{siswa}', [LaporanPerilakuController::class, 'rekapSiswa'])->name('laporan-perilaku.rekap');
        Route::resource('laporan-perilaku', LaporanPerilakuController::class);
    });

    // Reward (guru, kesiswaan)
    Route::middleware('role:guru,kesiswaan,admin')->group(function () {
        Route::get('reward/cari-siswa', [RewardController::class, 'cariSiswa'])->name('reward.cari-siswa');
        Route::resource('reward', RewardController::class);
    });

    // Laporan Kesiswaan (bk, kesiswaan, admin)
    Route::middleware('role:bk,kesiswaan,admin')->group(function () {
        Route::get('rekap-poin', [RekapController::class, 'rekapPoin'])->name('rekap-poin.index');
        Route::get('rekap-reward', [RekapController::class, 'rekapReward'])->name('rekap-reward.index');
    });
    Route::middleware('role:bk,admin')->group(function () {
        Route::get('pembinaan/cari-siswa', [PembinaanController::class, 'cariSiswa'])->name('pembinaan.cari-siswa');
        Route::resource('pembinaan', PembinaanController::class);
    });
    Route::middleware('role:bk,admin')->group(function () {
        Route::get('verifikasi-laporan', [LaporanPerilakuController::class, 'verifikasiIndex'])->name('laporan-perilaku.verifikasi-index');
        Route::get('verifikasi-laporan/{id}', [LaporanPerilakuController::class, 'verifikasi'])->name('laporan-perilaku.verifikasi');
        Route::post('verifikasi-laporan/{id}', [LaporanPerilakuController::class, 'prosesVerifikasi'])->name('laporan-perilaku.proses-verifikasi');
    });

    Route::middleware('auth')->group(function () {
        Route::get('poin', [\App\Http\Controllers\Siswa\PoinController::class, 'index'])->name('poin.index');
        Route::get('kredit-reward', [\App\Http\Controllers\Siswa\RewardController::class, 'index'])->name('kredit-reward.index');
        Route::get('riwayat-pembinaan', [\App\Http\Controllers\Siswa\PembinaanController::class, 'index'])->name('riwayat-pembinaan.index');
        Route::get('profil', [\App\Http\Controllers\Siswa\ProfilController::class, 'index'])->name('siswa.profil.index');
        Route::put('profil', [\App\Http\Controllers\Siswa\ProfilController::class, 'update'])->name('siswa.profil.update');
    });

});
