<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

class KunjunganPoli extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'kunjungan_poli';
    protected $dates = ['deleted_at']; 

    public static function insertNewData(Request $request){
        $poli = new KunjunganPoli;
        $poli->kesehatan_poli_id = $request->kesehatan_poli_id;
        $poli->total_kunjungan = $request->total_kunjungan;
        $poli->tanggal_kunjungan = $request->tanggal_kunjungan;
        $poli->save();
        return $poli;
    }

    public static function deleteRelatedToId($id){
        KunjunganPoli::where('id', $id)->delete();
    }

    public function updateData(Request $request){
        $this->kesehatan_poli_id = $request->kesehatan_poli_id;
        $this->total_kunjungan = $request->total_kunjungan;
        $this->tanggal_kunjungan = $request->tanggal_kunjungan;
        $this->save();
    }

    public function poli()
    {
        return $this->belongsTo(KesehatanPoli::class, 'kesehatan_poli_id', 'id');
    }
}
