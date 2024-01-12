<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Penjual;

class Pasar extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at']; 

    public static function insertNewData(Request $request){
        $pasar = new Pasar;
        $pasar->nama = $request->nama;
        $pasar->deskripsi = $request->deskripsi;
        $pasar->jenis_pasar_id = $request->jenis_pasar_id;
        $pasar->desa_id = $request->desa_id;
        $pasar->save();
        return $pasar;
    }

    public function updateData(Request $request){
        $this->nama = $request->nama;
        $this->deskripsi = $request->deskripsi;
        $this->jenis_pasar_id = $request->jenis_pasar_id;
        $this->desa_id = $request->desa_id;
        $this->save();
    }

    public static function deleteRelatedToId($id){
        Penjual::deleteRelatedTo('pasar_id', $id);
        Pasar::where('id', $id)->delete();
    }
}
