<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pasar;
use App\Models\TargetSetoran;
use App\Models\SetoranPasar;

class MasterTargetSetoranController extends Controller
{
    //
    public function index($pasar_id){
        $pasar = Pasar::find($pasar_id);
        if (empty($pasar))
            return redirect()->back()->with('error_message', 'Data tidak ditemukan');
        $targets = TargetSetoran::where('pasar_id',$pasar_id)->orderBy('tahun_anggaran', 'asc')->get();
        $setorans = SetoranPasar::leftJoin('target_setorans', 'setoran_pasars.target_setoran_id', 'target_setorans.id')
            ->select('setoran_pasars.*', 'target_setorans.tahun_anggaran', 'target_setorans.target')
            ->orderBy('setoran_pasars.tanggal_data')->get();
        return view('operator.pasar.target-setoran', compact('pasar', 'targets', 'setorans')); 
    }

    public function storetarget(Request $request, $id){
        $pasar = Pasar::find($id);
        if (empty($pasar))
        return redirect()->back()->with('error_message', 'Data tidak ditemukan');
        $target = TargetSetoran::insertNewData($pasar, $request->tahun, $request->target);
        return redirect()->back()->with('success_message', 'Berhasil menamhakan data');
    }

    public function storesetoran(Request $request, $id){
        $pasar = Pasar::find($id);
        if (empty($pasar))
            return redirect()->back()->with('error_message', 'Data tidak ditemukan');
        $target = TargetSetoran::find($request->tahun);
            if (empty($target))
                return redirect()->back()->with('error_message', 'Data tidak ditemukan');
        $target = SetoranPasar::insertNewData($pasar, $request->tahun, $request->tanggal_data, $request->setoran);
        return redirect()->back()->with('success_message', 'Berhasil menamhakan data');
    }

    public function deletesetoran($id){
        SetoranPasar::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Berhasil Menghapus Data');
    }

    public function deletetarget($id){
        TargetSetoran::deleteRelatedToId($id);
        return redirect()->back()->wit('success_message', 'Berhasil Menghapus Data');
    }
}
