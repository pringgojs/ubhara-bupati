<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Desa;
use App\Traits\LoggingTrait;

class DashboardDesaController extends Controller
{
    use LoggingTrait;
    protected $isActiveLog = false;

    function __construct()
    {
        $this->isActiveLog = env('ACTIVE_LOG');
    }

    public function index($id, $modul){
        $desa = Desa::find($id);
        if (empty($desa))
            return redirect('/');
            if($this->isActiveLog) $this->saveLog('Akses Dashboard Desa');
        return view('edm.desa.'.$modul, compact('desa', 'modul'));
    }
}
