<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Traits\LoggingTrait;

class DashboardWisataController extends Controller
{
    use LoggingTrait;
    protected $isActiveLog = false;

    function __construct()
    {
        $this->isActiveLog = env('ACTIVE_LOG');
    }

    public function index(){
        $kecamatans = Kecamatan::all();
        if($this->isActiveLog) $this->saveLog('Akses Dashboard Wisata');
        return view('edm.wisata.index', compact('kecamatans'));
    }

    public function detail(Request $request, $id){
        $name = $request->name;
        return view('edm.wisata.detail', compact('id', 'name'));
    }
}
