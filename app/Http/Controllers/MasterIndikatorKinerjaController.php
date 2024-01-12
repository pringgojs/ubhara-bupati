<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\IndikatorKinerja;
use App\Models\IndikatorKinerjaGroup;

use App\Models\CapaianIndikatorKinerja;

class MasterIndikatorKinerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas = IndikatorKinerja::leftJoin('indikator_kinerja_groups', 'indikator_kinerjas.indikator_kinerja_group_id', 'indikator_kinerja_groups.id')
            ->select('indikator_kinerja_groups.nama as group', 'indikator_kinerjas.*')
            ->get();
        $tahuns = CapaianIndikatorKinerja::select('tahun')->distinct()->get();
        $values = [];
        foreach($datas as $data){
            $tahunCapaian = [];
            foreach($tahuns as $tahun){
                $capaian = CapaianIndikatorKinerja::where(['tahun' => $tahun->tahun, 'indikator_kinerja_id' => $data['id']])->first();
                if (empty($capaian))
                    array_push($tahunCapaian, ['target'=> '', 'capaian' => '', 'satuan' => '']);
                else 
                    array_push($tahunCapaian, ['target'=> $capaian->target, 'capaian' => $capaian->capaian, 'satuan' => $capaian->satuan]);
            }
            $value = [
                'group' => $data->group,
                'id' => $data->id,
                'aspek' => $data->aspek,
                'skpd' => $data->skpd,
                'sumber' => $data->sumber,
                'keterangan' => $data->keterangan,
                'capaian' => $tahunCapaian
            ] ;
            array_push($values, $value);
        }
        return view('operator.iku.index', compact('tahuns', 'values'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $indikators = IndikatorKinerjaGroup::all();
        return ['title' => 'Tambah Indikator Kinerja Utama', 'body'=> view('operator.iku.form', compact('indikators'))->render()];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $ik = IndikatorKinerja::insertFromRequest($request);
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }
}
