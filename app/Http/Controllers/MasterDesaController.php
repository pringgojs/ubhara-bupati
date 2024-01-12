<?php

namespace App\Http\Controllers;

use App\Http\Requests\DesaRequest;
use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Traits\LoggingTrait;

class MasterDesaController extends Controller
{
    use LoggingTrait;
    protected $isActiveLog = false;

    function __construct()
    {
        $this->isActiveLog = env('ACTIVE_LOG');
    }

    public function index()
    {
        //
        $kecamatans = Kecamatan::all();
        $desas = Desa::leftJoin('kecamatans', 'desas.kecamatan_id', 'kecamatans.id')
            ->orderBy('desas.name')
            ->select('desas.*', 'kecamatans.name as kecamatan')
            ->get();
        if($this->isActiveLog) $this->saveLog('Akses Desa');
        return view('operator.desa.index', compact('kecamatans', 'desas'));
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
    public function store(DesaRequest $request)
    {
        $desaBaru = Desa::insertNewData($request);
        if (isset($request->foto))
            $desaBaru->uploadFoto($request->foto);
        if($this->isActiveLog) $this->saveLog('Add Desa with id : '.$desaBaru->id);
        return redirect()->back()->with('success_message', 'Berhasil Menambah Data');
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
        $desa = Desa::find($id);
        if (empty($desa))
            return ['title' => 'Tidak Ditemukan', 'body'=> 'Tidak Ditemukan'];
        $kecamatans = Kecamatan::all();
        return ['title' => 'Edit Desa '. $desa->name, 'body'=> view('operator.desa.form', compact('desa', 'kecamatans'))->render()];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DesaRequest $request, $id)
    {
        //
        $desa = Desa::find($id);
        if (!empty($desa))
            $desa = $desa->updateData($request);
            if($this->isActiveLog) $this->saveLog('Update Desa with id : '.$id);
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
        Desa::where('id', $id)->delete();
        if($this->isActiveLog) $this->saveLog('Add Desa with id : '.$id);
        return redirect()->back()->with('success_message', 'Berhasil Menghapus Data');
    }
}
