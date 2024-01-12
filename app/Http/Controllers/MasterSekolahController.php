<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileInsertSekolahRequest;
use App\Http\Requests\SekolahRequest;
use App\Imports\FileSekolahImport;
use Illuminate\Http\Request;
use App\Models\JenisSekolah;
use App\Models\Sekolah;
use App\Models\Desa;
use App\Models\DesaToSekolah;
use App\Models\FileSekolah;
use App\Models\FileSekolahContent;
use App\Traits\LoggingTrait;
use Maatwebsite\Excel\Facades\Excel;

class MasterSekolahController extends Controller
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
        $desas = Desa::getDataWithKecamatan();
        $sekolahs = Sekolah::leftJoin('jenis_sekolahs', 'sekolahs.jenis_sekolah_id', 'jenis_sekolahs.id')
            ->select('sekolahs.*', 'jenis_sekolahs.nama as jenis_sekolah')
            ->get();
        foreach($sekolahs as $sekolah){
            $sekolah->desas = DesaToSekolah::leftJoin('desas', 'desa_to_sekolahs.desa_id', 'desas.id')
                ->leftJoin('kecamatans', 'desas.kecamatan_id', 'kecamatans.id')
                ->where('desa_to_sekolahs.sekolah_id', $sekolah->id)
                ->select('desas.*', 'kecamatans.name as kecamatan')
                ->get();
        }
        $jenisSekolahs = JenisSekolah::all();
        if($this->isActiveLog) $this->saveLog('Akses Sekolah');
        return view('operator.sekolah.index', compact('desas', 'sekolahs', 'jenisSekolahs'));
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
    public function store(SekolahRequest $request)
    {
        //
        $sekolah = Sekolah::insertNewData($request);
        if ($sekolah)
            $sekolah->syncDesa($request);
            if($this->isActiveLog) $this->saveLog('Add Sekolah with id : '.$sekolah->id);
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
        $sekolah = Sekolah::find($id);
        if (empty($sekolah))
            return;
        $connectedSekolah = DesaToSekolah::leftJoin('desas', 'desa_to_sekolahs.desa_id', 'desas.id')
            ->leftJoin('kecamatans', 'desas.kecamatan_id', 'kecamatans.id')
            ->where('desa_to_sekolahs.sekolah_id', $sekolah->id)
            ->select('desas.*', 'kecamatans.name as kecamatan')->get();
        $ids = [];
        foreach($connectedSekolah as $cj){
            array_push($ids, $cj->id);
        }
        $desas = Desa::leftJoin('kecamatans', 'desas.kecamatan_id', 'kecamatans.id')
            ->whereNotIn('desas.id', $ids)
            ->select('desas.*', 'kecamatans.name as kecamatan')
            ->get();
        $jenisSekolahs = JenisSekolah::all();
        return ['title' => 'Edit Sekolah '. $sekolah->nama, 'body'=> view('operator.sekolah.form', compact('sekolah', 'connectedSekolah','desas', 'jenisSekolahs'))->render()];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SekolahRequest $request, $id)
    {
        //
        $sekolah = Sekolah::find($id);
        if (empty($sekolah))
            return redirect()->back();
        $sekolah->updateData($request);
        DesaToSekolah::deleteRelatedTo('sekolah_id', $id);
        $sekolah->syncDesa($request);
        if($this->isActiveLog) $this->saveLog('Update Sekolah with id : '.$id);
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
        Sekolah::deleteRelatedToId($id);
        if($this->isActiveLog) $this->saveLog('Delete Sekolah with id : '.$id);
        return redirect()->back()->with('success_message', 'Berhasil Menghapus Data');
    }

    public function bulkpage(){
        $files = FileSekolah::all();
        return view('operator.sekolah.bulkpage', compact('files'));
    }

    public function bulkinsert(FileInsertSekolahRequest $request){
        $file = FileSekolah::upload($request->file, $request->tanggal_data);
        Excel::import(new FileSekolahImport($file->id), $file->file_location);

        return redirect()->back()->with('success_message', 'Berhasil Upload File');
    }

    public function bulkvalidate($file_id){
        $contents = FileSekolahContent::migrateSekolah($file_id);
        return redirect()->back()->with('success_message', 'Berhasil Migrasi Data dari File ke Server');
    }
}
