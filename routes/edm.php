<?php

use App\Http\Controllers\DashboardAnggaranController;
use App\Http\Controllers\DashboardDesaController;
use App\Http\Controllers\DashboardInfrastrukturJalanController;
use App\Http\Controllers\DashboardInfrastrukturJembatanController;
use App\Http\Controllers\DashboardKecamatanController;
use App\Http\Controllers\DashboardKesehatanController;
use App\Http\Controllers\DashboardPasarController;
use App\Http\Controllers\DashboardPendidikanController;
use App\Http\Controllers\DashboardPertanianController;
use App\Http\Controllers\DashboardWisataController;
use App\Http\Controllers\DashboardRencAngController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'edm'], function(){
    Route::get('anggaran', [DashboardAnggaranController::class, 'index'])->name('edm.anggaran.index')->middleware('auth');
    Route::get('infrastruktur-jalan', [DashboardInfrastrukturJalanController::class, 'index'])->name('edm.infrastruktur-jalan.index')->middleware('auth');
    Route::get('infrastruktur-jalan/kondisi/{status}', [DashboardInfrastrukturJalanController::class, 'kondisi'])->name('edm.infrastruktur-jalan.kondisi')->middleware('auth');
    Route::get('infrastruktur-jalan/kecamatan/{id}', [DashboardInfrastrukturJalanController::class, 'kecamatan'])->name('edm.infrastruktur-jalan.kecamatan')->middleware('auth');
    Route::get('infrastruktur-jalan/desa/{id}', [DashboardInfrastrukturJalanController::class, 'desa'])->name('edm.infrastruktur-jalan.desa')->middleware('auth');

    Route::get('infrastruktur-jembatan', [DashboardInfrastrukturJembatanController::class, 'index'])->name('edm.infrastruktur-jembatan.index')->middleware('auth');
    Route::get('infrastruktur-jembatan/kondisi/{status}', [DashboardInfrastrukturJembatanController::class, 'kondisi'])->name('edm.infrastruktur-jembatan.kondisi')->middleware('auth');
    Route::get('infrastruktur-jembatan/kecamatan/{id}', [DashboardInfrastrukturJembatanController::class, 'kecamatan'])->name('edm.infrastruktur-jembatan.kecamatan')->middleware('auth');
    Route::get('infrastruktur-jembatan/desa/{id}', [DashboardInfrastrukturJembatanController::class, 'desa'])->name('edm.infrastruktur-jembatan.desa')->middleware('auth');
    
    Route::get('wisata', [DashboardWisataController::class, 'index'])->name('edm.wisata.index')->middleware('auth');
    Route::get('wisata/detail/{id}', [DashboardWisataController::class, 'detail'])->name('edm.wisata.detail')->middleware('auth');

    Route::get('kesehatan', [DashboardKesehatanController::class, 'index'])->name('edm.kesehatan.index')->middleware('auth');
    Route::get('pasar', [DashboardPasarController::class, 'index'])->name('edm.pasar.index')->middleware('auth');
    Route::get('pendidikan', [DashboardPendidikanController::class, 'index'])->name('edm.pendidikan.index')->middleware('auth');
    Route::get('pertanian', [DashboardPertanianController::class, 'index'])->name('edm.pertanian.index')->middleware('auth');
    
    Route::get('iku', [DashboardRencAngController::class, 'iku'])->name('edm.renc-ang.iku')->middleware('auth');
    Route::get('anggaran', [DashboardRencAngController::class, 'anggaran'])->name('edm.renc-ang.anggaran')->middleware('auth');
    Route::get('urusan/{urusan}', [DashboardRencAngController::class, 'urusan'])->name('edm.renc-ang.urusan')->middleware('auth');
    Route::get('bidang/{bidang}', [DashboardRencAngController::class, 'bidang'])->name('edm.renc-ang.bidang')->middleware('auth');
    Route::get('program/', [DashboardRencAngController::class, 'program'])->name('edm.renc-ang.program')->middleware('auth');
    Route::get('kegiatan/', [DashboardRencAngController::class, 'kegiatan'])->name('edm.renc-ang.kegiatan')->middleware('auth');

    Route::get('kecamatan/{id}/{modul}', [DashboardKecamatanController::class, 'index'])->name('edm.kecamatan.index')->middleware('auth');

    Route::get('desa/{id}/{modul}', [DashboardDesaController::class, 'index'])->name('edm.desa.index')->middleware('auth');
});
