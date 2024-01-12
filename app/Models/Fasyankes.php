<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Desa;
use App\Models\JenisFasyankes;
use App\Models\KesehatanPoli;
use App\Models\PoliToFasyankes;

class Fasyankes extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at']; 

    public static function insertNewData(Request $request){
        $data = new Fasyankes;
        $data->nama = $request->nama;
        $data->jenis_fasyankes_id = $request->jenis_fasyankes_id;
        $data->desa_id = $request->desa_id;
        $data->save();
        return $data;
    }

    public static function findOrInsert($nama, $jenis, $alamat){
        $fasyankes = Fasyankes::where('nama', $nama)->first();
        if (empty($fasyankes)){
            $desa = Desa::findOrInsert($alamat);
            $jenis = JenisFasyankes::findOrInsert($jenis);
            $fasyankes = new Fasyankes;
            $fasyankes->nama = $nama;
            $fasyankes->jenis_fasyankes_id = $jenis->id;
            $fasyankes->desa_id = $desa->id;
            $fasyankes->save();
        }
        return $fasyankes;
    }
    public function updateData(Request $request){
        $this->nama = $request->nama;
        $this->jenis_fasyankes_id = $request->jenis_fasyankes_id;
        $this->desa_id = $request->desa_id;
        $this->save();
    }

    public function syncPoli(Request $request){
        foreach($request->kesehatan_poli_ids as $poli_id){
            if (!empty(KesehatanPoli::find($poli_id))){
                $dtj = new PoliToFasyankes;
                $dtj->kesehatan_poli_id = $poli_id;
                $dtj->fasyankes_id = $this->id;
                $dtj->save();
            }
        }
    }

    public static function deleteRelatedToId($id){
        PoliToFasyankes::deleteRelatedTo('fasyankes_id', $id);
        Fasyankes::where('id', $id)->delete();
    }

    public function jenis_fasyankes(){
        return $this->belongsTo('App\Models\JenisFasyankes');
    }

    public function desa(){
        return $this->belongsTo('App\Models\Desa');
    }
}
