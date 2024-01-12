<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Models\Fasyankes;
use App\Models\TenagaKesehatan;
use App\Traits\LoggingTrait;

class GraphKesehatanController extends Controller
{
    use LoggingTrait;
    protected $isActiveLog = false;

    function __construct()
    {
        $this->isActiveLog = env('ACTIVE_LOG');
    }

    public function cards(){
        $fasyankes = Fasyankes::count();
        $nakes = TenagaKesehatan::count();
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

    public function jenisfasyankes(){
        $query = "SELECT jenis_fasyankes.nama as jenis, count(fasyankes.jenis_fasyankes_id) as count_jenis
            FROM jenis_fasyankes
            LEFT JOIN fasyankes ON jenis_fasyankes.id = fasyankes.jenis_fasyankes_id
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

    public function jenisnakes(){
        $query = "SELECT kesehatan_polis.nama as poli, count(tenaga_kesehatans.kesehatan_poli_id) as count_nakes
            FROM kesehatan_polis
            LEFT JOIN tenaga_kesehatans ON kesehatan_polis.id = tenaga_kesehatans.kesehatan_poli_id
            WHERE kesehatan_polis.nama NOT LIKE '%PUSKESMAS%'
            AND kesehatan_polis.nama NOT LIKE '%POLINDES%'
            AND kesehatan_polis.nama NOT LIKE '%PONKESDES%'
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

    public function fasyankesperkecamatan(){
        $query = "SELECT kecamatans.name as kecamatan, count(fasyankes.id) as count_nakes
            FROM kecamatans
            LEFT JOIN desas ON desas.kecamatan_id = kecamatans.id
            LEFT JOIN fasyankes ON desas.id = fasyankes.desa_id
            GROUP BY kecamatans.name";
        $select = DB::select($query);
        $colNames = ['Kecamatan', 'Jumlah Fasyankes'];
        $values = [];
        foreach($select as $s){
            array_push($values, [
                strtoupper($s->kecamatan),
                $s->count_nakes
            ]);
        }
        return ['colnames' => $colNames, 'values' => $values];
    }

    public function listfasyankes(){
        $fasyankes = Fasyankes::leftJoin('desas','fasyankes.desa_id', 'desas.id')
            ->leftJoin('kecamatans', 'desas.kecamatan_id', 'kecamatans.id')
            ->leftJoin('jenis_fasyankes', 'fasyankes.jenis_fasyankes_id', 'fasyankes.id')
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
}
