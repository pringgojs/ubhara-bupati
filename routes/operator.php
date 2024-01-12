<?php

use App\Http\Controllers\MasterAnggotaPokmasController;
use App\Http\Controllers\MasterDesaController;
use App\Http\Controllers\MasterFasyankesController;
use App\Http\Controllers\MasterGuruController;
use App\Http\Controllers\MasterJalanController;
use App\Http\Controllers\MasterJembatanController;
use App\Http\Controllers\MasterKecamatanController;
use App\Http\Controllers\MasterKesehatanPoliController;
use App\Http\Controllers\MasterKomoditasController;
use App\Http\Controllers\MasterKomoditasPasarController;
use App\Http\Controllers\MasterKunjunganPoliController;
use App\Http\Controllers\MasterKunjunganWisataController;
use App\Http\Controllers\MasterMuridController;
use App\Http\Controllers\MasterNakesController;
use App\Http\Controllers\MasterPasarController;
use App\Http\Controllers\MasterPengunjungWisataController;
use App\Http\Controllers\MasterPokmasController;
use App\Http\Controllers\MasterSekolahController;
use App\Http\Controllers\MasterStatusJalanController;
use App\Http\Controllers\MasterStatusJembatanController;
use App\Http\Controllers\MasterWisataController;
use App\Http\Controllers\MasterIndikatorKinerjaController;
use App\Http\Controllers\MasterIndikatorKinerjaGroupController;
use App\Http\Controllers\MasterTargetSetoranController;
use App\Http\Controllers\MasterCapaianIndikatorKinerjaController;
use App\Http\Controllers\OperatorDashboardController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'operator'], function(){
    
    Route::get('dashboard', [OperatorDashboardController::class, 'index']);

    Route::group(['prefix' => 'iku'], function(){
        Route::get('/', [MasterIndikatorKinerjaController::class, 'index'])->name('operator.iku.index')->middleware('auth');
        Route::get('/create', [MasterIndikatorKinerjaController::class, 'create'])->name('operator.iku.create')->middleware('auth');
        Route::post('/create', [MasterIndikatorKinerjaController::class, 'store'])->name('operator.iku.store')->middleware('auth');
    });
    Route::group(['prefix' => 'iku-group'], function(){
        Route::get('/create', [MasterIndikatorKinerjaGroupController::class, 'create'])->name('operator.iku-group.create')->middleware('auth');
        Route::post('/create', [MasterIndikatorKinerjaGroupController::class, 'store'])->name('operator.iku-group.store')->middleware('auth');
    });

    Route::group(['prefix' => 'iku-capaian'], function(){
        Route::get('/create/{indikator_id}', [MasterCapaianIndikatorKinerjaController::class, 'create'])->name('operator.capaian-iku.create')->middleware('auth');
        Route::post('/create/{indikator_id}', [MasterCapaianIndikatorKinerjaController::class, 'store'])->name('operator.capaian-iku.store')->middleware('auth');
    });

    Route::group(['prefix' => 'kecamatan'], function(){
        Route::get('/', [MasterKecamatanController::class, 'index'])->name('operator.kecamatan.index')->middleware('auth');
        Route::post('/create', [MasterKecamatanController::class, 'store'])->name('operator.kecamatan.store')->middleware('auth');
        Route::get('/{id}/edit', [MasterKecamatanController::class, 'edit'])->name('operator.kecamatan.edit')->middleware('auth');
        Route::post('/{id}/edit', [MasterKecamatanController::class, 'update'])->name('operator.kecamatan.update')->middleware('auth');
        Route::get('/{id}/delete', [MasterKecamatanController::class, 'destroy'])->name('operator.kecamatan.destroy')->middleware('auth');
    });

    Route::group(['prefix' => 'desa'], function(){ 
        Route::get('/', [MasterDesaController::class, 'index'])->name('operator.desa.index')->middleware('auth');
        Route::post('/create', [MasterDesaController::class, 'store'])->name('operator.desa.store')->middleware('auth');
        Route::get('/{id}/edit', [MasterDesaController::class, 'edit'])->name('operator.desa.edit')->middleware('auth');
        Route::post('/{id}/edit', [MasterDesaController::class, 'update'])->name('operator.desa.update')->middleware('auth');
        Route::get('/{id}/delete', [MasterDesaController::class, 'destroy'])->name('operator.desa.destroy')->middleware('auth');
    });

    Route::group(['prefix' => 'anggaran'], function(){
        Route::get('/', [MasterKecamatanController::class, 'index'])->name('operator.anggaran.index')->middleware('auth');
        Route::post('/create', [MasterKecamatanController::class, 'store'])->name('operator.anggaran.store')->middleware('auth');
        Route::get('/{id}/edit', [MasterKecamatanController::class, 'edit'])->name('operator.anggaran.edit')->middleware('auth');
        Route::post('/{id}/edit', [MasterKecamatanController::class, 'update'])->name('operator.anggaran.update')->middleware('auth');
        Route::get('/{id}/delete', [MasterKecamatanController::class, 'destroy'])->name('operator.anggaran.destroy')->middleware('auth');
    });

    Route::group(['prefix' => 'infrastruktur-jalan'], function(){
        Route::get('/', [MasterJalanController::class, 'index'])->name('operator.infrastruktur-jalan.index')->middleware('auth');
        Route::post('/create', [MasterJalanController::class, 'store'])->name('operator.infrastruktur-jalan.store')->middleware('auth');
        Route::get('/{id}/edit', [MasterJalanController::class, 'edit'])->name('operator.infrastruktur-jalan.edit')->middleware('auth');
        Route::post('/{id}/edit', [MasterJalanController::class, 'update'])->name('operator.infrastruktur-jalan.update')->middleware('auth');
        Route::get('/{id}/delete', [MasterJalanController::class, 'destroy'])->name('operator.infrastruktur-jalan.destroy')->middleware('auth');
        Route::get('/bulk', [MasterJalanController::class, 'bulkpage'])->name('operator.infrastruktur-jalan.bulkpage')->middleware('auth');
        Route::post('/bulk', [MasterJalanController::class, 'bulkinsert'])->name('operator.infrastruktur-jalan.bulkinsert')->middleware('auth');
        Route::get('/bulk/{id}/validate', [MasterJalanController::class, 'bulkvalidate'])->name('operator.infrastruktur-jalan.bulkvalidate')->middleware('auth');
        Route::get('/bulk/{id}/rollback', [MasterJalanController::class, 'rollback'])->name('operator.infrastruktur-jalan.rollback')->middleware('auth');
    });

    Route::group(['prefix' => 'infrastruktur-jembatan'], function(){
        Route::get('/', [MasterJembatanController::class, 'index'])->name('operator.infrastruktur-jembatan.index')->middleware('auth');
        Route::post('/create', [MasterJembatanController::class, 'store'])->name('operator.infrastruktur-jembatan.store')->middleware('auth');
        Route::get('/{id}/edit', [MasterJembatanController::class, 'edit'])->name('operator.infrastruktur-jembatan.edit')->middleware('auth');
        Route::post('/{id}/edit', [MasterJembatanController::class, 'update'])->name('operator.infrastruktur-jembatan.update')->middleware('auth');
        Route::get('/{id}/delete', [MasterJembatanController::class, 'destroy'])->name('operator.infrastruktur-jembatan.destroy')->middleware('auth');
        Route::get('/bulk', [MasterJembatanController::class, 'bulkpage'])->name('operator.infrastruktur-jembatan.bulkpage')->middleware('auth');
        Route::post('/bulk', [MasterJembatanController::class, 'bulkinsert'])->name('operator.infrastruktur-jembatan.bulkinsert')->middleware('auth');
        Route::get('/bulk/{id}/validate', [MasterJembatanController::class, 'bulkvalidate'])->name('operator.infrastruktur-jembatan.bulkvalidate')->middleware('auth');
        Route::get('/bulk/{id}/rollback', [MasterJembatanController::class, 'rollback'])->name('operator.infrastruktur-jembatan.rollback')->middleware('auth');
    });

    Route::group(['prefix' => 'status-jalan'], function(){
        Route::get('/', [MasterStatusJalanController::class, 'index'])->name('operator.status-jalan.index')->middleware('auth');
        Route::post('/create', [MasterStatusJalanController::class, 'store'])->name('operator.status-jalan.store')->middleware('auth');
        Route::get('/{id}/edit', [MasterStatusJalanController::class, 'edit'])->name('operator.status-jalan.edit')->middleware('auth');
        Route::post('/{id}/edit', [MasterStatusJalanController::class, 'update'])->name('operator.status-jalan.update')->middleware('auth');
        Route::get('/{id}/delete', [MasterStatusJalanController::class, 'destroy'])->name('operator.status-jalan.destroy')->middleware('auth');
    });

    Route::group(['prefix' => 'status-jembatan'], function(){
        Route::get('/', [MasterStatusJembatanController::class, 'index'])->name('operator.status-jembatan.index')->middleware('auth');
        Route::post('/create', [MasterStatusJembatanController::class, 'store'])->name('operator.status-jembatan.store')->middleware('auth');
        Route::get('/{id}/edit', [MasterStatusJembatanController::class, 'edit'])->name('operator.status-jembatan.edit')->middleware('auth');
        Route::post('/{id}/edit', [MasterStatusJembatanController::class, 'update'])->name('operator.status-jembatan.update')->middleware('auth');
        Route::get('/{id}/delete', [MasterStatusJembatanController::class, 'destroy'])->name('operator.status-jembatan.destroy')->middleware('auth');
    });

    Route::group(['prefix' => 'wisata'], function(){
        Route::get('/', [MasterWisataController::class, 'index'])->name('operator.wisata.index')->middleware('auth');
        Route::post('/create', [MasterWisataController::class, 'store'])->name('operator.wisata.store')->middleware('auth');
        Route::get('/{id}/edit', [MasterWisataController::class, 'edit'])->name('operator.wisata.edit')->middleware('auth');
        Route::post('/{id}/edit', [MasterWisataController::class, 'update'])->name('operator.wisata.update')->middleware('auth');
        Route::get('/{id}/delete', [MasterWisataController::class, 'destroy'])->name('operator.wisata.destroy')->middleware('auth');
        Route::get('/bulk', [MasterWisataController::class, 'bulkpage'])->name('operator.wisata.bulkpage')->middleware('auth');
        Route::post('/bulk', [MasterWisataController::class, 'bulkinsert'])->name('operator.wisata.bulkinsert')->middleware('auth');
        Route::get('/bulk/{id}/validate', [MasterWisataController::class, 'bulkvalidate'])->name('operator.wisata.bulkvalidate')->middleware('auth');
    });

    Route::group(['prefix' => 'kunjungan-wisata'], function(){
        Route::get('/', [MasterWisataController::class, 'index'])->name('operator.kunjungan-wisata.index')->middleware('auth');
        Route::post('/create', [MasterWisataController::class, 'store'])->name('operator.kunjungan-wisata.store')->middleware('auth');
        Route::get('/{id}/edit', [MasterWisataController::class, 'edit'])->name('operator.kunjungan-wisata.edit')->middleware('auth');
        Route::post('/{id}/edit', [MasterWisataController::class, 'update'])->name('operator.kunjungan-wisata.update')->middleware('auth');
        Route::get('/{id}/delete', [MasterWisataController::class, 'destroy'])->name('operator.kunjungan-wisata.destroy')->middleware('auth');
        Route::get('/bulk', [MasterWisataController::class, 'bulkpage'])->name('operator.kunjungan-wisata.bulkpage')->middleware('auth');
        Route::post('/bulk', [MasterWisataController::class, 'bulkinsert'])->name('operator.kunjungan-wisata.bulkinsert')->middleware('auth');
        Route::get('/bulk/{id}/validate', [MasterWisataController::class, 'bulkvalidate'])->name('operator.kunjungan-wisata.bulkvalidate')->middleware('auth');
    });

    Route::group(['prefix' => 'pengunjung-wisata'], function(){
        Route::get('/', [MasterPengunjungWisataController::class, 'index'])->name('operator.pengunjung-wisata.index')->middleware('auth');
        Route::post('/create', [MasterPengunjungWisataController::class, 'store'])->name('operator.pengunjung-wisata.store')->middleware('auth');
        Route::get('/{id}/edit', [MasterPengunjungWisataController::class, 'edit'])->name('operator.pengunjung-wisata.edit')->middleware('auth');
        Route::post('/{id}/edit', [MasterPengunjungWisataController::class, 'update'])->name('operator.pengunjung-wisata.update')->middleware('auth');
        Route::get('/{id}/delete', [MasterPengunjungWisataController::class, 'destroy'])->name('operator.pengunjung-wisata.destroy')->middleware('auth');
        Route::post('/{id}/delete', [MasterPengunjungWisataController::class, 'delete'])->name('operator.pengunjung-wisata.delete')->middleware('auth');
    });

    Route::group(['prefix' => 'sekolah'], function(){
        Route::get('/', [MasterSekolahController::class, 'index'])->name('operator.sekolah.index')->middleware('auth');
        Route::post('/create', [MasterSekolahController::class, 'store'])->name('operator.sekolah.store')->middleware('auth');
        Route::get('/{id}/edit', [MasterSekolahController::class, 'edit'])->name('operator.sekolah.edit')->middleware('auth');
        Route::post('/{id}/edit', [MasterSekolahController::class, 'update'])->name('operator.sekolah.update')->middleware('auth');
        Route::get('/{id}/delete', [MasterSekolahController::class, 'destroy'])->name('operator.sekolah.destroy')->middleware('auth');
        Route::get('/bulk', [MasterSekolahController::class, 'bulkpage'])->name('operator.sekolah.bulkpage')->middleware('auth');
        Route::post('/bulk', [MasterSekolahController::class, 'bulkinsert'])->name('operator.sekolah.bulkinsert')->middleware('auth');
        Route::get('/bulk/{id}/validate', [MasterSekolahController::class, 'bulkvalidate'])->name('operator.sekolah.bulkvalidate')->middleware('auth');
    });

    Route::group(['prefix' => 'guru'], function(){
        Route::get('/', [MasterGuruController::class, 'index'])->name('operator.guru.index')->middleware('auth');
        Route::post('/create', [MasterGuruController::class, 'store'])->name('operator.guru.store')->middleware('auth');
        Route::get('/{id}/edit', [MasterGuruController::class, 'edit'])->name('operator.guru.edit')->middleware('auth');
        Route::post('/{id}/edit', [MasterGuruController::class, 'update'])->name('operator.guru.update')->middleware('auth');
        Route::get('/{id}/delete', [MasterGuruController::class, 'destroy'])->name('operator.guru.destroy')->middleware('auth');
        Route::get('/bulk', [MasterGuruController::class, 'bulkpage'])->name('operator.guru.bulkpage')->middleware('auth');
        Route::post('/bulk', [MasterGuruController::class, 'bulkinsert'])->name('operator.guru.bulkinsert')->middleware('auth');
        Route::get('/bulk/{id}/validate', [MasterGuruController::class, 'bulkvalidate'])->name('operator.guru.bulkvalidate')->middleware('auth');
    });

    Route::group(['prefix' => 'murid'], function(){
        Route::get('/', [MasterMuridController::class, 'index'])->name('operator.murid.index')->middleware('auth');
        Route::post('/create', [MasterMuridController::class, 'store'])->name('operator.murid.store')->middleware('auth');
        Route::get('/{id}/edit', [MasterMuridController::class, 'edit'])->name('operator.murid.edit')->middleware('auth');
        Route::post('/{id}/edit', [MasterMuridController::class, 'update'])->name('operator.murid.update')->middleware('auth');
        Route::get('/{id}/delete', [MasterMuridController::class, 'destroy'])->name('operator.murid.destroy')->middleware('auth');
        Route::get('/bulk', [MasterMuridController::class, 'bulkpage'])->name('operator.murid.bulkpage')->middleware('auth');
        Route::post('/bulk', [MasterMuridController::class, 'bulkinsert'])->name('operator.murid.bulkinsert')->middleware('auth');
        Route::get('/bulk/{id}/validate', [MasterMuridController::class, 'bulkvalidate'])->name('operator.murid.bulkvalidate')->middleware('auth');
    });
    
    Route::group(['prefix' => 'kelompok-masyarakat-tani'], function(){
        Route::get('/', [MasterPokmasController::class, 'index'])->name('operator.kelompok-masyarakat-tani.index')->middleware('auth');
        Route::post('/create', [MasterPokmasController::class, 'store'])->name('operator.kelompok-masyarakat-tani.store')->middleware('auth');
        Route::get('/{id}/edit', [MasterPokmasController::class, 'edit'])->name('operator.kelompok-masyarakat-tani.edit')->middleware('auth');
        Route::post('/{id}/edit', [MasterPokmasController::class, 'update'])->name('operator.kelompok-masyarakat-tani.update')->middleware('auth');
        Route::get('/{id}/delete', [MasterPokmasController::class, 'destroy'])->name('operator.kelompok-masyarakat-tani.destroy')->middleware('auth');
        Route::get('/bulk', [MasterPokmasController::class, 'bulkpage'])->name('operator.kelompok-masyarakat-tani.bulkpage')->middleware('auth');
        Route::post('/bulk', [MasterPokmasController::class, 'bulkinsert'])->name('operator.kelompok-masyarakat-tani.bulkinsert')->middleware('auth');
        Route::get('/bulk/{id}/validate', [MasterPokmasController::class, 'bulkvalidate'])->name('operator.kelompok-masyarakat-tani.bulkvalidate')->middleware('auth');

        Route::get('/{id_pokmas}/anggota', [MasterAnggotaPokmasController::class, 'index'])->name('operator.anggota-pokmas.index')->middleware('auth');
        Route::post('/{id_pokmas}/create', [MasterAnggotaPokmasController::class, 'store'])->name('operator.anggota-pokmas.store')->middleware('auth');
        Route::get('/{id_pokmas}/{id}/edit', [MasterAnggotaPokmasController::class, 'edit'])->name('operator.anggota-pokmas.edit')->middleware('auth');
        Route::post('/{id_pokmas}/{id}/edit', [MasterAnggotaPokmasController::class, 'update'])->name('operator.anggota-pokmas.update')->middleware('auth');
        Route::get('/{id_pokmas}/{id}/delete', [MasterAnggotaPokmasController::class, 'destroy'])->name('operator.anggota-pokmas.destroy')->middleware('auth');
    });

    Route::group(['prefix' => 'komoditas'], function(){
        Route::get('/', [MasterKomoditasController::class, 'index'])->name('operator.komoditas.index')->middleware('auth');
        Route::post('/create', [MasterKomoditasController::class, 'store'])->name('operator.komoditas.store')->middleware('auth');
        Route::get('/{id}/edit', [MasterKomoditasController::class, 'edit'])->name('operator.komoditas.edit')->middleware('auth');
        Route::post('/{id}/edit', [MasterKomoditasController::class, 'update'])->name('operator.komoditas.update')->middleware('auth');
        Route::get('/{id}/delete', [MasterKomoditasController::class, 'destroy'])->name('operator.komoditas.destroy')->middleware('auth');
    });

    Route::group(['prefix' => 'kunjungan-poli'], function(){
        Route::get('/', [MasterKunjunganPoliController::class, 'index'])->name('operator.kunjungan-poli.index')->middleware('auth');
        Route::post('/create', [MasterKunjunganPoliController::class, 'store'])->name('operator.kunjungan-poli.store')->middleware('auth');
        Route::get('/{id}/edit', [MasterKunjunganPoliController::class, 'edit'])->name('operator.kunjungan-poli.edit')->middleware('auth');
        Route::post('/{id}/edit', [MasterKunjunganPoliController::class, 'update'])->name('operator.kunjungan-poli.update')->middleware('auth');
        Route::get('/{id}/delete', [MasterKunjunganPoliController::class, 'destroy'])->name('operator.kunjungan-poli.destroy')->middleware('auth');
        Route::post('/{id}/delete', [MasterKunjunganPoliController::class, 'delete'])->name('operator.kunjungan-poli.delete')->middleware('auth');
    });

    Route::group(['prefix' => 'kesehatan-poli'], function(){
        Route::get('/', [MasterKesehatanPoliController::class, 'index'])->name('operator.kesehatan-poli.index')->middleware('auth');
        Route::post('/create', [MasterKesehatanPoliController::class, 'store'])->name('operator.kesehatan-poli.store')->middleware('auth');
        Route::get('/{id}/edit', [MasterKesehatanPoliController::class, 'edit'])->name('operator.kesehatan-poli.edit')->middleware('auth');
        Route::post('/{id}/edit', [MasterKesehatanPoliController::class, 'update'])->name('operator.kesehatan-poli.update')->middleware('auth');
        Route::get('/{id}/delete', [MasterKesehatanPoliController::class, 'destroy'])->name('operator.kesehatan-poli.destroy')->middleware('auth');
        Route::post('/{id}/delete', [MasterKesehatanPoliController::class, 'delete'])->name('operator.kesehatan-poli.delete')->middleware('auth');
    });

    Route::group(['prefix' => 'kesehatan-fasyankes'], function(){
        Route::get('/', [MasterFasyankesController::class, 'index'])->name('operator.kesehatan-fasyankes.index')->middleware('auth');
        Route::post('/create', [MasterFasyankesController::class, 'store'])->name('operator.kesehatan-fasyankes.store')->middleware('auth');
        Route::get('/{id}/edit', [MasterFasyankesController::class, 'edit'])->name('operator.kesehatan-fasyankes.edit')->middleware('auth');
        Route::post('/{id}/edit', [MasterFasyankesController::class, 'update'])->name('operator.kesehatan-fasyankes.update')->middleware('auth');
        Route::get('/{id}/delete', [MasterFasyankesController::class, 'destroy'])->name('operator.kesehatan-fasyankes.destroy')->middleware('auth');
        Route::post('/{id}/delete', [MasterFasyankesController::class, 'delete'])->name('operator.kesehatan-fasyankes.delete')->middleware('auth');
    });
    
    Route::group(['prefix' => 'kesehatan-tenaga'], function(){
        Route::get('/', [MasterNakesController::class, 'index'])->name('operator.kesehatan-tenaga.index')->middleware('auth');
        Route::post('/create', [MasterNakesController::class, 'store'])->name('operator.kesehatan-tenaga.store')->middleware('auth');
        Route::get('/{id}/edit', [MasterNakesController::class, 'edit'])->name('operator.kesehatan-tenaga.edit')->middleware('auth');
        Route::post('/{id}/edit', [MasterNakesController::class, 'update'])->name('operator.kesehatan-tenaga.update')->middleware('auth');
        Route::get('/{id}/delete', [MasterNakesController::class, 'destroy'])->name('operator.kesehatan-tenaga.destroy')->middleware('auth');
        Route::get('/bulk', [MasterNakesController::class, 'bulkpage'])->name('operator.kesehatan-tenaga.bulkpage')->middleware('auth');
        Route::post('/bulk', [MasterNakesController::class, 'bulkinsert'])->name('operator.kesehatan-tenaga.bulkinsert')->middleware('auth');
        Route::get('bulk/{id}/validate', [MasterNakesController::class, 'bulkvalidate'])->name('operator.kesehatan-tenaga.bulkvalidate')->middleware('auth');
    });

    Route::group(['prefix' => 'pasar'], function(){
        Route::get('/', [MasterPasarController::class, 'index'])->name('operator.pasar.index')->middleware('auth');
        Route::post('/create', [MasterPasarController::class, 'store'])->name('operator.pasar.store')->middleware('auth');
        Route::get('/{id}/edit', [MasterPasarController::class, 'edit'])->name('operator.pasar.edit')->middleware('auth');
        Route::post('/{id}/edit', [MasterPasarController::class, 'update'])->name('operator.pasar.update')->middleware('auth');
        Route::get('/{id}/delete', [MasterPasarController::class, 'destroy'])->name('operator.pasar.destroy')->middleware('auth');
        Route::get('/{id}/target-setoran', [MasterTargetSetoranController::class, 'index'])->name('operator.pasar.target-setoran')->middleware('auth');
    });
    Route::group(['prefix' => 'setoran-pasar'], function(){
        Route::post('create-target/{id}', [MasterTargetSetoranController::class, 'storetarget'])->name('operator.setoran-pasar.create-target')->middleware('auth');
        Route::post('create-setoran/{id}', [MasterTargetSetoranController::class, 'storesetoran'])->name('operator.setoran-pasar.create-setoran')->middleware('auth');
        Route::get('delete-target/{id}', [MasterTargetSetoranController::class, 'deletetarget'])->name('operator.setoran-pasar.delete-target')->middleware('auth');
        Route::get('delete-setoran/{id}', [MasterTargetSetoranController::class, 'deletesetoran'])->name('operator.setoran-pasar.delete-setoran')->middleware('auth');
    });

    Route::group(['prefix' => 'komoditas-pasar'], function(){
        Route::get('/', [MasterKomoditasPasarController::class, 'index'])->name('operator.komoditas-pasar.index')->middleware('auth');
        Route::post('/create', [MasterKomoditasPasarController::class, 'store'])->name('operator.komoditas-pasar.store')->middleware('auth');
        Route::get('/{id}/edit', [MasterKomoditasPasarController::class, 'edit'])->name('operator.komoditas-pasar.edit')->middleware('auth');
        Route::post('/{id}/edit', [MasterKomoditasPasarController::class, 'update'])->name('operator.komoditas-pasar.update')->middleware('auth');
        Route::get('/{id}/delete', [MasterKomoditasPasarController::class, 'destroy'])->name('operator.komoditas-pasar.destroy')->middleware('auth');
    });
});