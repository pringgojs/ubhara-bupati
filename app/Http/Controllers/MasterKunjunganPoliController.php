<?php

namespace App\Http\Controllers;

use App\Http\Requests\KunjunganPoliRequest;
use Illuminate\Http\Request;
use App\Models\KesehatanPoli;
use App\Models\KunjunganPoli;
use App\Traits\LoggingTrait;

class MasterKunjunganPoliController extends Controller
{
    use LoggingTrait;
    protected $isActiveLog = false;

    function __construct()
    {
        $this->isActiveLog = env('ACTIVE_LOG');
    }

    public function index()
    {
        $kunjungans = KunjunganPoli::all();
        $polis = KesehatanPoli::all();
        if($this->isActiveLog) $this->saveLog('Akses Kunjungan Poli');
        return view('operator.kunjungan-poli.index', compact('kunjungans', 'polis'));
    }

    public function store(KunjunganPoliRequest $request)
    {
        $data = KunjunganPoli::insertNewData($request);
        if($this->isActiveLog) $this->saveLog('Add Kunjungan Poli with id : '.$data->id);
        return redirect()->back()->with('success_message', 'Berhasil Menambahkan Data');
    }

    public function edit($id)
    {
        $kunjungan = KunjunganPoli::find($id);
        $polis = KesehatanPoli::where('id', "!=", $kunjungan->kesehatan_poli_id)->get();
        if (empty($kunjungan)){
            return ['title' => 'Data Tidak Ditemukan', 'body' => ''];
        }
        return ['title' => 'Edit Kunjungan '. "Poli", 'body'=> view('operator.kunjungan-poli.form', compact('polis', 'kunjungan'))->render()];
    }

    public function update(KunjunganPoliRequest $request, $id)
    {
        $kunjungan = KunjunganPoli::find($id);
        if (empty($kunjungan))
            return redirect('operator/kunjungan-poli');
        $kunjungan->updateData($request);
        if($this->isActiveLog) $this->saveLog('Update Kunjungan Poli with id : '.$id);
        return redirect()->back()->with('success_message', 'Berhasil Mengubah Data');
    }


    public function destroy($id)
    {
        KunjunganPoli::deleteRelatedToId($id);
        if($this->isActiveLog) $this->saveLog('Delete Kunjungan Poli with id : '.$id);
        return redirect()->back()->with('success_message', 'Berhasil Menghapus Data');
    }
}
