<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Traits\LoggingTrait;

class DashboardKecamatanController extends Controller
{
    use LoggingTrait;
    protected $isActiveLog = false;

    function __construct()
    {
        $this->isActiveLog = env('ACTIVE_LOG');
    }

    public function index($id, $modul){
    	$kecamatan = Kecamatan::find($id);
        if (empty($kecamatan))
            return redirect()->back();
        $desas = Desa::where('kecamatan_id', $id)->get();
        if($this->isActiveLog) $this->saveLog('Akses Dashboard Kecamatan');
    	return view('edm.kecamatan.'.$modul, compact('kecamatan', 'modul', 'desas'));
    }
}
