<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Traits\LoggingTrait;
use App\Models\Pasar;
use App\Models\TargetSetoran;
use App\Models\SetoranPasar;

class DashboardPasarController extends Controller
{
	use LoggingTrait;
    protected $isActiveLog = false;

    function __construct()
    {
        $this->isActiveLog = env('ACTIVE_LOG');
    }

    public function index(){
    	// Pie Chart: Kondisi Pasar; Pie Chart: Jenis Pasar (Mall, Tradisional, Hewan); Statistik Total Pasar; Statistik Revenue Total Per Bulan
    	// Line Chart: Prosentase Penarikan Uang Sewa dan Pajak; List semua pasar
    	$kecamatans = Kecamatan::all();
        $count_pasar = Pasar::select('nama')->distinct()->count();
        $target_revenue = TargetSetoran::where('tahun_anggaran', date('Y'))->sum('target');
        $current_revenue = SetoranPasar::leftJoin('target_setorans', 'setoran_pasars.target_setoran_id', 'target_setorans.id')
            ->where('target_setorans.tahun_anggaran', date('Y'))
            ->sum('setoran_pasars.setoran_terkumpul');
        
        
        if($this->isActiveLog) $this->saveLog('Akses Dashboard Pasar');
    	return view('edm.pasar.index', compact('kecamatans', 'count_pasar', 'target_revenue', 'current_revenue'));
    }
}
