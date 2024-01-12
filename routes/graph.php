<?php

use App\Http\Controllers\GraphJalanController;
use App\Http\Controllers\GraphJembatanController;
use App\Http\Controllers\GraphKesehatanController;
use App\Http\Controllers\GraphPendidikanController;
use App\Http\Controllers\GraphPertanianController;
use App\Http\Controllers\GraphWisataController;


use App\Http\Controllers\GraphKecamatanJalanController;
use App\Http\Controllers\GraphKecamatanJembatanController;
use App\Http\Controllers\GraphKecamatanPendidikanController;
use App\Http\Controllers\GraphKecamatanPertanianController;
use App\Http\Controllers\GraphKecamatanKesehatanController;

use App\Http\Controllers\GraphDesaPendidikanController;
use App\Http\Controllers\GraphDesaPertanianController;
use App\Http\Controllers\GraphDesaKesehatanController;
use App\Http\Controllers\GraphPasarController;
use App\Http\Controllers\GraphRencAngController;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'graph'], function(){
    Route::get('jalan/rekapitulasi-kondisi-jalan', [GraphJalanController::class, 'rekapitulasikondisijalan'])->name('graph.jalan.rekapitulasi-kondisi-jalan');
    Route::get('jalan/rekapitulasi-perkecamatan', [GraphJalanController::class, 'rekapitulasiperkecamatan'])->name('graph.jalan.rekapitulasi-perkecamatan');
    Route::get('jalan/rekapitulasi-bahan', [GraphJalanController::class, 'rekapitulasibahan'])->name('graph.jalan.rekapitulasi-bahan');
    Route::get('jalan/list', [GraphJalanController::class, 'listjalan'])->name('graph.jalan.listjalan');
    Route::group(['prefix' => 'renc-ang'], function(){
        Route::get('semua-urusan', [GraphRencAngController::class, 'urusan'])->name('graph.renc-ang.semua-urusan');
        Route::get('semua-bidang/{bidang_id}', [GraphRencAngController::class, 'bidang'])->name('graph.renc-ang.semua-bidang');
        Route::get('semua-program/{program_id}', [GraphRencAngController::class, 'program'])->name('graph.renc-ang.semua-program');
        Route::get('semua-kegiatan', [GraphRencAngController::class, 'kegiatan'])->name('graph.renc-ang.semua-kegiatan');

    });
    Route::group(['prefix' => 'jembatan'], function(){
        Route::get('rekapitulasi-kondisi', [GraphJembatanController::class, 'rekapitulasikondisi'])->name('graph.jembatan.rekapitulasi-kondisi');
        Route::get('rekapitulasi-tipe-struktur', [GraphJembatanController::class, 'rekapitulasitipestruktur'])->name('graph.jembatan.rekapitulasi-tipe-struktur');
        Route::get('rekapitulasi-perkecamatan', [GraphJembatanController::class, 'rekapitulasiperkecamatan'])->name('graph.jembatan.rekapitulasi-perkecamatan');
        Route::get('list', [GraphJembatanController::class, 'listjembatan'])->name('graph.jembatan.listjembatan');
    });

    Route::group(['prefix'=> 'kesehatan'], function(){
        Route::get('/cards', [GraphKesehatanController::class, 'cards'])->name('graph.kesehatan.cards');
        Route::get('/jenis-fasyankes', [GraphKesehatanController::class, 'jenisfasyankes'])->name('graph.kesehatan.jenisfasyankes');
        Route::get('/jenis-nakes', [GraphKesehatanController::class, 'jenisnakes'])->name('graph.kesehatan.jenisnakes');
        Route::get('/fasyankesperkecamatan', [GraphKesehatanController::class, 'fasyankesperkecamatan'])->name('graph.kesehatan.fasyankesperkecamatan');
        Route::get('list', [GraphKesehatanController::class, 'listfasyankes'])->name('graph.kesehatan.listfasyankes');
    });
    
    Route::group(['prefix' => 'pendidikan'], function(){
        Route::get('/cards', [GraphPendidikanController::class, 'cards'])->name('graph.pendidikan.cards');
        Route::get('/siswa-per-kelas', [GraphPendidikanController::class, 'jumlahsiswaperkelas'])->name('graph.pendidikan.siswa-per-kelas');
        Route::get('/guru-vs-murid', [GraphPendidikanController::class, 'guruvsmurid'])->name('graph.pendidikan.guru-vs-murid');
        Route::get('/negeri-vs-swasta', [GraphPendidikanController::class, 'negerivsswasta'])->name('graph.pendidikan.negeri-vs-swasta');
    });

    Route::group(['prefix' => 'pertanian'], function(){
        Route::get('/cards', [GraphPertanianController::class, 'cards'])->name('graph.pertanian.cards');
        Route::get('/lahan-per-kecamatan', [GraphPertanianController::class, 'lahanperkecamatan'])->name('graph.pertanian.lahan-per-kecamatan');
        Route::get('/jenis-lahan', [GraphPertanianController::class, 'jenislahan'])->name('graph.pertanian.jenis-lahan');
        Route::get('/komoditas-lahan', [GraphPertanianController::class, 'komoditaslahan'])->name('graph.pertanian.komoditas-lahan');
        Route::get('/petani-per-kecamatan', [GraphPertanianController::class, 'petaniperkecamatan'])->name('graph.pertanian.petani-per-kecamatan');
        Route::get('/poktan-per-kecamatan', [GraphPertanianController::class, 'poktanperkecamatan'])->name('graph.pertanian.poktan-per-kecamatan');
    });
    Route::group(['prefix' => 'wisata'], function(){
        Route::get('cards', [GraphWisataController::class, 'cards'])->name('graph.wisata.cards');
        Route::get('kunjungan', [GraphWisataController::class, 'kunjungan'])->name('graph.wisata.kunjungan');
        Route::get('market-shares', [GraphWisataController::class, 'marketshares'])->name('graph.wisata.market-shares');
        Route::get('monthly-recap', [GraphWisataController::class, 'monthlyrecap'])->name('graph.wisata.monthly-recap');
        Route::get('yearly-recap', [GraphWisataController::class, 'yearlyrecap'])->name('graph.wisata.yearly-recap');
        Route::get('trendings', [GraphWisataController::class, 'trendings'])->name('graph.wisata.trendings');
        Route::get('list', [GraphWisataController::class, 'list'])->name('graph.wisata.list');
    });

    Route::group(['prefix' => 'pasar'], function(){
        Route::get('market-share', [GraphPasarController::class, 'marketshare'])->name('graph.pasar.market-share');
        Route::get('jenis-pasar', [GraphPasarController::class, 'jenispasar'])->name('graph.pasar.jenis-pasar');
        Route::get('grafik-pembayaran', [GraphPasarController::class, 'grafikpembayaran'])->name('graph.pasar.grafik-pembayaran');
    });
});

Route::group(['prefix' => 'graph-kecamatan'], function(){
    Route::group(['prefix' => 'jalan'], function(){
        Route::get('cards/{kecamatan_id}', [GraphKecamatanJalanController::class, 'cards'])->name('graph-kecamatan.jalan.cards');
        Route::get('rekapitulasi-kondisi-jalan/{kecamatan_id}', [GraphKecamatanJalanController::class, 'rekapitulasikondisijalan'])->name('graph-kecamatan.jalan.rekapitulasi-kondisi-jalan');
        Route::get('rekapitulasi-bahan/{kecamatan_id}', [GraphKecamatanJalanController::class, 'rekapitulasibahan'])->name('graph-kecamatan.jalan.rekapitulasi-bahan');
        Route::get('list/{kecamatan_id}', [GraphKecamatanJalanController::class, 'listjalan'])->name('graph-kecamatan.jalan.listjalan');
    });

    Route::group(['prefix' => 'jembatan'], function(){
        Route::get('cards/{kecamatan_id}', [GraphKecamatanJembatanController::class, 'cards'])->name('graph-kecamatan.jembatan.cards');
        Route::get('rekapitulasi-kondisi-jembatan/{kecamatan_id}', [GraphKecamatanJembatanController::class, 'rekapitulasikondisijembatan'])->name('graph-kecamatan.jembatan.rekapitulasi-kondisi-jembatan');
        Route::get('rekapitulasi-struktur/{kecamatan_id}', [GraphKecamatanJembatanController::class, 'rekapitulasistruktur'])->name('graph-kecamatan.jembatan.rekapitulasi-struktur');
        Route::get('list/{kecamatan_id}', [GraphKecamatanJembatanController::class, 'listjembatan'])->name('graph-kecamatan.jembatan.listjembatan');
    });

    Route::group(['prefix' => 'pendidikan'], function(){
        Route::get('/cards/{kecamatan_id}', [GraphKecamatanPendidikanController::class, 'cards'])->name('graph-kecamatan.pendidikan.cards');
        Route::get('/siswa-per-kelas/{kecamatan_id}', [GraphKecamatanPendidikanController::class, 'jumlahsiswaperkelas'])->name('graph-kecamatan.pendidikan.siswa-per-kelas');
        Route::get('/guru-vs-murid/{kecamatan_id}', [GraphKecamatanPendidikanController::class, 'guruvsmurid'])->name('graph-kecamatan.pendidikan.guru-vs-murid');
        Route::get('/negeri-vs-swasta/{kecamatan_id}', [GraphKecamatanPendidikanController::class, 'negerivsswasta'])->name('graph-kecamatan.pendidikan.negeri-vs-swasta');
        Route::get('list-sekolah/{kecamatan_id}', [GraphKecamatanPendidikanController::class, 'listsekolah'])->name('graph-kecamatan.pendidikan.list-sekolah');
    });

    Route::group(['prefix' => 'pertanian'], function(){
        Route::get('/cards/{kecamatan_id}', [GraphKecamatanPertanianController::class, 'cards'])->name('graph-kecamatan.pertanian.cards');
        Route::get('/lahan-per-desa/{kecamatan_id}', [GraphKecamatanPertanianController::class, 'lahanperdesa'])->name('graph-kecamatan.pertanian.lahan-per-desa');
        Route::get('/jenis-lahan/{kecamatan_id}', [GraphKecamatanPertanianController::class, 'jenislahan'])->name('graph-kecamatan.pertanian.jenis-lahan');
        Route::get('/komoditas-lahan/{kecamatan_id}', [GraphKecamatanPertanianController::class, 'komoditaslahan'])->name('graph-kecamatan.pertanian.komoditas-lahan');
        Route::get('/poktan-per-desa/{kecamatan_id}', [GraphKecamatanPertanianController::class, 'poktanperdesa'])->name('graph-kecamatan.pertanian.poktan-per-desa');
        Route::get('/petani-per-desa/{kecamatan_id}', [GraphKecamatanPertanianController::class, 'petaniperdesa'])->name('graph-kecamatan.pertanian.petani-per-desa');
    });

    Route::group(['prefix'=> 'kesehatan'], function(){
        Route::get('/cards/{kecamatan_id}', [GraphKecamatanKesehatanController::class, 'cards'])->name('graph-kecamatan.kesehatan.cards');
        Route::get('/jenis-fasyankes/{kecamatan_id}', [GraphKecamatanKesehatanController::class, 'jenisfasyankes'])->name('graph-kecamatan.kesehatan.jenisfasyankes');
        Route::get('/jenis-nakes/{kecamatan_id}', [GraphKecamatanKesehatanController::class, 'jenisnakes'])->name('graph-kecamatan.kesehatan.jenisnakes');
        Route::get('/fasyankesperdesa/{kecamatan_id}', [GraphKecamatanKesehatanController::class, 'fasyankesperdesa'])->name('graph-kecamatan.kesehatan.fasyankesperdesa');
        Route::get('list/{kecamatan_id}', [GraphKecamatanKesehatanController::class, 'listfasyankes'])->name('graph-kecamatan.kesehatan.listfasyankes');
    });
});
Route::group(['prefix' => 'graph-desa'], function(){
   
    Route::group(['prefix' => 'pendidikan'], function(){
        Route::get('/cards/{desa_id}', [GraphDesaPendidikanController::class, 'cards'])->name('graph-desa.pendidikan.cards');
        Route::get('/siswa-per-kelas/{desa_id}', [GraphDesaPendidikanController::class, 'jumlahsiswaperkelas'])->name('graph-desa.pendidikan.siswa-per-kelas');
        Route::get('/guru-vs-murid/{desa_id}', [GraphDesaPendidikanController::class, 'guruvsmurid'])->name('graph-desa.pendidikan.guru-vs-murid');
        Route::get('/negeri-vs-swasta/{desa_id}', [GraphDesaPendidikanController::class, 'negerivsswasta'])->name('graph-desa.pendidikan.negeri-vs-swasta');
        Route::get('list-sekolah/{desa_id}', [GraphDesaPendidikanController::class, 'listsekolah'])->name('graph-desa.pendidikan.list-sekolah');
    });

    Route::group(['prefix' => 'pertanian'], function(){
        Route::get('/cards/{desa_id}', [GraphDesaPertanianController::class, 'cards'])->name('graph-desa.pertanian.cards');
        Route::get('/jenis-lahan/{desa_id}', [GraphDesaPertanianController::class, 'jenislahan'])->name('graph-desa.pertanian.jenis-lahan');
        Route::get('/komoditas-lahan/{desa_id}', [GraphDesaPertanianController::class, 'komoditaslahan'])->name('graph-desa.pertanian.komoditas-lahan');
        Route::get('list-poktan/{desa_id}', [GraphDesaPertanianController::class, 'listpoktan'])->name('graph-desa.pertanian.list-poktan');
        Route::get('list-lahan-pertanian/{desa_id}', [GraphDesaPertanianController::class, 'listlahanpertanian'])->name('graph-desa.pertanian.list-lahan-pertanian');
    });

    Route::group(['prefix'=> 'kesehatan'], function(){
        Route::get('/cards/{desa_id}', [GraphDesaKesehatanController::class, 'cards'])->name('graph-desa.kesehatan.cards');
        Route::get('/jenis-fasyankes/{desa_id}', [GraphDesaKesehatanController::class, 'jenisfasyankes'])->name('graph-desa.kesehatan.jenisfasyankes');
        Route::get('/jenis-nakes/{desa_id}', [GraphDesaKesehatanController::class, 'jenisnakes'])->name('graph-desa.kesehatan.jenisnakes');
        Route::get('/fasyankesperdesa/{desa_id}', [GraphDesaKesehatanController::class, 'fasyankesperdesa'])->name('graph-desa.kesehatan.fasyankesperdesa');
        Route::get('list/{desa_id}', [GraphDesaKesehatanController::class, 'listfasyankes'])->name('graph-desa.kesehatan.listfasyankes');
        Route::get('list-nakes/{desa_id}', [GraphDesaKesehatanController::class, 'listnakes'])->name('graph-desa.kesehatan.listnakes');

    });
});