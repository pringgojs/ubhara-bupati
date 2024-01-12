<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\TargetSetoran;
use App\Models\SetoranPasar;
class GraphPasarController extends Controller
{
    //

    public function jenispasar(){
        $jenisQ = "SELECT jenis_pasars.nama, count(pasars.id) as count
            FROM jenis_pasars
            LEFT JOIN pasars ON jenis_pasars.id = pasars.jenis_pasar_id
            GROUP BY jenis_pasars.nama";
        $jenisS = DB::select($jenisQ);
        $colnames = [];
        $values = [];
        foreach($jenisS as $j){
            array_push($colnames, $j->nama);
            array_push($values, $j->count);
        }
        return ['colnames' => $colnames, 'values' => $values];
    }

    public function marketshare(){
        $q = TargetSetoran::leftJoin('pasars', 'target_setorans.pasar_id', 'pasars.id')
            ->where('target_setorans.tahun_anggaran', date('Y'))
            ->select('pasars.nama', 'target_setorans.target')->get();
        $colnames = [];
        $values = [];
        foreach($q as $j){
            array_push($colnames, $j->nama);
            array_push($values, $j->target);
        }
        return ['colnames' => $colnames, 'values' => $values];
    }

    
    public function grafikpembayaran(){
        $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli','Agustus', 'September','Oktober','November', 'Desember'];
        $colnames = [];
        $values = [];
        $temp = 0;
        for ($i = 1; $i <= count($months); $i++){
            $month = $i < 10 ? '0'.$i : $i;
            $dateFrom = date('Y'). '-' . $month . '-01';
            $dateTo = date('Y'). '-' . $month . '-31';
            $setoran = SetoranPasar::whereBetween('tanggal_data', [$dateFrom, $dateTo])->sum('setoran_terkumpul');
            $temp += $setoran;
            array_push($colnames, $months[$i-1]. ' ' . date('Y'));
            array_push($values, $temp);
        }
        return ['colnames' => $colnames, 'values' => $values];
    }
}
