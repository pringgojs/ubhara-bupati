<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileInsertGuruRequest;
use App\Http\Requests\GuruRequest;
use App\Imports\FileGuruImport;
use App\Models\FileGuru;
use App\Models\FileGuruContent;
use Illuminate\Http\Request;
use App\Models\GuruSekolah;
use App\Models\Sekolah;
use App\Traits\LoggingTrait;
use Maatwebsite\Excel\Facades\Excel;

class MasterGuruController extends Controller
{
    use LoggingTrait;
    protected $isActiveLog = false;

    function __construct()
    {
        $this->isActiveLog = env('ACTIVE_LOG');
    }

    public function index()
    {
        $gurus = GuruSekolah::leftJoin('sekolahs', 'guru_sekolahs.sekolah_id', 'sekolahs.id')
            ->select('guru_sekolahs.*', 'sekolahs.nama as sekolah')
            ->orderBy('guru_sekolahs.nama')
            ->get();
        $sekolahs = Sekolah::all();
        if($this->isActiveLog) $this->saveLog('Akses Guru');
        return view('operator.guru.index', compact('gurus', 'sekolahs'));
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
    public function store(GuruRequest $request)
    {
        //
        $guru = GuruSekolah::insertNewData($request);
        if($this->isActiveLog) $this->saveLog('Add Guru with id : '.$guru->id);
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
        $guru = GuruSekolah::find($id);
        if (empty($guru))
            return;
            $sekolahs = Sekolah::all();
        return ['title' => 'Edit Guru', 'body' => view('operator.guru.form',compact('guru', 'sekolahs' ))->render()];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GuruRequest $request, $id)
    {
        //
        $guru = GuruSekolah::find($id);
        if (!empty($guru)){
            $guru->updateData($request);
        }
        if($this->isActiveLog) $this->saveLog('Update Guru with id : '.$id);
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
        GuruSekolah::deleteRelatedToId($id);
        if($this->isActiveLog) $this->saveLog('Delete Guru with id : '.$id);
        return redirect()->back()->with('success_message', 'Berhasil Menghapus Data');
    }

    public function bulkpage(){
        $files = FileGuru::all();
        return view('operator.guru.bulkpage', compact('files'));
    }

    public function bulkinsert(FileInsertGuruRequest $request){
        $file = FileGuru::upload($request->file, $request->tanggal_data);
        Excel::import(new FileGuruImport($file->id), $file->file_location);

        return redirect()->back()->with('success_message', 'Berhasil Upload File');
    }

    public function bulkvalidate($file_id){
        $contents = FileGuruContent::migrateGuru($file_id);
        return redirect()->back()->with('success_message', 'Berhasil Migrasi Data dari File ke Server');
    }
}
