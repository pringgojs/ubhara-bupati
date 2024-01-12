<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class PengunjungWisata extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'pengunjung_wisatas';
    protected $dates = ['deleted_at']; 

    public static function insertNewData(Request $request){
        $poli = new PengunjungWisata;
        $poli->tempat_wisata_id = $request->tempat_wisata_id;
        $poli->tanggal_data = $request->tanggal_data;
        $poli->harga = $request->harga;
        $poli->pengunjung = $request->pengunjung;
        $poli->keterangan = $request->keterangan;
        $poli->save();
        return $poli;
    }

    public function updateData(Request $request){
        $this->tempat_wisata_id = $request->tempat_wisata_id;
        $this->tanggal_data = $request->tanggal_data;
        $this->harga = $request->harga;
        $this->pengunjung = $request->pengunjung;
        $this->keterangan = $request->keterangan;
        $this->save();
    }

    public static function deleteRelatedToId($id){
        PengunjungWisata::where('id', $id)->delete();
    }

    public function wisata()
    {
        return $this->belongsTo(TempatWisata::class, 'tempat_wisata_id', 'id');
    }
}
