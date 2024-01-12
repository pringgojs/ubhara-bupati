<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Infrastrukturjembatan;
use App\Models\Kecamatan;
use App\Models\KecamatanToJembatan;
use App\Traits\LoggingTrait;
use App\Models\Desa;
use App\Models\StatusJembatan;

class GraphKecamatanJembatanController extends Controller
{
    //
    use LoggingTrait;
    protected $isActiveLog = false;

    function __construct()
    {
        $this->isActiveLog = env('ACTIVE_LOG');
    }

    public function cards($kecamatan_id){
        $query = KecamatanToJembatan::leftJoin('infrastruktur_jembatans', 'kecamatan_to_jembatans.infrastruktur_jembatan_id', 'infrastruktur_jembatans.id')
            ->leftJoin('status_jembatans', 'infrastruktur_jembatans.status_dipakai', 'status_jembatans.id')
            ->where('kecamatan_to_jembatans.kecamatan_id', $kecamatan_id);
        $jumlah_jembatan = $query->count();
        $total_panjang = $query->sum('status_jembatans.jembatan_panjang');
        $jumlah_baik = $query->where('status_jembatans.kondisi', 'BAIK')->count()/$jumlah_jembatan*100;

        return ['jumlah_jembatan' => $jumlah_jembatan, 'total_panjang' => $total_panjang, 'jumlah_baik' => $jumlah_baik];
    }

    public function rekapitulasikondisijembatan($kecamatan_id){
        //Baik, Rusak Ringan, Rusak, Rusak Berat, Kritis, Runtuh
        $values = [];
        $kondisi = ['BAIK', 'RUSAK RINGAN', 'RUSAK', 'RUSAK BERAT', 'KRITIS', 'RUNTUH'];
        foreach($kondisi as $k){
            $j =KecamatanToJembatan::leftJoin('infrastruktur_jembatans', 'kecamatan_to_jembatans.infrastruktur_jembatan_id', 'infrastruktur_jembatans.id')
                ->leftJoin('status_jembatans', 'infrastruktur_jembatans.status_dipakai', 'status_jembatans.id')
                ->where('kecamatan_to_jembatans.kecamatan_id', $kecamatan_id)
                ->where('status_jembatans.kondisi', $k)
                ->count();
            array_push($values, $j);
        }
        return ['colnames' => $kondisi, 'values' => $values];
    }


    public function rekapitulasistruktur($kecamatan_id){
        $strukturs = StatusJembatan::select('tipe_struktur')->distinct()->get();
        $values = [];
        $colnames = [];
        foreach($strukturs as $s){

            $q = KecamatanToJembatan::leftJoin('infrastruktur_jembatans', 'kecamatan_to_jembatans.infrastruktur_jembatan_id', 'infrastruktur_jembatans.id')
                ->leftJoin('status_jembatans', 'infrastruktur_jembatans.status_dipakai', 'status_jembatans.id')
                ->where('kecamatan_to_jembatans.kecamatan_id', $kecamatan_id)
                ->where('status_jembatans.tipe_struktur', $s->tipe_struktur)
                ->count();
            array_push($colnames, $s->tipe_struktur);
            array_push($values, $q);
        }
        return ['colnames' => $colnames, 'values' => $values];
    }

    public function listjembatan($kecamatan_id){
        $jembatans = KecamatanToJembatan::leftJoin('infrastruktur_jembatans', 'kecamatan_to_jembatans.infrastruktur_jembatan_id', 'infrastruktur_jembatans.id')
            ->leftJoin('status_jembatans', 'infrastruktur_jembatans.status_dipakai', 'status_jembatans.id')
            ->select('status_jembatans.*', 'infrastruktur_jembatans.nama', 'infrastruktur_jembatans.id')
            ->where('kecamatan_to_jembatans.kecamatan_id', $kecamatan_id)
            ->orderBy('infrastruktur_jembatans.nama', 'asc')
            ->get();
        $jembatansToReturn = [];
        foreach($jembatans as $jembatan){
            array_push($jembatansToReturn, 
                [
                    $jembatan->jembatan_nourut,
                    $jembatan->nama,
                    $jembatan->pal_km,
                    $jembatan->tipe_struktur,
                    $jembatan->jembatan_panjang,
                    $jembatan->jembatan_lebarjalur,
                    $jembatan->jembatan_lebartotal,
                    $jembatan->kondisi
                ]);
        }
        return $jembatansToReturn;
    }
}
