<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\IndikatorKinerja;
use App\Models\CapaianIndikatorKinerja;

class MasterCapaianIndikatorKinerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($indikator_id)
    {
        //
        $indikator = IndikatorKinerja::where('id', $indikator_id)->first();
        if (empty($indikator))
            return '';
        return ['title' => 'Tambah Capaian Aspek Indikator', 'body'=> view('operator.iku.capaian', compact('indikator'))->render()];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $indikator_id)
    {
        //
        $capaian = CapaianIndikatorKinerja::insertFromRequest($request, $indikator_id);
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
