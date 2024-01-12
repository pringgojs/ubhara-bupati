<?php

namespace App\Http\Controllers;

use App\Http\Requests\KomoditasLahanRequest;
use App\Http\Requests\KomoditasTaniRequest;
use Illuminate\Http\Request;
use App\Models\KomoditasLahan;
use App\Traits\LoggingTrait;

class MasterKomoditasController extends Controller
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
        $komoditases = KomoditasLahan::all();
        if($this->isActiveLog) $this->saveLog('Akses Komoditas Lahan');
        return view('operator.komoditas.index', compact('komoditases'));
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
    public function store(KomoditasLahanRequest $request)
    {
        //
        $komoditas = KomoditasLahan::insertNewData($request);
        if($this->isActiveLog) $this->saveLog('Add Komoditas Lahan with id : '.$komoditas->id);
        return redirect()->back->with('success_message', 'Berhasil Menambahkan Data');
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
        $komoditas = KomoditasLahan::find($id);
        if (empty($komoditas))
            return;
        return ['title' => 'Edit Data '.$komoditas->nama, 'body' => view('operator.komoditas.form', compact('komoditas'))->render()];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KomoditasLahanRequest $request, $id)
    {
        //
        $komoditas = KomoditasLahan::find($id);
        if(empty($komoditas))
            return redirect()->back();
        $komoditas->updateData($request);
        if($this->isActiveLog) $this->saveLog('Update Komoditas Lahan with id : '.$id);
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
        KomoditasLahan::deleteRelatedToId($id);
        if($this->isActiveLog) $this->saveLog('Delete Komoditas Lahan with id : '.$id);
        return redirect()->back()->with('success_message', 'Berhasil Menghapus Data');
    }
}
