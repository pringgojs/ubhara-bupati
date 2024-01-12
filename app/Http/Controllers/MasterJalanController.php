<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileInsertJalanRequest;
use App\Http\Requests\JalanRequest;
use Illuminate\Http\Request;
use App\Models\InfrastrukturJalan;
use App\Models\DesaToJalan;
use App\Models\Desa;
use App\Models\FileJalan;
use App\Models\FileJalanContent;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\FileJalanImport;
use App\Models\Kecamatan;
use App\Models\KecamatanToJalan;
use App\Traits\LoggingTrait;

class MasterJalanController extends Controller
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
        $jalans = InfrastrukturJalan::all();
        foreach($jalans as $jalan){
            $jalan->kecamatans = KecamatanToJalan::leftJoin('kecamatans', 'kecamatan_to_jalans.kecamatan_id','kecamatans.id')
                ->where('kecamatan_to_jalans.infrastruktur_jalan_id', $jalan->id)
                ->select('kecamatans.*')
                ->get();
        }
        $kecamatans = Kecamatan::select('kecamatans.*')->get();
        if($this->isActiveLog) $this->saveLog('Akses Jalan');
        return view('operator.infrastruktur-jalan.index', compact('jalans', 'kecamatans'));
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
    public function store(JalanRequest $request)
    {
        $jalan = InfrastrukturJalan::insertNewData($request);
        $jalan->syncKecamatan($request);
        if($this->isActiveLog) $this->saveLog('Add Jalan with id : '.$jalan->id);
        return redirect()->back()->with('success_message', 'Berhasil Menambahkan Data Jalan');
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
        $jalan = InfrastrukturJalan::find($id);
        $connectedJalan = KecamatanToJalan::leftJoin('kecamatans', 'kecamatan_to_jalans.kecamatan_id','kecamatans.id')
            ->where('kecamatan_to_jalans.infrastruktur_jalan_id', $jalan->id)
            ->select('kecamatans.*')
            ->get();

        $ids = [];
        foreach($connectedJalan as $cj){
            array_push($ids, $cj->id);
        }
        $kecamatans = Kecamatan::whereNotIn('kecamatans.id', $ids)->select('kecamatans.*')->get();

        return ['title' => 'Edit Jalan '. $jalan->nama, 'body'=> view('operator.infrastruktur-jalan.form', compact('jalan', 'connectedJalan','kecamatans'))->render()];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JalanRequest $request, $id)
    {
        //
        $jalan = InfrastrukturJalan::find($id);
        if (empty($jalan))
            return redirect()->back()->with('error_message', 'Data Tidak Ditemukan');
        $jalan->updateData($request);
        KecamatanToJalan::deleteRelatedTo('infrastruktur_jalan_id', $id);
        $jalan->syncKecamatan($request);
        if($this->isActiveLog) $this->saveLog('Update Jalan with id : '.$id);
        return redirect()->back()->with('success_message', 'Berhasil Edit Data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        InfrastrukturJalan::deleteRelatedToId($id);
        if($this->isActiveLog) $this->saveLog('Delete Jalan with id : '.$id);
        return redirect()->back()->with('success_message', 'Berhasil menghapus data');
    }

    public function bulkpage(){
        $files = FileJalan::all();
        return view('operator.infrastruktur-jalan.bulkpage', compact('files'));
    }

    public function bulkinsert(FileInsertJalanRequest $request){
        $file = FileJalan::upload($request->file, $request->tanggal_data);
        Excel::import(new FileJalanImport($file->id), $file->file_location);
        if($this->isActiveLog) $this->saveLog('Bulk Insert Jalan with id : '.$file->id);
        return redirect()->back()->with('success_message', 'Berhasil Upload File');
    }

    public function bulkvalidate($file_id){
        FileJalanContent::migrateJalan($file_id);
        if($this->isActiveLog) $this->saveLog('Bulk Validate File Jalan with id : '.$file_id);
        return redirect()->back()->with('success_message', 'Berhasil Migrasi Data dari File ke Server');
    }

    public function rollback($file_id){
        FileJalanContent::rollbackJalan($file_id);
        if($this->isActiveLog) $this->saveLog('Rollback File Jalan with id : '.$file_id);
        return redirect()->back();
    }
}
