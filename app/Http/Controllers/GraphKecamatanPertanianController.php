<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Models\KomoditasLahan;
use App\Models\KelompokMasyarakatTani;
use App\Models\AnggotaKelompokMasyarakatTani;
use App\Models\LahanPertanian;

class GraphKecamatanPertanianController extends Controller
{
    //
    public function cards($kecamatan_id){
        $komoditasQ = "SELECT distinct(komoditas_lahans.nama)
	        FROM lahan_pertanians
	        LEFT JOIN desas ON lahan_pertanians.desa_id = desas.id
	        LEFT JOIN komoditas_lahans ON lahan_pertanians.komoditas_lahan_id = komoditas_lahans.id
	        WHERE desas.kecamatan_id = $kecamatan_id";
	    $komoditas = count(DB::select($komoditasQ));
        $pokmas = KelompokMasyarakatTani::leftJoin('desas', 'kelompok_masyarakat_tanis.desa_id', 'desas.id')
        	->where('desas.kecamatan_id', $kecamatan_id)
        	->count();
        $anggotapokmas = AnggotaKelompokMasyarakatTani::leftJoin('kelompok_masyarakat_tanis', 'anggota_kelompok_masyarakat_tanis.kmt_id', 'kelompok_masyarakat_tanis.id')
        	->leftJoin('desas', 'kelompok_masyarakat_tanis.desa_id', 'desas.id')
        	->where('desas.kecamatan_id', $kecamatan_id)
        	->count();
        $lahan = number_format(LahanPertanian::leftJoin('desas', 'lahan_pertanians.desa_id', 'desas.id')
        	->where('desas.kecamatan_id', $kecamatan_id)
        	->sum('lahan_pertanians.luas'), 2,',','.');
        return [$komoditas, $pokmas, $anggotapokmas, $lahan];
    }

    public function lahanperdesa($kecamatan_id){
    	$query = "SELECT desas.name as desa, sum(lahan_pertanians.luas) as sum_luas
            FROM desas
            LEFT JOIN lahan_pertanians ON desas.id = lahan_pertanians.desa_id
            WHERE desas.kecamatan_id = $kecamatan_id
            GROUP BY desas.name";
        $select = DB::select($query);
        $colnames = [];
        $values = [];
        foreach($select as $s){
            array_push($colnames, $s->desa);
            array_push($values, $s->sum_luas);
        }

        return ['colnames' => $colnames, 'values'=> $values];
    }

    public function jenislahan($kecamatan_id){
        $query = "SELECT jenis_lahans.nama as jenis, sum(lahan_pertanians.luas) as sum_luas
            FROM jenis_lahans
            LEFT JOIN lahan_pertanians ON jenis_lahans.id = lahan_pertanians.jenis_lahan_id
            LEFT JOIN desas ON lahan_pertanians.desa_id = desas.id
            WHERE desas.kecamatan_id = $kecamatan_id
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

    public function komoditaslahan($kecamatan_id){
        $query = "SELECT komoditas_lahans.nama as komoditas, sum(lahan_pertanians.luas) as sum_luas
            FROM komoditas_lahans
            LEFT JOIN lahan_pertanians ON komoditas_lahans.id = lahan_pertanians.komoditas_lahan_id
            LEFT JOIN desas ON lahan_pertanians.desa_id = desas.id
            WHERE desas.kecamatan_id = $kecamatan_id
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

    public function poktanperdesa($kecamatan_id){
    	$query = "SELECT desas.name as desa, count(kelompok_masyarakat_tanis.id) as sum
            FROM desas
            LEFT JOIN kelompok_masyarakat_tanis ON desas.id = kelompok_masyarakat_tanis.desa_id
            WHERE desas.kecamatan_id = $kecamatan_id
            GROUP BY desas.name";
        $select = DB::select($query);
		$colnames = [];
        $values = [];
        foreach($select as $s){
            array_push($colnames, $s->desa);
            array_push($values, $s->sum);
        }

        return ['colnames' => $colnames, 'values' => $values];    
    }

    public function petaniperdesa($kecamatan_id){
    	$query = "SELECT desas.name as desa, count(anggota_kelompok_masyarakat_tanis.id) as sum
            FROM desas
            LEFT JOIN kelompok_masyarakat_tanis ON desas.id = kelompok_masyarakat_tanis.desa_id
            LEFT JOIN anggota_kelompok_masyarakat_tanis ON kelompok_masyarakat_tanis.id = anggota_kelompok_masyarakat_tanis.kmt_id
            WHERE desas.kecamatan_id = $kecamatan_id
            GROUP BY desas.name";
        $select = DB::select($query);
		$colnames = [];
        $values = [];
        foreach($select as $s){
            array_push($colnames, $s->desa);
            array_push($values, $s->sum);
        }

        return ['colnames' => $colnames, 'values' => $values];    
    }
}
