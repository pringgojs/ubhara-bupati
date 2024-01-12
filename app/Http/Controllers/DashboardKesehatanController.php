<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Traits\LoggingTrait;

class DashboardKesehatanController extends Controller
{
	use LoggingTrait;
    protected $isActiveLog = false;

    function __construct()
    {
        $this->isActiveLog = env('ACTIVE_LOG');
    }

    public function index(){
    	$kecamatans = Kecamatan::all();
    	$desas = Desa::leftJoin('kecamatans', 'desas.kecamatan_id', 'kecamatans.id')
    		->select('desas.*', 'kecamatans.name as kecamatan')
    		->get();
        if($this->isActiveLog) $this->saveLog('Akses Dashboard Kesehatan');
    	return view('edm.kesehatan.index', compact('kecamatans', 'desas'));
    }
}
