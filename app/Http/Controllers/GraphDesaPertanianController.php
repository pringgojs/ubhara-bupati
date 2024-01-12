<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Models\KomoditasLahan;
use App\Models\KelompokMasyarakatTani;
use App\Models\AnggotaKelompokMasyarakatTani;
use App\Models\LahanPertanian;

class GraphDesaPertanianController extends Controller
{
    //
    public function cards($desa_id){
        $komoditasQ = "SELECT distinct(komoditas_lahans.nama)
	        FROM lahan_pertanians
	        LEFT JOIN komoditas_lahans ON lahan_pertanians.komoditas_lahan_id = komoditas_lahans.id
	        WHERE lahan_pertanians.desa_id = $desa_id";
	    $komoditas = count(DB::select($komoditasQ));
        $pokmas = KelompokMasyarakatTani::where('desa_id',$desa_id)
        	->count();
        $anggotapokmas = AnggotaKelompokMasyarakatTani::leftJoin('kelompok_masyarakat_tanis', 'anggota_kelompok_masyarakat_tanis.kmt_id', 'kelompok_masyarakat_tanis.id')
        	->where('kelompok_masyarakat_tanis.desa_id', $desa_id)
        	->count();
        $lahan = number_format(LahanPertanian::where('desa_id', $desa_id)
        	->sum('luas'), 2,',','.');
        return [$komoditas, $pokmas, $anggotapokmas, $lahan];
    }
    public function jenislahan($desa_id){
        $query = "SELECT jenis_lahans.nama as jenis, sum(lahan_pertanians.luas) as sum_luas
            FROM jenis_lahans
            LEFT JOIN lahan_pertanians ON jenis_lahans.id = lahan_pertanians.jenis_lahan_id
            LEFT JOIN desas ON lahan_pertanians.desa_id = desas.id
            WHERE desas.id = $desa_id
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

    public function komoditaslahan($desa_id){
        $query = "SELECT komoditas_lahans.nama as komoditas, sum(lahan_pertanians.luas) as sum_luas
            FROM komoditas_lahans
            LEFT JOIN lahan_pertanians ON komoditas_lahans.id = lahan_pertanians.komoditas_lahan_id
            LEFT JOIN desas ON lahan_pertanians.desa_id = desas.id
            WHERE desas.id = $desa_id
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

    public function listpoktan($desa_id){
		$poktanRAW = KelompokMasyarakatTani::where('desa_id', $desa_id)->get();
        $colnames = [];
        $values = [];
		foreach($poktanRAW as $poktan){
            
            array_push($values, AnggotaKelompokMasyarakatTani::where('kmt_id', $poktan->id)->count());
            array_push($colnames, $poktan->nama);
        }
        return ['colnames' => $colnames, 'values'=> $values];
	}

    public function listlahanpertanian($desa_id){
        $lahans = LahanPertanian::leftJoin('anggota_kelompok_masyarakat_tanis', 'lahan_pertanians.anggota_kelompok_masyarakat_tani_id', 'anggota_kelompok_masyarakat_tanis.id')
            ->leftJoin('kelompok_masyarakat_tanis', 'anggota_kelompok_masyarakat_tanis.kmt_id', 'kelompok_masyarakat_tanis.id')
            ->leftJoin('komoditas_lahans', 'lahan_pertanians.komoditas_lahan_id', 'komoditas_lahans.id')
            ->leftJoin('jenis_lahans', 'lahan_pertanians.jenis_lahan_id', 'jenis_lahans.id')
            ->where('kelompok_masyarakat_tanis.desa_id', $desa_id)
            ->select('lahan_pertanians.luas', 'anggota_kelompok_masyarakat_tanis.nama as petani', 'kelompok_masyarakat_tanis.nama as poktan', 'jenis_lahans.nama as jenis_lahan', 'komoditas_lahans.nama as komoditas_lahan')
            ->get();
        $toReturn = [];
        foreach($lahans as $lahan){
            array_push($toReturn, [
                $lahan->petani,
                $lahan->poktan,
                $lahan->jenis_lahan,
                $lahan->luas,
                $lahan->komoditas_lahan
            ]);
        }
        return $toReturn;
    }
}
