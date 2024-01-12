<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileInsertMuridRequest;
use App\Http\Requests\MuridRequest;
use App\Imports\FileMuridImport;
use App\Models\FileMurid;
use App\Models\FileMuridContent;
use Illuminate\Http\Request;
use App\Models\GuruSekolah;
use App\Models\MuridSekolah;
use App\Models\Sekolah;
use App\Traits\LoggingTrait;
use Maatwebsite\Excel\Facades\Excel;

class MasterMuridController extends Controller
{
    use LoggingTrait;
    protected $isActiveLog = false;

    function __construct()
    {
        $this->isActiveLog = env('ACTIVE_LOG');
    }

    public function index()
    {
        $muris = MuridSekolah::leftJoin('sekolahs', 'murid_sekolahs.sekolah_id', 'sekolahs.id')
            ->select('murid_sekolahs.*', 'sekolahs.nama as sekolah')
            ->get();
        $sekolahs = Sekolah::all();
        if($this->isActiveLog) $this->saveLog('Akses Murid');
        return view('operator.murid.index', compact('muris', 'sekolahs'));
    }

    public function create()
    {
        //
    }

    public function store(MuridRequest $request)
    {
        $murid = MuridSekolah::insertNewData($request);
        if($this->isActiveLog) $this->saveLog('Add Murid with id : '.$murid->id);
        return redirect()->back()->with('success_message', 'Berhasil Menambahkan Data');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $murid = MuridSekolah::find($id);
        if (empty($murid))
            return;
        $sekolahs = Sekolah::all();
        return ['title' => 'Edit Murid', 'body' => view('operator.murid.form',compact('murid', 'sekolahs'))->render()];
    }

    public function update(MuridRequest $request, $id)
    {
        $murid = MuridSekolah::find($id);
        if (!empty($murid)){
            $murid->updateData($request);
        }
        if($this->isActiveLog) $this->saveLog('Update Murid with id : '.$id);
        return redirect()->back()->with('success_message', 'Berhasil Mengubah Data');
    }

    public function destroy($id)
    {
        MuridSekolah::deleteRelatedToId($id);
        if($this->isActiveLog) $this->saveLog('Delete Murid with id : '.$id);
        return redirect()->back()->with('success_message', 'Berhasil Menghapus Data');
    }

    public function bulkpage(){
        $files = FileMurid::all();
        return view('operator.murid.bulkpage', compact('files'));
    }

    public function bulkinsert(FileInsertMuridRequest $request){
        $file = FileMurid::upload($request->file, $request->tanggal_data, $request->jenjang);
        Excel::import(new FileMuridImport($file->id, $request->jenjang), $file->file_location);

        return redirect()->back()->with('success_message', 'Berhasil Upload File');
    }

    public function bulkvalidate($file_id){
        $contents = FileMuridContent::migrateMurid($file_id);
        return redirect()->back()->with('success_message', 'Berhasil Migrasi Data dari File ke Server');
    }
}
