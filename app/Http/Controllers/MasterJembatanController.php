<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileInsertJembatanRequest;
use App\Http\Requests\JembatanRequest;
use Illuminate\Http\Request;
use App\Models\InfrastrukturJembatan;
use App\Models\DesaToJembatan;
use App\Models\FileJembatan;
use App\Models\Desa;

use App\Models\FileJembatanContent;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\FileJembatanImport;
use App\Models\Kecamatan;
use App\Models\KecamatanToJembatan;
use App\Traits\LoggingTrait;

class MasterJembatanController extends Controller
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
        $jembatans = InfrastrukturJembatan::all();
        foreach($jembatans as $jembatan){
            $jembatan->kecamatans = KecamatanToJembatan::leftJoin('kecamatans', 'kecamatan_to_jembatans.kecamatan_id','kecamatans.id')
                ->where('kecamatan_to_jembatans.infrastruktur_jembatan_id', $jembatan->id)
                ->select('kecamatans.*')
                ->get();
        }
        $kecamatans = Kecamatan::select('kecamatans.*')->get();
        if($this->isActiveLog) $this->saveLog('Akses Jembatan');
        return view('operator.infrastruktur-jembatan.index', compact('jembatans', 'kecamatans'));
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
    public function store(JembatanRequest $request)
    {
        //
        $jembatan = InfrastrukturJembatan::insertNewData($request);
        $jembatan->syncKecamatan($request);
        if($this->isActiveLog) $this->saveLog('Add Jembatan with id : '.$jembatan->id);
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
        $jembatan = InfrastrukturJembatan::find($id);
        $connectedJembatan = KecamatanToJembatan::leftJoin('kecamatans', 'kecamatan_to_jembatans.kecamatan_id','kecamatans.id')
            ->where('kecamatan_to_jembatans.infrastruktur_jembatan_id', $id)
            ->select('kecamatans.*')
            ->get();
        $ids = [];
        foreach($connectedJembatan as $cj){
            array_push($ids, $cj->id);
        }
        $kecamatans = Kecamatan::whereNotIn('kecamatans.id', $ids)->select('kecamatans.*')->get();

        return ['title' => 'Edit Jembatan '. $jembatan->nama, 'body'=> view('operator.infrastruktur-jembatan.form', compact('jembatan', 'connectedJembatan','kecamatans'))->render()];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JembatanRequest $request, $id)
    {
        //
        $jembatan = InfrastrukturJembatan::find($id);
        if (empty($jembatan))
            return redirect()->back();
        $jembatan->updateData($request);
        KecamatanToJembatan::deleteRelatedTo('infrastruktur_jembatan_id', $id);
        $jembatan->syncKecamatan($request);
        if($this->isActiveLog) $this->saveLog('Update Jembatan with id : '.$id);
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
        InfrastrukturJembatan::deleteRelatedToId($id);
        if($this->isActiveLog) $this->saveLog('Delete Jembatan with id : '.$id);
        return redirect()->back()->with('success_message', 'Berhasil Menghapus Data');
    }

    public function bulkpage(){
        $files = FileJembatan::all();
        return view('operator.infrastruktur-jembatan.bulkpage', compact('files'));
    }

    public function bulkinsert(FileInsertJembatanRequest $request){
        $file = FileJembatan::upload($request->file, $request->tanggal_data);
        Excel::import(new FileJembatanImport($file->id), $file->file_location);
        if($this->isActiveLog) $this->saveLog('Bulk Insert Jembatan with id : '.$file->id);
        return redirect()->back()->with('success_message', 'Berhasil Upload File');
    }

    public function bulkvalidate($file_id){
        FileJembatanContent::migrateJembatan($file_id);
        if($this->isActiveLog) $this->saveLog('Bulk Validate File Jembatan with id : '.$file_id);
        return redirect()->back()->with('success_message', 'Berhasil Migrasi Data dari File ke Server');
    }

    public function rollback($file_id){
        FileJembatanContent::rollbackJembatan($file_id);
        if($this->isActiveLog) $this->saveLog('Rollback File Jembatan with id : '.$file_id);
        return redirect()->back();
    }
}
