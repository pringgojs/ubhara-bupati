<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Models\KomoditasLahan;
use App\Models\KelompokMasyarakatTani;
use App\Models\AnggotaKelompokMasyarakatTani;
use App\Models\LahanPertanian;

class GraphPertanianController extends Controller
{
    //

    public function cards(){
        $komoditas = KomoditasLahan::count();
        $pokmas = KelompokMasyarakatTani::count();
        $anggotapokmas = AnggotaKelompokMasyarakatTani::count();
        $lahan = number_format(LahanPertanian::sum('luas'), 2,',','.');
        return [$komoditas, $pokmas, $anggotapokmas, $lahan];
    }

    public function lahanperkecamatan(){
        $query = "SELECT kecamatans.name as kecamatan, sum(lahan_pertanians.luas) as sum_luas
            FROM kecamatans
            LEFT JOIN desas ON kecamatans.id = desas.kecamatan_id
            LEFT JOIN lahan_pertanians ON desas.id = lahan_pertanians.desa_id
            GROUP BY kecamatans.name";
        $select = DB::select($query);
        $colnames = [];
        $values = [];
        foreach($select as $s){
            array_push($colnames, $s->kecamatan);
            array_push($values, $s->sum_luas);
        }

        return ['colnames' => $colnames, 'values'=> $values];
    }

    public function jenislahan(){
        $query = "SELECT jenis_lahans.nama as jenis, sum(lahan_pertanians.luas) as sum_luas
            FROM jenis_lahans
            LEFT JOIN lahan_pertanians ON jenis_lahans.id = lahan_pertanians.jenis_lahan_id
            GROUP BY jenis_lahans.nama";
        $select = DB::select($query);
        $colnames = [];
        $values = [];
        foreach($select as $s){
            array_push($colnames, $s->jenis);
            array_push($values, $s->sum_luas);
        }

        return ['colnames' => $colnames, 'values' => $values];
    }

    public function komoditaslahan(){
        $query = "SELECT komoditas_lahans.nama as komoditas, sum(lahan_pertanians.luas) as sum_luas
            FROM komoditas_lahans
            LEFT JOIN lahan_pertanians ON komoditas_lahans.id = lahan_pertanians.komoditas_lahan_id
            GROUP BY komoditas_lahans.nama";
        $select = DB::select($query);
        $colnames = [];
        $values = [];
        foreach($select as $s){
            array_push($colnames, $s->komoditas);
            array_push($values, $s->sum_luas);
        }

        return ['colnames' => $colnames, 'values' => $values];
    }

    public function poktanperkecamatan(){
        $query = "SELECT kecamatans.name as kecamatan, count(kelompok_masyarakat_tanis.id) as count_poktan
            FROM kecamatans
            LEFT JOIN desas ON kecamatans.id = desas.kecamatan_id
            LEFT JOIN kelompok_masyarakat_tanis ON desas.id = kelompok_masyarakat_tanis.desa_id
            GROUP BY kecamatans.name";
        $select = DB::select($query);
        $colnames = [];
        $values = [];
        foreach($select as $s){
            array_push($colnames, $s->kecamatan);
            array_push($values, $s->count_poktan);
        }

        return ['colnames' => $colnames, 'values'=> $values];
    }

    public function petaniperkecamatan(){
        $query = "SELECT kecamatans.name as kecamatan, count(anggota_kelompok_masyarakat_tanis.id) as count_petani
            FROM kecamatans
            LEFT JOIN desas ON kecamatans.id = desas.kecamatan_id
            LEFT JOIN kelompok_masyarakat_tanis ON desas.id = kelompok_masyarakat_tanis.desa_id
            LEFT JOIN anggota_kelompok_masyarakat_tanis ON kelompok_masyarakat_tanis.id = anggota_kelompok_masyarakat_tanis.kmt_id
            GROUP BY kecamatans.name";
        $select = DB::select($query);
        $colnames = [];
        $values = [];
        foreach($select as $s){
            array_push($colnames, $s->kecamatan);
            array_push($values, $s->count_petani);
        }

        return ['colnames' => $colnames, 'values' => $values];
    }

}
