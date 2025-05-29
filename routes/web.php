<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DataKamarController;
use App\Http\Controllers\Admin\DataBulananController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\DataCustomerController;
use App\Http\Controllers\Admin\DataFasilitasController;
use App\Http\Controllers\Admin\DataReservasiController;
use App\Http\Controllers\Admin\MetodePembayaranController;
use App\Http\Controllers\Customer\CustomerProfileController;
use App\Http\Controllers\Customer\HistoriReservasiController;
use App\Http\Controllers\Customer\StatusReservasiController;

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/fasilitas', [FasilitasController::class, 'fasilitas'])->name('fasilitas');
Route::get('/fasilitas/{id}', [FasilitasController::class, 'show'])->name('fasilitas.show');
Route::get('/wedding', function () {return view('wedding');});
Route::get('/gallery', function () {return view('gallery');});
Route::get('/contact', function () {return view('contact');});
Route::get('/reservasi', [ReservasiController::class, 'index']);
Route::get('/cari-kamar', [ReservasiController::class, 'cariKamar'])->name('guest.cari.cari-kamar');
Route::get('/reservasi/filter', [ReservasiController::class, 'filter'])->name('guest.cari.kamar');
Route::get('/detail-reservasi/{id}', [ReservasiController::class, 'detail'])->name('reservasi.detail');

Route::middleware('auth')->group(function () {
    Route::get('/buat-reservasi/{id}', [ReservasiController::class, 'create'])->name('guest.reservasi.create');
    Route::post('/buat-reservasi', [ReservasiController::class, 'store'])->name('guest.reservasi.store');
});

//! Customer Routes
Route::middleware(['auth', 'CustomerMiddleware'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'index'])->name('dashboard');
    Route::put('/status-reservasi/{id}/batalkan', [StatusReservasiController::class, 'batalkan'])->name('status-reservasi.cancel');
    Route::post('/status-reservasi/{id}/bayar', [StatusReservasiController::class, 'bayar'])->name('status-reservasi.pay');
    Route::resource('/status-reservasi', StatusReservasiController::class);
    Route::resource('/histori-reservasi', HistoriReservasiController::class);
    Route::get('/profile', [CustomerProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [CustomerProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [CustomerProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete', [CustomerProfileController::class, 'destroy'])->name('profile.destroy');
});

//! Admin Routes
Route::middleware(['auth', 'AdminMiddleware'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/data-kamar/trash', [DataKamarController::class, 'trash'])->name('data-kamar.trash');
    Route::put('/data-kamar/restore/{id}', [DataKamarController::class, 'restore'])->name('data-kamar.restore');
    Route::delete('/data-kamar/forceDelete/{id}', [DataKamarController::class, 'forceDelete'])->name('data-kamar.forceDelete');
    Route::resource('/data-kamar', DataKamarController::class);
    Route::get('/data-fasilitas/trash', [DataFasilitasController::class, 'trash'])->name('data-fasilitas.trash');
    Route::put('/data-fasilitas/restore/{id}', [DataFasilitasController::class, 'restore'])->name('data-fasilitas.restore');
    Route::delete('/data-fasilitas/forceDelete/{id}', [DataFasilitasController::class, 'forceDelete'])->name('data-fasilitas.forceDelete');
    Route::resource('/data-fasilitas', DataFasilitasController::class);
    Route::resource('/data-reservasi', DataReservasiController::class);
    Route::get('/metode-pembayaran/trash', [MetodePembayaranController::class, 'trash'])->name('metode-pembayaran.trash');
    Route::put('/metode-pembayaran/restore/{id}', [MetodePembayaranController::class, 'restore'])->name('metode-pembayaran.restore');
    Route::delete('/metode-pembayaran/forceDelete/{id}', [MetodePembayaranController::class, 'forceDelete'])->name('metode-pembayaran.forceDelete');
    Route::resource('/metode-pembayaran', MetodePembayaranController::class);
    Route::get('/data-customer/trash', [DataCustomerController::class, 'trash'])->name('data-customer.trash');
    Route::put('/data-customer/restore/{id}', [DataCustomerController::class, 'restore'])->name('data-customer.restore');
    Route::delete('/data-customer/forceDelete/{id}', [DataCustomerController::class, 'forceDelete'])->name('data-customer.forceDelete');
    Route::resource('/data-customer', DataCustomerController::class);
    Route::resource('/data-bulanan', DataBulananController::class);
    Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
