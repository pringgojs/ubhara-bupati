<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Fasyankes;
use App\Models\TenagaKesehatan;
use DB;

class GraphDesaKesehatanController extends Controller
{
    //
    public function cards($desa_id){
        $fasyankes = Fasyankes::leftJoin('desas', 'fasyankes.desa_id', 'desas.id')
        	->where('desas.id', $desa_id)
        	->count();
        $nakes = TenagaKesehatan::leftJoin('fasyankes', 'tenaga_kesehatans.fasyankes_id', 'fasyankes.id')
        	->leftJoin('desas', 'fasyankes.desa_id', 'desas.id')
        	->where('desas.id', $desa_id)
        	->count();
        $peakvisitor = 0;
        $averagevisitor = 0;
        return [
            'fasyankes' => $fasyankes,
            'nakes' => $nakes,
            'peakvisitor' => $peakvisitor,
            'averagevisitor' => $averagevisitor
        ];
    }

    public function kunjunganpoli(){
        
    }

    public function jenisfasyankes($desa_id){
        $query = "SELECT jenis_fasyankes.nama as jenis, count(fasyankes.jenis_fasyankes_id) as count_jenis
            FROM jenis_fasyankes
            LEFT JOIN fasyankes ON jenis_fasyankes.id = fasyankes.jenis_fasyankes_id
            LEFT JOIN desas ON fasyankes.desa_id = desas.id
            WHERE desas.id = $desa_id
            GROUP BY jenis";
        $select = DB::select($query);
        $colNames = [];
        $values = [];
        foreach($select as $val){
            array_push($colNames, $val->jenis);
            array_push($values, $val->count_jenis);
        }

        return ['colnames' => $colNames, 'values' => $values];
    }

    public function jenisnakes($desa_id){
        $query = "SELECT kesehatan_polis.nama as poli, count(tenaga_kesehatans.kesehatan_poli_id) as count_nakes
            FROM kesehatan_polis
            LEFT JOIN tenaga_kesehatans ON kesehatan_polis.id = tenaga_kesehatans.kesehatan_poli_id
            LEFT JOIN fasyankes ON tenaga_kesehatans.fasyankes_id = fasyankes.id
            LEFT JOIN desas ON fasyankes.desa_id = desas.id
            WHERE desas.id = $desa_id
            GROUP BY kesehatan_polis.nama";
        $select = DB::select($query);
        $colNames = [];
        $values = [];
        foreach($select as $val){
            array_push($colNames, $val->poli);
            array_push($values, $val->count_nakes);
        }

        return ['colnames' => $colNames, 'values' => $values];
    }

    public function fasyankesperdesa($desa_id){
        $query = "SELECT desas.id, desas.name as desa, count(fasyankes.id) as count
            FROM desas
            LEFT JOIN fasyankes ON desas.id = fasyankes.desa_id
            WHERE desas.id = $desa_id
            GROUP BY desas.name, desas.id";
        $select = DB::select($query);
        $values = [];
        foreach($select as $s){
            array_push($values, [
                'desa_id' => $s->id,
                'desa' => strtoupper($s->desa),
                'count' => $s->count
            ]);
        }
        return $values;
        //return ['colnames' => $colNames, 'values' => $values];
    }

    public function listfasyankes($desa_id){
        $fasyankes = Fasyankes::leftJoin('desas','fasyankes.desa_id', 'desas.id')
            ->leftJoin('kecamatans', 'desas.id', 'kecamatans.id')
            ->leftJoin('jenis_fasyankes', 'fasyankes.jenis_fasyankes_id', 'fasyankes.id')
            ->where('desas.id', $desa_id)
            ->select('fasyankes.nama as fasyankes', 'desas.name as desa', 'kecamatans.name as kecamatan', 'jenis_fasyankes.nama as jenis')
            ->get();
        $colNames = ['Nama Fasyankes', 'Desa', 'Kecamatan', 'Jenis Fasyankes'];
        $values = [];
        foreach($fasyankes as $f){
            array_push($values,[
                $f->fasyankes, strtoupper($f->desa), strtoupper($f->kecamatan), $f->jenis
            ]);
        }
        return ['colnames' => $colNames, 'values' => $values];
    }

    public function listnakes($desa_id){
        $nakesRAW = TenagaKesehatan::leftJoin('fasyankes', 'tenaga_kesehatans.fasyankes_id', 'fasyankes.id')
            ->leftJoin('kesehatan_polis','tenaga_kesehatans.kesehatan_poli_id', 'kesehatan_polis.id')
            ->select('kesehatan_polis.nama as poli', 'fasyankes.nama as fasyankes', 'tenaga_kesehatans.*')
            ->where('fasyankes.desa_id', $desa_id)
            ->get();
        $values = [];
        foreach($nakesRAW as $nakes){
            array_push($values, [
                $nakes->nama,
                $nakes->fasyankes,
                $nakes->poli,
                $nakes->jabatan,
                $nakes->kepegawaian
            ]);
        }
        return $values;
    }
}
