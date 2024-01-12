<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

class KunjunganWisata extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'kunjungan_wisata';
    protected $dates = ['deleted_at']; 

    public static function insertNewData(Request $request){
        $poli = new KunjunganWisata;
        $poli->wisata_id = $request->wisata_id;
        $poli->total_kunjungan = $request->total_kunjungan;
        $poli->tanggal_kunjungan = $request->tanggal_kunjungan;
        $poli->save();
        return $poli;
    }

    public function updateData(Request $request){
        $this->wisata_id = $request->wisata_id;
        $this->total_kunjungan = $request->total_kunjungan;
        $this->tanggal_kunjungan = $request->tanggal_kunjungan;
        $this->save();
    }

    public static function deleteRelatedToId($id){
        KunjunganWisata::where('id', $id)->delete();
    }

    public function wisata()
    {
        return $this->belongsTo(TempatWisata::class, 'wisata_id', 'id');
    }
}
