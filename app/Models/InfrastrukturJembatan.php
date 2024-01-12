<?php

namespace App\Models;

use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\DesaToJembatan;

class InfrastrukturJembatan extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'infrastruktur_jembatans';
    protected $dates = ['deleted_at']; 

    public static function getKondisiJembatan(){
        return ['BAIK', 'RUSAK RINGAN', 'RUSAK', 'RUSAK BERAT', 'KRITIS', 'RUNTUH'];
    }

    public static function insertNewData(Request $request){
        $jembatan = new InfrastrukturJembatan;
        $jembatan->nama = $request->nama;
        $jembatan->deskripsi = $request->deskripsi;
        $jembatan->nomor = $request->nomor;
        $jembatan->status_dipakai = 1;
        $jembatan->save();
        return $jembatan;
    }

    public static function insertFromContent($nama, $nomor){
        $jembatan = new InfrastrukturJembatan;
        $jembatan->nama = $nama;
        $jembatan->deskripsi = '';
        $jembatan->nomor = $nomor;
        $jembatan->save();

        return $jembatan;
    }

    public function syncDesa(Request $request){
        foreach($request->desa_ids as $desa_id){
            if (!empty(Desa::find($desa_id))){
                $dtj = new DesaToJembatan;
                $dtj->desa_id = $desa_id;
                $dtj->jembatan_id = $this->id;
                $dtj->save();
            }
        }
    }

    public function syncKecamatan(Request $request){
        foreach($request->kecamatan_ids as $kecamatan_id){
            if (!empty(Kecamatan::find($kecamatan_id))){
                $ktj = new KecamatanToJembatan();
                $ktj->kecamatan_id = $kecamatan_id;
                $ktj->infrastruktur_jembatan_id = $this->id;
                $ktj->save();
            }
        }
    }

    public function updateData(Request $request){
        $this->nama = $request->nama;
        $this->deskripsi = $request->deskripsi;
        $this->nomor = $request->nomor;
        $this->save();
    }

    public static function deleteRelatedToId($id){
        KecamatanToJembatan::deleteRelatedTo('infrastruktur_jembatan_id', $id);
        InfrastrukturJembatan::where('id', $id)->delete();
    }
}
