<?php

namespace App\Models;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\DesaToWisata;

class TempatWisata extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'tempat_wisatas';
    protected $dates = ['deleted_at']; 

    public static function insertNewData(Request $request){
        $wisata = new TempatWisata;
        $wisata->nama = $request->nama;
        $wisata->deskripsi = $request->deskripsi;
        $wisata->thumbnail = '';
        $wisata->save();
        return $wisata;
    }

    public function updateData(Request $request){
        $this->nama = $request->nama;
        $this->deskripsi = $request->deskripsi;
        $this->save();
    }

    public function syncDesa(Request $request){
        foreach($request->desa_ids as $desa_id){
            if (!empty(Desa::find($desa_id))){
                $dtj = new DesaToWisata;
                $dtj->desa_id = $desa_id;
                $dtj->tempat_wisata_id = $this->id;
                $dtj->save();
            }
        }
    }

    public static function deleteRelatedToId($id){
        DesaToWisata::deleteRelatedTo('tempat_wisata_id', $id);
        TempatWisata::where('id', $id)->delete();
    }
}
