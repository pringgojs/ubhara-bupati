<?php

namespace App\Http\Controllers;

use App\Http\Requests\KomoditasPasarRequest;
use Illuminate\Http\Request;
use App\Models\KomoditasPasar;
use App\Traits\LoggingTrait;

class MasterKomoditasPasarController extends Controller
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
        $komoditases = KomoditasPasar::all();
        if($this->isActiveLog) $this->saveLog('Akses Komoditas Pasar');
        return view('operator.komoditas-pasar.index', compact('komoditases'));
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
    public function store(KomoditasPasarRequest $request)
    {
        //
        $komoditas = KomoditasPasar::insertNewData($request);
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
        $komoditas = KomoditasPasar::find($id);
        if (empty($komoditas))
            return;
        return ['title' => 'Edit Data '.$komoditas->nama, 'body' => view('operator.komoditas-pasar.form', compact('komoditas'))->render()];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KomoditasPasarRequest $request, $id)
    {
        //
        $komoditas = KomoditasPasar::find($id);
        if(empty($komoditas))
            return redirect()->back();
        $komoditas->updateData($request);
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
        KomoditasPasar::deleteRelatedToId($id);
        return redirect()->back()->with('success_message', 'Berhasil Menghapus Data');
    }
}
