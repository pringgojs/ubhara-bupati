<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Traits\LoggingTrait;

class DashboardInfrastrukturJalanController extends Controller
{
    use LoggingTrait;
    protected $isActiveLog = false;

    function __construct()
    {
        $this->isActiveLog = env('ACTIVE_LOG');
    }

    public function index(){
        $kecamatans = Kecamatan::all();
        if($this->isActiveLog) $this->saveLog('Akses Dashboard Jalan');
        return view('edm.infrastruktur-jalan.index', compact('kecamatans'));
    }

    public function kondisi($status){
        $kecamatans = Kecamatan::all();
        return view('edm.infrastruktur-jalan.kondisi', compact('kecamatans', 'status'));
    }

    public function kecamatan($id){
        $kecamatan = Kecamatan::find($id);
        if (empty($kecamatan))
            return redirect()->back();
        $desas = Desa::where('kecamatan_id', $id)->get();
        return view('edm.infrastruktur-jalan.kecamatan', compact('kecamatan', 'desas'));
    }

    public function desa($id){
        $desa = Desa::find($id);
        if (empty($desa))
            return redirect()->back();
        return view('edm.infrastruktur-jalan.desa', compact('desa'));
    }
}
