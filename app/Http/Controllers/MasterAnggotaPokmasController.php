<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KelompokMasyarakatTani;
use App\Models\AnggotaKelompokMasyarakatTani;
use App\Traits\LoggingTrait;

class MasterAnggotaPokmasController extends Controller
{
    use LoggingTrait;
    protected $isActiveLog = false;

    function __construct()
    {
        $this->isActiveLog = env('ACTIVE_LOG');
    }

    public function index($id_pokmas)
    {
        $kmt = KelompokMasyarakatTani::find($id_pokmas);
        if (empty($kmt))
            return redirect()->back();
        $anggotas = AnggotaKelompokMasyarakatTani::where('kmt_id', $id_pokmas)->get();
        if($this->isActiveLog) $this->saveLog('Akses Anggota Kelompok Masyarakat Tani');
        return view('operator.anggota-kelompok-masyarakat-tani.index', compact('kmt', 'anggotas'));
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
    public function store(Request $request, $id_pokmas)
    {
        //
        $kmt = KelompokMasyarakatTani::find($id_pokmas);
        if (empty($kmt))
            return redirect('/operator/masyarakat-kelompok-tani');
        $a_kmt = AnggotaKelompokMasyarakatTani::insertNewData($request, $id_pokmas);
        if($this->isActiveLog) $this->saveLog('Add Anggota Kelompok Masyarakat Tani with id : '.$a_kmt->id);
        return redirect()->back()->with('success_message', 'Berhasil Menambahkan Data ');
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
    public function edit($id_pokmas, $id)
    {
        $kmt = KelompokMasyarakatTani::find($id_pokmas);
        $anggota = AnggotaKelompokMasyarakatTani::find($id);
        return ['title' => 'Edit Anggota '. $anggota->nama, 'body'=> view('operator.anggota-kelompok-masyarakat-tani.form', compact('anggota', 'kmt'))->render()];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_pokmas, $id)
    {
        $anggota = AnggotaKelompokMasyarakatTani::find($id);
        if (!empty($anggota)){
            $anggota->updateData($request);
        }
        if($this->isActiveLog) $this->saveLog('Update Anggota Kelompok Masyarakat Tani with id : '.$id);
        return redirect()->back()->with('success_message', 'Berhasil Mengubah Data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_pokmas, $id)
    {
        AnggotaKelompokMasyarakatTani::deleteRelatedToId($id);
        if($this->isActiveLog) $this->saveLog('Delete Anggota Kelompok Masyarakat Tani with id : '.$id);
        return redirect()->back()->with('success_message', 'Berhasil Menghapus Data');
    }
}
