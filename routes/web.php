<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\RegencyController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Halaman Utama
Route::get('/', function () {
    return view('dashboard', [
        'provinceCount' => \App\Models\Province::count(),
        'regencyCount' => \App\Models\Regency::count()
    ]);
})->name('home');

// Grup Route untuk Provinsi
Route::prefix('provinces')->name('provinces.')->group(function () {
    Route::get('/', [ProvinceController::class, 'index'])->name('index');
    Route::get('/create', [ProvinceController::class, 'create'])->name('create');
    Route::post('/', [ProvinceController::class, 'store'])->name('store');
    Route::get('/{province}/edit', [ProvinceController::class, 'edit'])->name('edit');
    Route::put('/{province}', [ProvinceController::class, 'update'])->name('update');
    Route::delete('/{province}', [ProvinceController::class, 'destroy'])->name('destroy');
});

// Grup Route untuk Kabupaten
Route::prefix('regencies')->name('regencies.')->group(function () {
    Route::get('/', [RegencyController::class, 'index'])->name('index');
    Route::get('/create', [RegencyController::class, 'create'])->name('create');
    Route::post('/', [RegencyController::class, 'store'])->name('store');
    Route::get('/{regency}/edit', [RegencyController::class, 'edit'])->name('edit');
    Route::put('/{regency}', [RegencyController::class, 'update'])->name('update');
    Route::delete('/{regency}', [RegencyController::class, 'destroy'])->name('destroy');
});

// Grup Route untuk Laporan
Route::prefix('reports')->name('reports.')->group(function () {
    Route::get('/province', [ReportController::class, 'province'])->name('province');
    Route::get('/regency', [ReportController::class, 'regency'])->name('regency');
    Route::get('/export/province', [ReportController::class, 'exportProvince'])->name('export.province');
    Route::get('/export/regency', [ReportController::class, 'exportRegency'])->name('export.regency');
});
Route::resource('provinces', ProvinceController::class)->except(['show']);
Route::resource('regencies', RegencyController::class)->except(['show']);

