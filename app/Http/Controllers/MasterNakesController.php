<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileInsertNakesRequest;
use App\Http\Requests\NakesRequest;
use Illuminate\Http\Request;
use App\Models\Fasyankes;
use App\Models\TenagaKesehatan;

use Maatwebsite\Excel\Facades\Excel;
use App\Models\FileNakes;
use App\Imports\FileNakesImport;
use App\Models\FileNakesContent;
use App\Traits\LoggingTrait;

class MasterNakesController extends Controller
{
    use LoggingTrait;
    protected $isActiveLog = false;

    function __construct()
    {
        $this->isActiveLog = env('ACTIVE_LOG');
    }

    public function index()
    {
        $fasyankeses = Fasyankes::all();
        $nakeses = TenagaKesehatan::leftJoin('fasyankes', 'tenaga_kesehatans.fasyankes_id', 'fasyankes.id')
            ->select('tenaga_kesehatans.*', 'fasyankes.nama as fasyankes')
            ->get();
            if($this->isActiveLog) $this->saveLog('Akses Tenaga Kesehatan');
        return view('operator.kesehatan-tenaga.index', compact('nakeses', 'fasyankeses'));
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
    public function store(NakesRequest $request)
    {
        //
        $nakes = TenagaKesehatan::insertNewData($request);
        if($this->isActiveLog) $this->saveLog('Add Tenaga Kesehatan with id : '.$nakes->id);
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
        $nakes = TenagaKesehatan::find($id);
        if (empty($nakes))
            return;
        $fasyankeses = Fasyankes::all();
        return ['title' => 'Edit Nakes', 'body' => view('operator.kesehatan-tenaga.form', compact('nakes', 'fasyankeses'))->render()];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NakesRequest $request, $id)
    {
        //
        $nakes = TenagaKesehatan::find($id);
        if (!empty($nakes)){
            $nakes->updateData($request);
        }
        if($this->isActiveLog) $this->saveLog('Update Tenaga Kesehatan with id : '.$id);
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
        TenagaKesehatan::deleteRelatedToId($id);
        if($this->isActiveLog) $this->saveLog('Delete Tenaga Kesehatan with id : '.$id);
        return redirect()->back()->with('success_message', 'Berhasil Menghapus Data');
    }

    public function bulkpage(){
        $files = FileNakes::all();
        return view('operator.kesehatan-tenaga.bulkpage', compact('files'));
    }

    public function bulkinsert(FileInsertNakesRequest $request){
        $file = FileNakes::upload($request->file, $request->tanggal_data);
        Excel::import(new FileNakesImport($file->id), $file->file_location);
        return redirect()->back()->with('success_message', 'Berhasil Upload File');
    }

    public function bulkvalidate($id){
        $contents = FileNakesContent::migrateNakes($id);
        return redirect()->back()->with('success_message', 'Berhasil Migrasi Data dari File ke Server');
    }
}
