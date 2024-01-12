<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Models\TempatWisata;
use App\Models\PengunjungWisata;
use App\Models\DesaToWisata;

class GraphWisataController extends Controller
{
    //
    protected $date;
    public function __construct(){
        $date=date_create(date('Y-m-d'));
        $this->date = date_sub($date,date_interval_create_from_date_string("7 days"));
    }
    public function cards(){
        $tw = TempatWisata::count();
        $totalVisitor = PengunjungWisata::leftJoin('tempat_wisatas', 'pengunjung_wisatas.tempat_wisata_id', 'tempat_wisatas.id')
            ->whereBetween('tanggal_data', [$this->date, date('Y-m-d')])
            ->sum('pengunjung_wisatas.pengunjung');
        $peakVisitor = PengunjungWisata::leftJoin('tempat_wisatas', 'pengunjung_wisatas.tempat_wisata_id', 'tempat_wisatas.id')
            ->whereBetween('tanggal_data', [$this->date, date('Y-m-d')])
            ->orderBy('pengunjung_wisatas.pengunjung', 'desc')
            ->select('pengunjung_wisatas.pengunjung', 'tempat_wisatas.nama')
            ->first();
        return ['jumlah_wisata' => $tw, 'total_visitor' => $totalVisitor, 'peak_visitor' => ['wisata'=> $peakVisitor->nama, 'visitor' => $peakVisitor->pengunjung]];
    }

    public function kunjungan(){
        $date = date_format($this->date, 'Y-m-d');
        $query = "SELECT tanggal_data, sum(pengunjung) as pengunjung
            FROM pengunjung_wisatas
            WHERE tanggal_data >= $date
            GROUP BY tanggal_data
        ";
        $select = DB::select($query);
        $colnames = [];
        $values =[];
        foreach($select as $s){
            array_push($colnames, $s->tanggal_data);
            array_push($values, $s->pengunjung);
        }

        return ['colnames' => $colnames, 'values' => $values];
    }

    public function marketshares(){
        $query = "SELECT tempat_wisatas.nama, sum(pengunjung) as pengunjung
            FROM tempat_wisatas
            LEFT JOIN pengunjung_wisatas ON tempat_wisatas.id = pengunjung_wisatas.tempat_wisata_id
            GROUP BY tempat_wisatas.nama
        ";
        $select = DB::select($query);
        $colnames = [];
        $values =[];
        foreach($select as $s){
            array_push($colnames, $s->nama);
            array_push($values, $s->pengunjung);
        }

        return ['colnames' => $colnames, 'values' => $values];
    }

    public function monthlyrecap(){
        $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $values = [];
        $colnames = [];
        for ($i = 1; $i <= 12; $i++){
            $dateFrom = $i < 10 ? date('Y') . '-0' . $i . '-01' : date('Y') . '-' . $i . '-01';
            $dateTo = $i < 10 ? date('Y') . '-0' . $i . '-31' : date('Y') . '-' . $i . '-31';
            $recap = PengunjungWisata::whereBetween('tanggal_data', [$dateFrom, $dateTo])->sum('pengunjung');
            array_push($colnames, $months[$i-1].' ' .date('Y'));
            array_push($values, $recap);
        }

        return ['colnames' => $colnames, 'values' => $values];
    }

    public function yearlyrecap(){
        $values = [];
        $colnames = [];
        for ($i = date('Y')-7; $i <= date('Y'); $i++){
            $dateFrom = $i . '-01-01';
            $dateTo = $i . '-12-31';
            $recap = PengunjungWisata::whereBetween('tanggal_data', [$dateFrom, $dateTo])->sum('pengunjung');
            array_push($colnames, $i);
            array_push($values, $recap);
        }

        return ['colnames' => $colnames, 'values' => $values];
    }

    public function trendings(){
        $date = date_format($this->date, 'Y-m-d');
        $query = "SELECT tempat_wisatas.nama, sum(pengunjung) as pengunjung
            FROM tempat_wisatas
            LEFT JOIN pengunjung_wisatas ON tempat_wisatas.id = pengunjung_wisatas.tempat_wisata_id
            WHERE pengunjung_wisatas.tanggal_data >= $date
            GROUP BY tempat_wisatas.nama
            ORDER BY pengunjung_wisatas.pengunjung DESC
        ";
        $select = DB::select($query);
        $colnames = [];
        $values =[];
        foreach($select as $s){
            array_push($colnames, $s->nama);
            array_push($values, $s->pengunjung);
        }

        return ['colnames' => $colnames, 'values' => $values];
    }

    public function list(){
        $query = "SELECT tempat_wisatas.nama, sum(pengunjung) as pengunjung, tempat_wisatas.id
            FROM tempat_wisatas
            LEFT JOIN pengunjung_wisatas ON tempat_wisatas.id = pengunjung_wisatas.tempat_wisata_id
            GROUP BY tempat_wisatas.nama, tempat_wisatas.id
            ORDER BY pengunjung_wisatas.pengunjung DESC
        ";
        $select = DB::select($query);
        $values = [];
        foreach($select as $s){
            $desas = DesaToWisata::leftJoin('desas', 'desa_to_wisatas.desa_id', 'desas.id')
                ->leftJoin('kecamatans', 'desas.kecamatan_id', 'kecamatans.id')
                ->select('desas.name as desa', 'kecamatans.name as kecamatan')
                ->where('desa_to_wisatas.tempat_wisata_id', $s->id)
                ->get();
            $desa = '';
            foreach($desas as $d){
                $desa .= $d->desa . ' Kec. ' . $d->kecamatan . '; ';
            }
            
            array_push($values,[
                'tempat_wisata_id' => $s->id,
                'nama' => $s->nama,
                'alamat' => $desa,
                'pengunjung' => $s->pengunjung
            ]);
        }
        return $values;
    }
}
