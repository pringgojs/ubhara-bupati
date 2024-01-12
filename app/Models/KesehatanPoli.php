<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

class KesehatanPoli extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at']; 

    public static function insertNewData(Request $request){
        $poli = new KesehatanPoli;
        $poli->nama = $request->nama;
        $poli->save();
        return $poli;
    }

    public static function findOrInsert($nama){
        $poli = KesehatanPoli::where('nama' , $nama)->first();
        if (empty($poli)){
            $poli = new KesehatanPoli;
            $poli->nama = $nama;
            $poli->save();
        }
        return $poli;
    }

    public static function deleteRelatedToId($id){
        //PoliToFasyankes::deleteRelatedTo('kesehatan_poli_id', $id);
        KesehatanPoli::where('id', $id)->delete();
    }

    public function updateData(Request $request){
        $this->nama = $request->nama;
        $this->save();
    }
}
