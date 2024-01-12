<?php

namespace App\Http\Controllers;

use App\Http\Requests\FasyankesRequest;
use Illuminate\Http\Request;
use App\Models\Fasyankes;
use App\Models\Desa;
use App\Models\JenisFasyankes;
use App\Models\KesehatanPoli;
use App\Models\PoliToFasyankes;
use App\Models\TenagaKesehatan;
use App\Traits\LoggingTrait;

class MasterFasyankesController extends Controller
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
        $fasyankeses = Fasyankes::all();
        $desas = Desa::getDataWithKecamatan();
        $jenises = JenisFasyankes::all();
        $polis = KesehatanPoli::all();
        foreach($fasyankeses as $fasyankes){
            $fasyankes->kesehatan_polis = PoliToFasyankes::leftJoin('kesehatan_polis', 'poli_to_fasyankes.kesehatan_poli_id', 'kesehatan_polis.id')
                ->where('poli_to_fasyankes.fasyankes_id', $fasyankes->id)
                ->select('kesehatan_polis.nama')
                ->get();
        }
        $fasyankesChange = null;
        if($this->isActiveLog) $this->saveLog('Akses Fasyankes');
        return view('operator.kesehatan-fasyankes.index', compact('fasyankeses', 'jenises', 'desas', 'polis', 'fasyankesChange'));
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
    public function store(FasyankesRequest $request)
    {
        //
        $fasyankes = Fasyankes::insertNewData($request);
        $fasyankes->syncPoli($request);
        if($this->isActiveLog) $this->saveLog('Add Fasyankes with id : '.$fasyankes->id);
        return redirect()->back()->with('success_message', 'Berhasil Menambah Data');
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
        $fasyankes = Fasyankes::find($id);
        if (empty($fasyankes))
            return;
        $desas = Desa::getDataWithKecamatan();
        $jenises = JenisFasyankes::all();
        $selectedPolis = PoliToFasyankes::leftJoin('kesehatan_polis', 'poli_to_fasyankes.kesehatan_poli_id', 'kesehatan_polis.id')
            ->where('poli_to_fasyankes.fasyankes_id', $id)
            ->select('kesehatan_polis.id', 'kesehatan_polis.nama')
            ->get();
        $selectedPoliArray = [];
        foreach($selectedPolis as $sp){
            array_push($selectedPoliArray, $sp->id);
        }
        $polis = KesehatanPoli::whereNotIn('id', $selectedPoliArray)->get();
        return ['title' => 'Edit Fasyankes '. $fasyankes->nama, 'body'=> view('operator.kesehatan-fasyankes.form', compact('fasyankes', 'jenises', 'desas', 'selectedPolis', 'polis'))->render()];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FasyankesRequest $request, $id)
    {
        //
        $fasyankes = Fasyankes::find($id);
        if (empty($fasyankes))
            return redirect()->back();
        $fasyankes->updateData($request);
        PoliToFasyankes::deleteRelatedTo('fasyankes_id', $id);
        $fasyankes->syncPoli($request);
        if($this->isActiveLog) $this->saveLog('Update Fasyanktes with id : '.$id);
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
        $fasyankes = Fasyankes::where('id', "!=", $id)->get();
        $fasyankesChange = Fasyankes::find($id);
        return ['title' => 'Delete Fasyankes '. $fasyankesChange->nama, 'body'=> view('operator.kesehatan-fasyankes.delete', compact('fasyankes', 'fasyankesChange'))->render()];
    }

    public function delete(Request $request, $id)
    {
        $medis = TenagaKesehatan::where('fasyankes_id', $id)->get();
        foreach ($medis as $key => $data) {
            $data->fasyankes_id = $request->fasyankes_id;
            $data->save();
        }
        Fasyankes::deleteRelatedToId($id);
        if($this->isActiveLog) $this->saveLog('Delete Fasyankes with id : '.$id);
        return redirect()->back()->with('success_message', 'Berhasil Menghapus Data');
    }
}
