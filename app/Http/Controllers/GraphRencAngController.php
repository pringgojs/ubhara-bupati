<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SidalevRealisasi;

class GraphRencAngController extends Controller
{
    //

    public function urusan(){
        $urusans = SidalevRealisasi::select('urusan_nama')->distinct()->get();
        $targets = [];
        $realisasis = [];
        $persen_realisasis = [];
        $labels = [];
        $x_axis = [];
        
        $triwulans = SidalevRealisasi::select('triwulan')->distinct()->get();
        foreach($triwulans as $triwulan){
            array_push($x_axis, 'Triwulan ' . $triwulan->triwulan);
        }
        foreach($urusans as $urusan){
            $realisasi = [];
            $persen_realisasi_per_triwulan = [];
            $temp = 0;
            $target = SidalevRealisasi::where([
                'urusan_nama'=> $urusan->urusan_nama,
                'triwulan' => 1
            ])->sum('target_clean');

            foreach($triwulans as $triwulan){
                $realisasiPerTriwulan = SidalevRealisasi::where([
                    'urusan_nama'=> $urusan->urusan_nama,
                    'triwulan' => $triwulan->triwulan
                ])->sum('realisasi');
                $temp += $realisasiPerTriwulan;
                $persen_realisasi =  $temp / $target * 100 ;
                array_push($persen_realisasi_per_triwulan, $persen_realisasi);
                array_push($realisasi, number_format($temp, 2, ',','.'));
            }
            array_push($persen_realisasis, $persen_realisasi_per_triwulan);
            array_push($labels, $urusan->urusan_nama);
            array_push($targets, number_format($target, 2, ',','.'));
            array_push($realisasis, $realisasi);
        }
        $toReturn = ['x_axis' => $x_axis, 'persen_realisasis' => $persen_realisasis, 'labels' => $labels, 'targets' => $targets, 'realisasis'=> $realisasis];
        return $toReturn;
    }

    public function bidang($urusan_id){
        $bidangs = SidalevRealisasi::where('urusan_id', $urusan_id)->select('bidang_nama')->distinct()->get();
        $targets = [];
        $realisasis = [];
        $persen_realisasis = [];
        $labels = [];
        $x_axis = [];
        
        $triwulans = SidalevRealisasi::select('triwulan')->distinct()->get();
        foreach($triwulans as $triwulan){
            array_push($x_axis, 'Triwulan ' . $triwulan->triwulan);
        }
        foreach($bidangs as $bidang){
            $realisasi = [];
            $persen_realisasi_per_triwulan = [];
            $temp = 0;
            $target = SidalevRealisasi::where([
                'bidang_nama'=> $bidang->bidang_nama,
                'triwulan' => 1
            ])->sum('target_clean');

            foreach($triwulans as $triwulan){
                $realisasiPerTriwulan = SidalevRealisasi::where([
                    'bidang_nama'=> $bidang->bidang_nama,
                    'triwulan' => $triwulan->triwulan
                ])->sum('realisasi');
                $temp += $realisasiPerTriwulan;
                $persen_realisasi =  $temp / $target * 100 ;
                array_push($persen_realisasi_per_triwulan, $persen_realisasi);
                array_push($realisasi, number_format($temp, 2, ',','.'));
            }
            array_push($persen_realisasis, $persen_realisasi_per_triwulan);
            array_push($labels, $bidang->bidang_nama);
            array_push($targets, number_format($target, 2, ',','.'));
            array_push($realisasis, $realisasi);
        }
        $toReturn = ['x_axis' => $x_axis, 'persen_realisasis' => $persen_realisasis, 'labels' => $labels, 'targets' => $targets, 'realisasis'=> $realisasis];
        return $toReturn;
    }

    public function program($bidang_id){
        $programs = SidalevRealisasi::where('bidang_id', $bidang_id)->select('program_nama')->distinct()->get();
        $targets = [];
        $realisasis = [];
        $persen_realisasis = [];
        $labels = [];
        $x_axis = [];
        
        $triwulans = SidalevRealisasi::select('triwulan')->distinct()->get();
        foreach($triwulans as $triwulan){
            array_push($x_axis, 'Triwulan ' . $triwulan->triwulan);
        }
        foreach($programs as $program){
            $realisasi = [];
            $persen_realisasi_per_triwulan = [];
            $temp = 0;
            $target = SidalevRealisasi::where([
                'program_nama'=> $program->program_nama,
                'triwulan' => 1
            ])->sum('target_clean');

            foreach($triwulans as $triwulan){
                $realisasiPerTriwulan = SidalevRealisasi::where([
                    'program_nama'=> $program->program_nama,
                    'triwulan' => $triwulan->triwulan
                ])->sum('realisasi');
                $temp += $realisasiPerTriwulan;
                $persen_realisasi =  $temp / $target * 100 ;
                array_push($persen_realisasi_per_triwulan, $persen_realisasi);
                array_push($realisasi, number_format($temp, 2, ',','.'));
            }
            array_push($persen_realisasis, $persen_realisasi_per_triwulan);
            array_push($labels, $program->program_nama);
            array_push($targets, number_format($target, 2, ',','.'));
            array_push($realisasis, $realisasi);
        }
        $toReturn = ['x_axis' => $x_axis, 'persen_realisasis' => $persen_realisasis, 'labels' => $labels, 'targets' => $targets, 'realisasis'=> $realisasis];
        return $toReturn;

    }

    public function kegiatan(Request $request){
        $kegiatans = SidalevRealisasi::where('program_id', $request->program)->select('program_nama')->distinct()->get();
        $targets = [];
        $realisasis = [];
        $persen_realisasis = [];
        $labels = [];
        $x_axis = [];
        
        $triwulans = SidalevRealisasi::select('triwulan')->distinct()->get();
        foreach($triwulans as $triwulan){
            array_push($x_axis, 'Triwulan ' . $triwulan->triwulan);
        }
        foreach($kegiatans as $kegiatan){
            $realisasi = [];
            $persen_realisasi_per_triwulan = [];
            $temp = 0;
            $target = SidalevRealisasi::where([
                'kegiatan_nama'=> $kegiatan->kegiatan_nama,
                'triwulan' => 1
            ])->sum('target_clean');

            foreach($triwulans as $triwulan){
                $realisasiPerTriwulan = SidalevRealisasi::where([
                    'kegiatan_nama'=> $kegiatan->kegiatan_nama,
                    'triwulan' => $triwulan->triwulan
                ])->sum('realisasi');
                $temp += $realisasiPerTriwulan;
                $persen_realisasi =  $temp / $target * 100 ;
                array_push($persen_realisasi_per_triwulan, $persen_realisasi);
                array_push($realisasi, number_format($temp, 2, ',','.'));
            }
            array_push($persen_realisasis, $persen_realisasi_per_triwulan);
            array_push($labels, $kegiatan->kegiatan_nama);
            array_push($targets, number_format($target, 2, ',','.'));
            array_push($realisasis, $realisasi);
        }
        $toReturn = ['x_axis' => $x_axis, 'persen_realisasis' => $persen_realisasis, 'labels' => $labels, 'targets' => $targets, 'realisasis'=> $realisasis];
        return $toReturn;

    }
}
