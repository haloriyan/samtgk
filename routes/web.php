<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\PaymentLinkController;
use App\Http\Controllers\SuratController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return bcrypt("123456");
});

Route::post('handle-body-image', [InfoController::class, 'handleBodyImage'])->name('block.handleBodyImage');

Route::group(['prefix' => "admin"], function () {
    Route::get('login', [AdminController::class, 'loginPage'])->name('admin.loginPage');
    Route::post('login', [AdminController::class, 'login'])->name('admin.login');
    Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');

    Route::middleware(['Admin'])->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        Route::group(['prefix' => "admin"], function () {
            Route::post('store', [AdminController::class, 'store'])->name('admin.store');
            Route::post('update', [AdminController::class, 'update'])->name('admin.update');
            Route::post('delete', [AdminController::class, 'delete'])->name('admin.delete');
            Route::get('/', [AdminController::class, 'admin'])->name('admin.admin');
        });

        Route::get('user', [AdminController::class, 'user'])->name('admin.user');

        Route::group(['prefix' => "banner"], function () {
            Route::post('store', [BannerController::class, 'store'])->name('banner.store');
            Route::post('update', [BannerController::class, 'update'])->name('banner.update');
            Route::post('delete', [BannerController::class, 'delete'])->name('banner.delete');
            Route::get('/', [AdminController::class, 'banner'])->name('admin.banner');
        });

        Route::group(['prefix' => "surat"], function () {
            Route::post('store', [SuratController::class, 'store'])->name('surat.store');
            Route::get('/', [AdminController::class, 'surat'])->name('admin.surat');
        });

        Route::group(['prefix' => "layanan"], function () {
            Route::get('create', [LayananController::class, 'create'])->name('layanan.create');
            Route::post('store', [LayananController::class, 'store'])->name('layanan.store');
            Route::get('{id}/edit', [LayananController::class, 'edit'])->name('layanan.edit');
            Route::post('{id}/update', [LayananController::class, 'update'])->name('layanan.update');
            Route::post('delete', [LayananController::class, 'delete'])->name('layanan.delete');
            Route::get('/', [AdminController::class, 'layanan'])->name('admin.layanan');
        });

        Route::group(['prefix' => "lokasi"], function () { // BELUM
            Route::get('create', [LokasiController::class, 'create'])->name('lokasi.create');
            Route::post('store', [LokasiController::class, 'store'])->name('lokasi.store');
            Route::get('{id}/edit', [LokasiController::class, 'edit'])->name('lokasi.edit');
            Route::post('{id}/update', [LokasiController::class, 'update'])->name('lokasi.update');
            Route::post('delete', [LokasiController::class, 'delete'])->name('lokasi.delete');
            Route::get('/', [AdminController::class, 'lokasi'])->name('admin.lokasi');
        });

        Route::group(['prefix' => "payment"], function () {
            Route::post('store', [PaymentLinkController::class, 'store'])->name('paymentLink.store');
            Route::post('update', [PaymentLinkController::class, 'update'])->name('paymentLink.update');
            Route::post('delete', [PaymentLinkController::class, 'delete'])->name('paymentLink.delete');
            Route::get('/', [AdminController::class, 'paymentLink'])->name('admin.paymentLink');
        });

        Route::group(['prefix' => "info"], function () {
            Route::get('create', [InfoController::class, 'create'])->name('info.create');
            Route::post('store', [InfoController::class, 'store'])->name('info.store');
            Route::get('{id}/edit', [InfoController::class, 'edit'])->name('info.edit');
            Route::post('{id}/update', [InfoController::class, 'update'])->name('info.update');
            Route::get('/', [AdminController::class, 'info'])->name('admin.info');
        });

        Route::group(['prefix' => "kerja-sama"], function () {
            Route::get('{type}', [AdminController::class, 'partnership'])->name('admin.partnership');
        });

        Route::group(['prefix' => "export"], function () {
            Route::get('user', [ExportController::class, 'user'])->name('export.user');
        });
    });
});

