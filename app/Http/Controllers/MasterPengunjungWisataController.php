<?php

namespace App\Http\Controllers;

use App\Http\Requests\PengunjungWisataRequest;
use Illuminate\Http\Request;
use App\Models\KunjunganWisata;
use App\Models\PengunjungWisata;
use App\Models\TempatWisata;
use App\Traits\LoggingTrait;

class MasterPengunjungWisataController extends Controller
{

    use LoggingTrait;
    protected $isActiveLog = false;

    function __construct()
    {
        $this->isActiveLog = env('ACTIVE_LOG');
    }

    public function index()
    {
        $pengunjungs = PengunjungWisata::all();
        $wisatas = TempatWisata::all();
        if($this->isActiveLog) $this->saveLog('Akses Pengunjung Wisata');
        return view('operator.pengunjung-wisata.index', compact('pengunjungs', 'wisatas'));
    }

    public function store(PengunjungWisataRequest $request)
    {
        $data = PengunjungWisata::insertNewData($request);
        if($this->isActiveLog) $this->saveLog('Add Pengunjung Wisata with id : '.$data->id);
        return redirect()->back()->with('success_message', 'Berhasil Menambahkan Data');
    }

    public function edit($id)
    {
        $pengunjung = PengunjungWisata::find($id);
        $wisatas = TempatWisata::where('id', "!=", $pengunjung->tempat_wisata_id)->get();
        if (empty($pengunjung)){
            return ['title' => 'Data Tidak Ditemukan', 'body' => ''];
        }
        return ['title' => 'Edit Kunjungan '. "Wisata", 'body'=> view('operator.pengunjung-wisata.form', compact('wisatas', 'pengunjung'))->render()];
    }

    public function update(PengunjungWisataRequest $request, $id)
    {
        $pengunjung = PengunjungWisata::find($id);
        if (empty($pengunjung))
            return redirect('operator/pengunjung-wisata');
        $pengunjung->updateData($request);
        if($this->isActiveLog) $this->saveLog('Update Pengunjung Wisata with id : '.$id);
        return redirect()->back()->with('success_message', 'Berhasil Mengubah Data');
    }

    public function destroy($id)
    {
        PengunjungWisata::deleteRelatedToId($id);
        if($this->isActiveLog) $this->saveLog('Delete Pengunjung Wisata with id : '.$id);
        return redirect()->back()->with('success_message', 'Berhasil Menghapus Data');
    }
}
