<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\DesaToJalan;
use Illuminate\Http\Request;
use App\Models\Kecamatan;

class InfrastrukturJalan extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'infrastruktur_jalans';
    protected $dates = ['deleted_at']; 

    public static function insertNewData(Request $request){
        $jalan = new InfrastrukturJalan;
        $jalan->nama = $request->nama;
        $jalan->no_ruas = $request->no_ruas;
        $jalan->deskripsi = $request->deskripsi;
        $jalan->status_dipakai = 1;
        $jalan->save();
        return $jalan;
    }

    public static function insertFromContent($nama, $no_ruas){
        $jalan = new InfrastrukturJalan;
        $jalan->nama = $nama;
        $jalan->no_ruas = $no_ruas;
        $jalan->save();
        return $jalan;
    }

    public function updateData(Request $request){
        $this->nama = $request->nama;
        $this->deskripsi = $request->deskripsi;
        $this->no_ruas = $request->no_ruas;
        $this->save();
    }

    public function syncDesa(Request $request){
        foreach($request->desa_ids as $desa_id){
            if (!empty(Desa::find($desa_id))){
                $dtj = new DesaToJalan;
                $dtj->desa_id = $desa_id;
                $dtj->jalan_id = $this->id;
                $dtj->save();
            }
        }
    }

    public function syncKecamatan(Request $request){
        foreach($request->kecamatan_ids as $kecamatan_id){
            if (!empty(Kecamatan::find($kecamatan_id))){
                $ktj = new KecamatanToJalan();
                $ktj->kecamatan_id = $kecamatan_id;
                $ktj->infrastruktur_jalan_id = $this->id;
                $ktj->save();
            }
        }
    }

    public static function deleteRelatedToId($id){
        KecamatanToJalan::deleteRelatedTo('infrastruktur_jalan_id', $id);
        InfrastrukturJalan::where('id', $id)->delete();
    }

    /*
    ==================================================================================================
     */

    public function kecamatanToJalan(){
        return $this->hasMany('App\Models\KecamatanToJalan');
    }

    public function kecamatan(){
        return $this->belongsToMany(Kecamatan::class, 'kecamatan_to_jalans');
    }
}
