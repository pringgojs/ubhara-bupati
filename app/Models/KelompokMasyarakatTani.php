<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KelompokMasyarakatTani extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at']; 

    public static function insertNewData(Request $request){
        if (!Desa::find($request->desa_id))
            return;
        $kmt = new KelompokMasyarakatTani;
        $kmt->nama = $request->nama;
        $kmt->ketua = $request->ketua;
        $kmt->desa_id = $request->desa_id;
        $kmt->save();
        return $kmt;
    }

    public static function insertFromContent($content, $desa_id){
        $data = KelompokMasyarakatTani::where('nama', $content->nama_kelompok)->first();
        if (empty($data)){
            $data = new KelompokMasyarakatTani;
            $data->desa_id = $desa_id;
            $data->nama = $content->nama_kelompok;
            $data->desa_id = $desa_id;
            $data->save();
        }
        return $data;
    }

    public function updateData(Request $request){
        $this->nama = $request->nama;
        $this->ketua = $request->ketua;
        $this->desa_id = $request->desa_id;
        $this->save();
    }

    public static function deleteRelatedToId($id){
        KelompokMasyarakatTani::where('id', $id)->delete();
    }
}
