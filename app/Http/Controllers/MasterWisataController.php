<?php

namespace App\Http\Controllers;

use App\Http\Requests\WisataRequest;
use App\Imports\FileWisataImport;
use Illuminate\Http\Request;
use App\Models\Desa;
use App\Models\DesaToWisata;
use App\Models\FileWisata;
use App\Models\FileWisataContent;
use App\Models\TempatWisata as Wisata;
use App\Traits\LoggingTrait;
use Maatwebsite\Excel\Facades\Excel;

class MasterWisataController extends Controller
{
    use LoggingTrait;
    protected $isActiveLog = false;

    function __construct()
    {
        $this->isActiveLog = env('ACTIVE_LOG');
    }

    public function index()
    {
        $wisatas = Wisata::orderBy('id', 'desc')->get();
        $desas = Desa::getDataWithKecamatan();
        foreach($wisatas as $wisata){
            $wisata->desas = DesaToWisata::leftJoin('desas', 'desa_to_wisatas.desa_id', 'desas.id')
                ->leftJoin('kecamatans', 'desas.kecamatan_id', 'kecamatans.id')
                ->where('desa_to_wisatas.tempat_wisata_id', $wisata->id)
                ->select('desas.*', 'kecamatans.name as kecamatan')
                ->get();
        }
        $wisataSelected = null;
        if($this->isActiveLog) $this->saveLog('Akses Wisata');
        return view('operator.wisata.index', compact('wisatas', 'desas', 'wisataSelected'));
    }

    public function create()
    {
        //
    }

    public function store(WisataRequest $request)
    {
        //
        $wisata = Wisata::insertNewData($request);
        $wisata->syncDesa($request);
        if($this->isActiveLog) $this->saveLog('Add Wisata with id : '.$wisata->id);
        return redirect()->back()->with('success_message', 'Berhasil Menambahkan Data');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $wisataSelected = Wisata::find($id);
        $connectedWisata = DesaToWisata::leftJoin('desas', 'desa_to_wisatas.desa_id', 'desas.id')
            ->leftJoin('kecamatans', 'desas.kecamatan_id', 'kecamatans.id')
            ->where('desa_to_wisatas.tempat_wisata_id', $wisataSelected->id)
            ->select('desas.*', 'kecamatans.name as kecamatan')->get();
        $ids = [];
        foreach($connectedWisata as $cj){
            array_push($ids, $cj->id);
        }
        $desas = Desa::leftJoin('kecamatans', 'desas.kecamatan_id', 'kecamatans.id')
        ->whereNotIn('desas.id', $ids)
        ->select('desas.*', 'kecamatans.name as kecamatan')
        ->get();
        return ['title' => 'Edit Wisata '. $wisataSelected->nama, 'body'=> view('operator.wisata.form', compact('wisataSelected', 'connectedWisata','desas'))->render()];
    }

    public function update(Request $request, $id)
    {
        $wisata = Wisata::find($id);
        if (empty($wisata))
            return redirect()->back();
        $wisata->updateData($request);
        DesaToWisata::deleteRelatedTo('tempat_wisata_id', $id);
        $wisata->syncDesa($request);
        if($this->isActiveLog) $this->saveLog('Update Wisata with id : '.$id);
        return redirect()->back()->with('success_message', 'Berhasil Mengubah Data');
    }

    public function destroy($id)
    {
        Wisata::deleteRelatedToId($id);
        if($this->isActiveLog) $this->saveLog('Delete Wisata with id : '.$id);
        return redirect()->back()->with('success_message', 'Berhasil Menghapus Data');
    }

    public function bulkpage(){
        $files = FileWisata::all();
        return view('operator.wisata.bulkpage', compact('files'));
    }

    public function bulkinsert(Request $request){
        $file = FileWisata::upload($request->file, $request->tanggal_data);
        Excel::import(new FileWisataImport($file->id), $file->file_location);
        return redirect()->back()->with('success_message', 'Berhasil Upload File');
    }

    public function bulkvalidate($file_id){
        $contents = FileWisataContent::migrateJembatan($file_id);
        return redirect()->back()->with('success_message', 'Berhasil Migrasi Data dari File ke Server');
    }
}
