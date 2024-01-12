<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileInsertKelompokTaniRequest;
use App\Http\Requests\KelompokTaniRequest;
use App\Imports\FileKelompokTaniImport;
use Illuminate\Http\Request;
use App\Models\KelompokMasyarakatTani;
use App\Models\Desa;
use App\Models\FileKelompokTani;
use App\Models\FileKelompokTaniContent;
use App\Traits\LoggingTrait;
use Maatwebsite\Excel\Facades\Excel;

class MasterPokmasController extends Controller
{
	use LoggingTrait;
    protected $isActiveLog = false;

    function __construct()
    {
        $this->isActiveLog = env('ACTIVE_LOG');
    }

	public function index()
	{
		$kmts = KelompokMasyarakatTani::leftJoin('desas','kelompok_masyarakat_tanis.desa_id', 'desas.id')
		->leftJoin('kecamatans', 'desas.kecamatan_id', 'kecamatans.id')
		->select('kelompok_masyarakat_tanis.*', 'desas.name as desa', 'kecamatans.name as kecamatan')
		->get();
		$desas = Desa::getDataWithKecamatan();
		if($this->isActiveLog) $this->saveLog('Akses Kelompok Tani');
		return view('operator.kelompok-masyarakat-tani.index', compact('kmts', 'desas'));
	}
	
	public function create()
	{
		//
	}
	
	
	public function store(KelompokTaniRequest $request)
	{
		$kmt = KelompokMasyarakatTani::insertNewData($request);
		if($this->isActiveLog) $this->saveLog('Add Kelompok Tani with id : '.$kmt->id);
		return redirect()->back()->with('success_message', 'Berhasil Menambahkan Data');
	}
	
	
	public function show($id)
	{
		
	}
	
	public function edit($id)
	{
		$kmt = KelompokMasyarakatTani::find($id);
		if (empty($kmt))
		return;
		$desas = Desa::getDataWithKecamatan();
		return ['title' => 'Edit Kelompok Masyarakat Tani '. $kmt->nama, 'body'=> view('operator.kelompok-masyarakat-tani.form', compact('kmt', 'desas'))->render()];
	}
	
	public function update(KelompokTaniRequest $request, $id)
	{
		$kmt = KelompokMasyarakatTani::find($id);
		if (empty($kmt))
		return redirect()->back();
		$kmt->updateData($request);
		if($this->isActiveLog) $this->saveLog('Update Kelompok Tani with id : '.$id);
		return redirect()->back()->with('success_message', 'Berhasil Mengubah Data');
	}
	
	public function destroy($id)
	{
		KelompokMasyarakatTani::deleteRelatedToId($id);
		if($this->isActiveLog) $this->saveLog('Delete Kelompok Tani with id : '.$id);
		return redirect()->back()->with('success_message', 'Berhasil Menghapus Data');
	}
	
	public function bulkpage(){
		$desas = Desa::getDataWithKecamatan();
		$files = FileKelompokTani::all();
		return view('operator.kelompok-masyarakat-tani.bulkpage', compact('files', 'desas'));
	}
	
	public function bulkinsert(FileInsertKelompokTaniRequest $request){
		$desa = Desa::find($request->desa_id);
		if (empty($desa))
			return redirect()->back();
		$file = FileKelompokTani::upload($request->file, $request->tanggal_data, $request->desa_id);
		Excel::import(new FileKelompokTaniImport($file->id), $file->file_location);
		
		return redirect()->back()->with('success_message', 'Berhasil Upload File');
	}
	
	public function bulkvalidate($file_id){
		FileKelompokTaniContent::migrateKelompok($file_id);
		return redirect()->back()->with('success_message', 'Berhasil Migrasi Data dari File ke Server');
	}
	
}
