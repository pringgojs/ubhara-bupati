<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IndikatorKinerja;
use App\Models\CapaianIndikatorKinerja;
use App\Models\SidalevRealisasi;

class DashboardRencAngController extends Controller
{
    //

    public function iku(){
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
        return view('edm.renc-ang.iku', compact('tahuns', 'values'));
    }
    
    public function anggaran(){
        $urusans = SidalevRealisasi::select('urusan_nama', 'urusan_id')->distinct()->get();
        return view('edm.renc-ang.ang', compact('urusans'));
    }

    public function urusan($urusan_id){
        $bidangs = SidalevRealisasi::where('urusan_id', $urusan_id)->select('bidang_nama', 'bidang_id')->distinct()->get();
        return view('edm.renc-ang.urusan', compact('urusan_id', 'bidangs'));
    }

    public function bidang($bidang_id){
        $programs = SidalevRealisasi::where('bidang_id', $bidang_id)->select('program_nama', 'program_id')->distinct()->get();
        return view('edm.renc-ang.bidang', compact('bidang_id', 'programs'));
    }

    public function program(Request $request){
        $program_id = $request->program_id;
        $kegiatans = SidalevRealisasi::where('program_id', $program_id)->select('kegiatan_nama', 'kegiatan_id')->distinct()->get();
        return view('edm.renc-ang.program', compact('program_id', 'kegiatans'));
    }

    public function kegiatan($kegiatan){
        return view('edm.renc-ang.kegiatan', compact('kegiatan'));
    }

}
