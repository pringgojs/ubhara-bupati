<?php

namespace App\Http\Controllers;

use App\Http\Requests\KecamatanRequest;
use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Traits\LoggingTrait;

class MasterKecamatanController extends Controller
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
        if($this->isActiveLog) $this->saveLog('Akses Kecamatan');
        return view('operator.kecamatan.index', compact('kecamatans'));
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
    public function store(KecamatanRequest $request)
    {
        $kecamatanBaru = Kecamatan::insertNewData($request);
        if (isset($request->foto))
            $kecamatanBaru->uploadFoto($request->foto);
            if($this->isActiveLog) $this->saveLog('Add Kecamatan with id : '.$kecamatanBaru->id);
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
        $kecamatan = Kecamatan::find($id);
        return ['title' => 'Edit Kecamatan '. $kecamatan->name, 'body'=> view('operator.kecamatan.form', compact('kecamatan'))->render()];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KecamatanRequest $request, $id)
    {
        //
        $kecamatan = Kecamatan::find($id);
        if (!empty($kecamatan))
            $kecamatan = $kecamatan->updateData($request);
            if($this->isActiveLog) $this->saveLog('Update Kecamatan with id : '.$id);
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
        $desaCount = Desa::where('kecamatan_id', $id)->count();
        if($desaCount == 0)
            Kecamatan::where('id', $id)->delete();
        if($this->isActiveLog) $this->saveLog('Delete Kecamatan with id : '.$id);
        return redirect()->back()->with('success_message', 'Berhasil Menghapus Data');
    }
}
