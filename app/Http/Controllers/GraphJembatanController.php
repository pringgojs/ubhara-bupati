<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\InfrastrukturJembatan;
use App\Models\KecamatanToJembatan;
use App\Models\Kecamatan;
use App\Traits\LoggingTrait;

class GraphJembatanController extends Controller
{
    use LoggingTrait;
    protected $isActiveLog = false;

    function __construct()
    {
        $this->isActiveLog = env('ACTIVE_LOG');
    }

    public function rekapitulasikondisi(){
        // Baik, Rusak Ringan, Rusak, Rusak Berat, Kritis, Runtuh
        $colNames = InfrastrukturJembatan::getKondisiJembatan();
        $values = [];
        foreach($colNames as $cn){
            array_push(
                $values,
                InfrastrukturJembatan::leftJoin('status_jembatans', 'infrastruktur_jembatans.status_dipakai', 'status_jembatans.id')
                    ->where('status_jembatans.kondisi', $cn)->count()
            );
        }
        return ['colnames' => $colNames, 'values' => $values];
    }

    public function rekapitulasitipestruktur(){
        $colNames = ['GTI', 'PTI', 'BTI', 'MBI', 'MYI', 'ESI', 'EMI', 'GPI', 'RBI', 'ETI', 'OPI'];
        $returnTipeStruktur = [];
        foreach($colNames as $ts){
            array_push(
                $returnTipeStruktur,
                InfrastrukturJembatan::leftJoin('status_jembatans', 'infrastruktur_jembatans.status_dipakai', 'status_jembatans.id')
                    ->where('status_jembatans.tipe_struktur', $ts)->count(), 
            );
        }
        return ['colnames' => $colNames, 'values' => $returnTipeStruktur];
    }

    public function rekapitulasiperkecamatan(){
        $kecamatans = Kecamatan::all();
        $kondisiJembatans = InfrastrukturJembatan::getKondisiJembatan();
        $values = [];
        $colNames = ['Kecamatan'];
        foreach($kondisiJembatans as $kj){
            array_push($colNames, 'Jumlah Kondisi '.$kj);
        }
        foreach($kecamatans as $kecamatan){
            $value = ['kecamatan' => strtoupper($kecamatan->name), 'kecamatan_id' => $kecamatan->id];
            foreach($kondisiJembatans as $kj){
                $value[strtolower(str_replace(' ', '', $kj))] = KecamatanToJembatan::leftJoin('infrastruktur_jembatans', 'kecamatan_to_jembatans.infrastruktur_jembatan_id', 'infrastruktur_jembatans.id')
                        ->leftJoin('status_jembatans', 'infrastruktur_jembatans.status_dipakai', 'status_jembatans.id')
                        ->where([
                            'kecamatan_to_jembatans.kecamatan_id' => $kecamatan->id,
                            'status_jembatans.kondisi' => $kj
                        ])->count();
            }
            array_push($values, $value);
        }
        return $values;
        return ['colnames' => $colNames, 'values' => $values];
    }

    public function listjembatan(){
        $colNames = ['Nama Jembatan', 'Panjang', 'Lebar', 'Kecamatan', 'Tipe Struktur', 'Kondisi'];
        $ijembs = InfrastrukturJembatan::leftJoin('status_jembatans', 'infrastruktur_jembatans.status_dipakai', 'status_jembatans.id')
            ->select('infrastruktur_jembatans.nama as jembatan', 'status_jembatans.*', 'infrastruktur_jembatans.id')
            ->get();
        $values = [];
        foreach($ijembs as $value){
            $kecamatanObjs = KecamatanToJembatan::leftJoin('kecamatans', 'kecamatan_to_jembatans.kecamatan_id', 'kecamatans.id')
                ->where('kecamatan_to_jembatans.id', $value->id)
                ->select('kecamatans.name as kecamatan')
                ->get();
            $kecamatanStr = '';
            foreach($kecamatanObjs as $ko){
                if ($kecamatanStr == ''){
                    $kecamatanStr = $ko->kecamatan;
                } else {
                    $kecamatanStr .= ', ' . $ko->kecamatan;
                }
            }
            array_push(
                $values,
                [$value->jembatan, $value->jembatan_panjang, $value->jembatan_lebartotal, strtoupper($kecamatanStr), $value->tipe_struktur, $value->kondisi]
            );
        }
        return ['colnames' => $colNames, 'values' => $values];
    }
}
