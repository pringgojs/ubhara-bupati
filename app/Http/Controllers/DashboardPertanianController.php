<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Traits\LoggingTrait;

class DashboardPertanianController extends Controller
{
	use LoggingTrait;
    protected $isActiveLog = false;

    function __construct()
    {
        $this->isActiveLog = env('ACTIVE_LOG');
    }

    public function index(){
    	// Row 1
    	// Statistik Cards: 1. Jumlah Kelompok Tani 2. Jumlah total Petani 3. Total Luas Lahan 4. Jumlah Jenis Komoditas tahunan
    	
    	// Row 2
    	// Bar Chart: Luas Lahan per Kecamatan; Pie Chart: Jenis Lahan, Komoditas Hasil Panen Per Bulan
    	$kecamatans = Kecamatan::all();

    	// Row 3
    	// Line Chart: Sandingan data panen per Quartal per Tahun; List: Kelompok Tani Per Kecamatan
		if($this->isActiveLog) $this->saveLog('Akses Dashboard Pertanian');
    	return view('edm.pertanian.index', compact('kecamatans'));
    }
}
