<?php

namespace App\Http\Controllers;

use App\Http\Requests\PoliRequest;
use Illuminate\Http\Request;
use App\Models\KesehatanPoli;
use App\Models\PoliToFasyankes;
use App\Models\TenagaKesehatan;
use App\Traits\LoggingTrait;

class MasterKesehatanPoliController extends Controller
{
    use LoggingTrait;
    protected $isActiveLog = false;

    function __construct()
    {
        $this->isActiveLog = env('ACTIVE_LOG');
    }

    public function index()
    {
        $polis = KesehatanPoli::all();
        $polisChange = null;
        if($this->isActiveLog) $this->saveLog('Akses Poli');
        return view('operator.kesehatan-poli.index', compact('polis', 'polisChange'));
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
    public function store(PoliRequest $request)
    {
        //
        $poli = KesehatanPoli::insertNewData($request);
        if($this->isActiveLog) $this->saveLog('Add Poli with id : '.$poli->id);
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
        $poli = KesehatanPoli::find($id);
        if (empty($poli)){
            return ['title' => 'Data Tidak Ditemukan', 'body' => ''];
        }
        return ['title' => 'Edit Poli '. $poli->nama, 'body'=> view('operator.kesehatan-poli.form', compact('poli'))->render()];

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PoliRequest $request, $id)
    {
        //
        $poli = KesehatanPoli::find($id);
        if (empty($poli))
            return redirect('operator/kesehatan-poli');
        $poli->updateData($request);
        if($this->isActiveLog) $this->saveLog('Update Poli with id : '.$id);
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
        $polis = KesehatanPoli::where('id', "!=", $id)->get();
        $polisChange = KesehatanPoli::find($id);
        return ['title' => 'Delete Polis '. $polisChange->nama, 'body'=> view('operator.kesehatan-poli.delete', compact('polis', 'polisChange'))->render()];
    }


   public function delete(Request $request, $id)
    {
        $medis = TenagaKesehatan::where('kesehatan_poli_id', $id)->get();
        //return $request->all();
        foreach ($medis as $key => $data) {
            $data->kesehatan_poli_id  = $request->poli_id;
            $data->save();
        }
        KesehatanPoli::deleteRelatedToId($id);
        PoliToFasyankes::changeRelatedToPoli($id, $request->poli_id);
        if($this->isActiveLog) $this->saveLog('Delete Poli with id : '.$id);
        return redirect()->back()->with('success_message', 'Berhasil Menghapus Data');
    }
}
