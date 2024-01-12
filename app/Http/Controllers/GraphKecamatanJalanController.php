<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\InfrastrukturJalan;
use App\Models\Kecamatan;
use App\Traits\LoggingTrait;

use App\Models\KecamatanToJalan;
use App\Models\Desa;

class GraphKecamatanJalanController extends Controller
{
    //
    use LoggingTrait;
    protected $isActiveLog = false;

    function __construct()
    {
        $this->isActiveLog = env('ACTIVE_LOG');
    }

    public function cards($kecamatan_id){
        $j_baik = KecamatanToJalan::leftJoin('infrastruktur_jalans', 'kecamatan_to_jalans.infrastruktur_jalan_id', 'infrastruktur_jalans.id')
            ->leftJoin('status_jalans', 'infrastruktur_jalans.status_dipakai', 'status_jalans.id')
            ->where('kecamatan_to_jalans.kecamatan_id', $kecamatan_id)->sum('status_jalans.kondisi_baik');
        $j_sedang = KecamatanToJalan::leftJoin('infrastruktur_jalans', 'kecamatan_to_jalans.infrastruktur_jalan_id', 'infrastruktur_jalans.id')
            ->leftJoin('status_jalans', 'infrastruktur_jalans.status_dipakai', 'status_jalans.id')
            ->where('kecamatan_to_jalans.kecamatan_id', $kecamatan_id)->sum('status_jalans.kondisi_sedang');
        $j_rusakringan = KecamatanToJalan::leftJoin('infrastruktur_jalans', 'kecamatan_to_jalans.infrastruktur_jalan_id', 'infrastruktur_jalans.id')
            ->leftJoin('status_jalans', 'infrastruktur_jalans.status_dipakai', 'status_jalans.id')
            ->where('kecamatan_to_jalans.kecamatan_id', $kecamatan_id)->sum('status_jalans.kondisi_rusakringan');
        $j_rusakberat = KecamatanToJalan::leftJoin('infrastruktur_jalans', 'kecamatan_to_jalans.infrastruktur_jalan_id', 'infrastruktur_jalans.id')
            ->leftJoin('status_jalans', 'infrastruktur_jalans.status_dipakai', 'status_jalans.id')
            ->where('kecamatan_to_jalans.kecamatan_id', $kecamatan_id)->sum('status_jalans.kondisi_rusakberat');
        $totalPanjang = $j_baik + $j_sedang + $j_rusakringan + $j_rusakberat;
        
        $totalRuas = KecamatanToJalan::leftJoin('infrastruktur_jalans', 'kecamatan_to_jalans.infrastruktur_jalan_id', 'infrastruktur_jalans.id')
            ->where('kecamatan_to_jalans.kecamatan_id', $kecamatan_id)
            ->count();
        $presentaseBaik = $totalPanjang > 0 ? $j_sedang/$totalPanjang*100 : 0;
        $totalDesa = Desa::where('kecamatan_id', $kecamatan_id)->count();

        return ['jumlah_ruas' => $totalRuas, 'totalPanjang' => number_format($totalPanjang, 2, ',','.'), 'jalan_baik' => number_format($presentaseBaik, 2, ',','.'), 'desa' => $totalDesa];
    }

    public function rekapitulasikondisijalan($kecamatan_id){
        $j_baik = KecamatanToJalan::leftJoin('infrastruktur_jalans', 'kecamatan_to_jalans.infrastruktur_jalan_id', 'infrastruktur_jalans.id')
            ->leftJoin('status_jalans', 'infrastruktur_jalans.status_dipakai', 'status_jalans.id')
            ->where('kecamatan_to_jalans.kecamatan_id', $kecamatan_id)->sum('status_jalans.kondisi_baik');
        $j_sedang = KecamatanToJalan::leftJoin('infrastruktur_jalans', 'kecamatan_to_jalans.infrastruktur_jalan_id', 'infrastruktur_jalans.id')
            ->leftJoin('status_jalans', 'infrastruktur_jalans.status_dipakai', 'status_jalans.id')
            ->where('kecamatan_to_jalans.kecamatan_id', $kecamatan_id)->sum('status_jalans.kondisi_sedang');
        $j_rusakringan = KecamatanToJalan::leftJoin('infrastruktur_jalans', 'kecamatan_to_jalans.infrastruktur_jalan_id', 'infrastruktur_jalans.id')
            ->leftJoin('status_jalans', 'infrastruktur_jalans.status_dipakai', 'status_jalans.id')
            ->where('kecamatan_to_jalans.kecamatan_id', $kecamatan_id)->sum('status_jalans.kondisi_rusakringan');
        $j_rusakberat = KecamatanToJalan::leftJoin('infrastruktur_jalans', 'kecamatan_to_jalans.infrastruktur_jalan_id', 'infrastruktur_jalans.id')
            ->leftJoin('status_jalans', 'infrastruktur_jalans.status_dipakai', 'status_jalans.id')
            ->where('kecamatan_to_jalans.kecamatan_id', $kecamatan_id)->sum('status_jalans.kondisi_rusakberat');
        return [ $j_baik,  $j_sedang, $j_rusakringan,  $j_rusakberat];
    }


    public function rekapitulasibahan($kecamatan_id){
        $bahan_aspal = KecamatanToJalan::leftJoin('infrastruktur_jalans', 'kecamatan_to_jalans.infrastruktur_jalan_id', 'infrastruktur_jalans.id')
            ->leftJoin('status_jalans', 'infrastruktur_jalans.status_dipakai', 'status_jalans.id')
            ->where('kecamatan_to_jalans.kecamatan_id', $kecamatan_id)
            ->sum('status_jalans.bahan_aspal');
        $bahan_lapen = KecamatanToJalan::leftJoin('infrastruktur_jalans', 'kecamatan_to_jalans.infrastruktur_jalan_id', 'infrastruktur_jalans.id')
            ->leftJoin('status_jalans', 'infrastruktur_jalans.status_dipakai', 'status_jalans.id')
            ->where('kecamatan_to_jalans.kecamatan_id', $kecamatan_id)
            ->sum('status_jalans.bahan_lapen');
        $bahan_rabat = KecamatanToJalan::leftJoin('infrastruktur_jalans', 'kecamatan_to_jalans.infrastruktur_jalan_id', 'infrastruktur_jalans.id')
            ->leftJoin('status_jalans', 'infrastruktur_jalans.status_dipakai', 'status_jalans.id')
            ->where('kecamatan_to_jalans.kecamatan_id', $kecamatan_id)
            ->sum('status_jalans.bahan_rabat');
        $bahan_telford = KecamatanToJalan::leftJoin('infrastruktur_jalans', 'kecamatan_to_jalans.infrastruktur_jalan_id', 'infrastruktur_jalans.id')
            ->leftJoin('status_jalans', 'infrastruktur_jalans.status_dipakai', 'status_jalans.id')
            ->where('kecamatan_to_jalans.kecamatan_id', $kecamatan_id)
            ->sum('status_jalans.bahan_telford');
        $bahan_tanah = KecamatanToJalan::leftJoin('infrastruktur_jalans', 'kecamatan_to_jalans.infrastruktur_jalan_id', 'infrastruktur_jalans.id')
            ->leftJoin('status_jalans', 'infrastruktur_jalans.status_dipakai', 'status_jalans.id')
            ->where('kecamatan_to_jalans.kecamatan_id', $kecamatan_id)
            ->sum('status_jalans.bahan_tanah');
        return [ $bahan_aspal,  $bahan_lapen,  $bahan_rabat,  $bahan_telford,  $bahan_tanah];
    }

    public function listjalan($kecamatan_id){
        $jalans = KecamatanToJalan::leftJoin('infrastruktur_jalans', 'kecamatan_to_jalans.infrastruktur_jalan_id', 'infrastruktur_jalans.id')
            ->leftJoin('status_jalans', 'infrastruktur_jalans.status_dipakai', 'status_jalans.id')
            ->select('status_jalans.*', 'infrastruktur_jalans.nama', 'infrastruktur_jalans.id')
            ->where('kecamatan_to_jalans.kecamatan_id', $kecamatan_id)
            ->orderBy('infrastruktur_jalans.nama', 'asc')
            ->get();
        $jalansToReturn = [];
        foreach($jalans as $jalan){
            $panjang = $jalan->kondisi_baik + $jalan->kondisi_sedang + $jalan->kondisi_rusakringan + $jalan->kondisi_rusakberat;
            array_push($jalansToReturn, [
                $jalan->nama,
                number_format($panjang, 2, ',', '.'),
                $jalan->bahan_aspal,
                $jalan->bahan_lapen,
                $jalan->bahan_rabat,
                $jalan->bahan_telford,
                $jalan->bahan_tanah,
                $jalan->kondisi_baik,
                $jalan->kondisi_sedang,
                $jalan->kondisi_rusakringan,
                $jalan->kondisi_rusakberat
            ]);
        }
        return $jalansToReturn;
    }
}
