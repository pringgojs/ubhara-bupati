<?php

namespace App\Http\Controllers;

use App\Imports\FileMuridImport;
use App\Models\FileMurid;
use App\Models\FileMuridContent;
use Illuminate\Http\Request;
use App\Models\GuruSekolah;
use App\Models\Logging;
use App\Models\MuridSekolah;
use App\Models\Sekolah;
use Maatwebsite\Excel\Facades\Excel;

class MasterLoggingController extends Controller
{
    public function index()
    {
        $loggings = Logging::all();
        return view('operator.logging.index', compact('loggings'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $murid = Logging::insertNewData($request);
        return redirect()->back()->with('success_message', 'Berhasil Menambahkan Data');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $murid = Logging::find($id);
        if (empty($murid))
            return;
        return ['title' => 'Edit Murid', 'body' => view('operator.murid.form',compact('murid'))->render()];
    }

    public function update(Request $request, $id)
    {
        $murid = Logging::find($id);
        if (!empty($murid)){
            $murid->updateData($request);
        }
        return redirect()->back()->with('success_message', 'Berhasil Mengubah Data');
    }

    public function destroy($id)
    {
        Logging::deleteRelatedToId($id);
        return redirect()->back()->with('success_message', 'Berhasil Menghapus Data');
    }
}
