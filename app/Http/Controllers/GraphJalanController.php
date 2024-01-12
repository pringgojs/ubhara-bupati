<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\InfrastrukturJalan;
use App\Models\Kecamatan;
use App\Traits\LoggingTrait;

class GraphJalanController extends Controller
{
    use LoggingTrait;
    protected $isActiveLog = false;

    function __construct()
    {
        $this->isActiveLog = env('ACTIVE_LOG');
    }

    public function rekapitulasikondisijalan(){
        $j_baik = InfrastrukturJalan::leftJoin('status_jalans', 'infrastruktur_jalans.status_dipakai', 'status_jalans.id')
            ->sum('status_jalans.kondisi_baik');
        $j_sedang = InfrastrukturJalan::leftJoin('status_jalans', 'infrastruktur_jalans.status_dipakai', 'status_jalans.id')
            ->sum('status_jalans.kondisi_sedang');
        $j_rusakringan = InfrastrukturJalan::leftJoin('status_jalans', 'infrastruktur_jalans.status_dipakai', 'status_jalans.id')
            ->sum('status_jalans.kondisi_rusakringan');
        $j_rusakberat = InfrastrukturJalan::leftJoin('status_jalans', 'infrastruktur_jalans.status_dipakai', 'status_jalans.id')
            ->sum('status_jalans.kondisi_rusakberat');
        return [ $j_baik,  $j_sedang, $j_rusakringan,  $j_rusakberat];
    }

    public function rekapitulasiperkecamatan(){
        $kecamatans = Kecamatan::all();
        $kecamatansToReturn = [];
        foreach($kecamatans as $kecamatan){
            $kecamatan->kondisi_baik = InfrastrukturJalan::leftJoin('status_jalans', 'infrastruktur_jalans.status_dipakai', 'status_jalans.id')
                ->leftJoin('kecamatan_to_jalans', 'infrastruktur_jalans.id', 'kecamatan_to_jalans.infrastruktur_jalan_id')
                ->where('kecamatan_to_jalans.kecamatan_id', $kecamatan->id)
                ->sum('status_jalans.kondisi_baik');
            $kecamatan->kondisi_sedang = InfrastrukturJalan::leftJoin('status_jalans', 'infrastruktur_jalans.status_dipakai', 'status_jalans.id')
                ->leftJoin('kecamatan_to_jalans', 'infrastruktur_jalans.id', 'kecamatan_to_jalans.infrastruktur_jalan_id')
                ->where('kecamatan_to_jalans.kecamatan_id', $kecamatan->id)
                ->sum('status_jalans.kondisi_sedang');
            $kecamatan->kondisi_rusakringan = InfrastrukturJalan::leftJoin('status_jalans', 'infrastruktur_jalans.status_dipakai', 'status_jalans.id')
                ->leftJoin('kecamatan_to_jalans', 'infrastruktur_jalans.id', 'kecamatan_to_jalans.infrastruktur_jalan_id')
                ->where('kecamatan_to_jalans.kecamatan_id', $kecamatan->id)
                ->sum('status_jalans.kondisi_rusakringan');
            $kecamatan->kondisi_rusakberat = InfrastrukturJalan::leftJoin('status_jalans', 'infrastruktur_jalans.status_dipakai', 'status_jalans.id')
                ->leftJoin('kecamatan_to_jalans', 'infrastruktur_jalans.id', 'kecamatan_to_jalans.infrastruktur_jalan_id')
                ->where('kecamatan_to_jalans.kecamatan_id', $kecamatan->id)
                ->sum('status_jalans.kondisi_rusakberat');
            $kecamatan->panjang = $kecamatan->kondisi_baik + $kecamatan->kondisi_sedang + $kecamatan->kondisi_rusakringan + $kecamatan->kondisi_rusakberat;
            if($kecamatan->panjang > 0){
                $kecamatan->persenbaik = $kecamatan->kondisi_baik / $kecamatan->panjang * 100;
                $kecamatan->persenbaiksedang = ($kecamatan->kondisi_baik + $kecamatan->kondisi_sedang) / $kecamatan->panjang * 100;
            }
            else {
                $kecamatan->persenbaik = 0;
                $kecamatan->persenbaiksedang = 0;
            }

            array_push($kecamatansToReturn, [
                'id_kecamatan' => $kecamatan->id,
                'kecamatan' => strtoupper($kecamatan->name), 
                'panjang' => number_format($kecamatan->panjang, 2, '.', ',') . ' km', 
                'persenbaik' => number_format($kecamatan->persenbaik, 2, '.', ',').'%', 
                'persenbaiksedang' => number_format($kecamatan->persenbaiksedang, 2, '.', ',').'%'
            ]);
        }
        return $kecamatansToReturn;
    }

    public function rekapitulasibahan(){
        $bahan_aspal = InfrastrukturJalan::leftJoin('status_jalans', 'infrastruktur_jalans.status_dipakai', 'status_jalans.id')
            ->sum('status_jalans.bahan_aspal');
        $bahan_lapen = InfrastrukturJalan::leftJoin('status_jalans', 'infrastruktur_jalans.status_dipakai', 'status_jalans.id')
            ->sum('status_jalans.bahan_lapen');
        $bahan_rabat = InfrastrukturJalan::leftJoin('status_jalans', 'infrastruktur_jalans.status_dipakai', 'status_jalans.id')
            ->sum('status_jalans.bahan_rabat');
        $bahan_telford = InfrastrukturJalan::leftJoin('status_jalans', 'infrastruktur_jalans.status_dipakai', 'status_jalans.id')
            ->sum('status_jalans.bahan_telford');
        $bahan_tanah = InfrastrukturJalan::leftJoin('status_jalans', 'infrastruktur_jalans.status_dipakai', 'status_jalans.id')
            ->sum('status_jalans.bahan_tanah');
        return [ $bahan_aspal,  $bahan_lapen,  $bahan_rabat,  $bahan_telford,  $bahan_tanah];
    }

    public function listjalan(){
        $jalans = InfrastrukturJalan::leftJoin('status_jalans', 'infrastruktur_jalans.status_dipakai', 'status_jalans.id')
            ->select('status_jalans.*', 'infrastruktur_jalans.nama', 'infrastruktur_jalans.id')
            ->orderBy('infrastruktur_jalans.nama', 'asc')
            ->get();
        $jalansToReturn = [];
        foreach($jalans as $jalan){
            $kecamatans = '';
            foreach($jalan->kecamatan as $kecamatan){
                if ($kecamatans == '')
                    $kecamatans = $kecamatan->name;
                else {
                    $kecamatans .= ', ' . $kecamatan->name;
                } 
            }
            $panjang = $jalan->kondisi_baik + $jalan->kondisi_sedang + $jalan->kondisi_rusakringan + $jalan->kondisi_rusakberat;
            if($panjang > 0){
                array_push($jalansToReturn, [
                    $jalan->nama,
                    strtoupper($kecamatans),
                    number_format($panjang, 2, '.', ',') ,
                    number_format($jalan->kondisi_baik / $panjang * 100, 2, '.', ','),
                    number_format(($jalan->kondisi_baik + $jalan->kondisi_sedang) / $panjang * 100, 2, '.', ','),
                ]);
            } else {
                array_push($jalansToReturn, [
                    $jalan->nama,
                    strtoupper($kecamatans),
                    '0', 
                    '0',
                    '0'
                    ]);
            }
            
        }
        return $jalansToReturn;
    }
}
