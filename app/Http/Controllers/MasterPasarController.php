<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasarRequest;
use Illuminate\Http\Request;
use App\Models\JenisPasar;
use App\Models\Desa;
use App\Models\Pasar;
use App\Traits\LoggingTrait;
use App\Models\TargetSetoran;

class MasterPasarController extends Controller
{
    use LoggingTrait;
    protected $isActiveLog = false;

    function __construct()
    {
        $this->isActiveLog = env('ACTIVE_LOG');
    }

    public function index()
    {
        $jenis_pasars = JenisPasar::all();
        $desas = Desa::getDataWithKecamatan();
        $pasars = Pasar::leftJoin('desas','pasars.desa_id','desas.id')
            ->leftJoin('jenis_pasars', 'pasars.jenis_pasar_id', 'jenis_pasars.id')
            ->leftJoin('kecamatans', 'desas.kecamatan_id', 'kecamatans.id')
            ->select('pasars.*', 'desas.name as desa', 'kecamatans.name as kecamatan', 'jenis_pasars.nama as jenis_pasar')
            ->orderBy('pasars.nama', 'asc')
            ->get();
   
        if($this->isActiveLog) $this->saveLog('Akses Pasar');
        
        return view('operator.pasar.index', compact('jenis_pasars', 'desas', 'pasars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PasarRequest $request)
    {
        //
        if (empty(JenisPasar::find($request->jenis_pasar_id)))
            return redirect()->back();
            
        if (empty(Desa::find($request->desa_id)))
            return redirect()->back();

        $pasar = Pasar::insertNewData($request);
        $target = TargetSetoran::insertNewData($pasar, $request->tahun, $request->target_setoran);
        if($this->isActiveLog) $this->saveLog('Add Pasar with id : '.$pasar->id);
        return redirect()->back()->with('success_message', 'Berhasil Menambahkan Data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $pasar = Pasar::find($id);
        if (empty($pasar))
            return "";
        $jenis_pasars = JenisPasar::all();
        $desas = Desa::getDataWithKecamatan();
        return ['title' => 'Edit Pasar '. $pasar->nama, 'body'=> view('operator.pasar.form', compact('pasar', 'jenis_pasars', 'desas'))->render()];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PasarRequest $request, $id)
    {
        //
        $pasar = Pasar::find($id);
        if (empty($pasar))
            return redirect()->back();

        if (empty(JenisPasar::find($request->jenis_pasar_id)))
            return redirect()->back();
            
        if (empty(Desa::find($request->desa_id)))
            return redirect()->back();
        $pasar->updateData($request);
        if($this->isActiveLog) $this->saveLog('Update Pasar with id : '.$id);
        return redirect()->back()->with('success_message', 'Berhasil Mengubah Data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Pasar::deleteRelatedToId($id);
        if($this->isActiveLog) $this->saveLog('Delete Pasar with id : '.$id);
        return redirect()->back()->with('success_message', 'Berhasil Menghapus Data');
    }
}
