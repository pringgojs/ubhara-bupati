<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

use App\Models\JenisSekolah;
use App\Models\DesaToSekolah;

class Sekolah extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at']; 

    public static function insertNewData(Request $request){
        if (!JenisSekolah::find($request->jenis_sekolah_id))
            return;
        $sekolah = new Sekolah;
        $sekolah->nama = $request->nama;
        $sekolah->jenis_sekolah_id = $request->jenis_sekolah_id;
        $sekolah->save();
        return $sekolah;
    }

    public static function insertFromContent(FileSekolahContent $content)
    {
        $arr = explode(" ", $content->jenjang);
        if($arr[1] == "Swasta") $negeri = 0;
        elseif($arr[1] == "Negeri") $negeri = 1;
        else $negeri = 0;
        $jenjangJS = JenisSekolah::findJenjang($content->jenjang);
        $js = JenisSekolah::findOrInsert($arr[0], $negeri, $jenjangJS);
        $sekolah = new Sekolah();
        $sekolah->nama = $content->nama_sekolah;
        $sekolah->jenis_sekolah_id = $js->id;
        $sekolah->save();

        DesaToSekolah::insertFromContent($content->desa_kelurahan, $sekolah);
    }

    public function syncDesa(Request $request){
        foreach($request->desa_ids as $desa_id){
            if (!empty(Desa::find($desa_id))){
                $dtj = new DesaToSekolah;
                $dtj->desa_id = $desa_id;
                $dtj->sekolah_id = $this->id;
                $dtj->save();
            }
        }
    }

    public function updateData(Request $request){
        $this->nama = $request->nama;
        $this->jenis_sekolah_id = $request->jenis_sekolah_id;
        $this->save();
    }

    public static function deleteRelatedToId($id){
        DesaToSekolah::deleteRelatedTo('sekolah_id', $id);
        Sekolah::where('id', $id)->delete();
    }

    public static function findOrInsert($nama){
        $data = Sekolah::where('nama', $nama)->first();
        if (empty($data)){
            $data = new Sekolah;
            $data->nama = $nama;
            $data->jenis_sekolah_id = 99;
            $data->save();
        }
        return $data;
    }

    public static function findOrInsert2($nama, $isNegeri, $desa, $jenjang)
    {
        $arr = explode(" ", $nama);
        if($isNegeri == "Swasta") $negeri = 0;
        elseif($isNegeri == "Negeri") $negeri = 1;
        else $negeri = 0;
        $js = JenisSekolah::findOrInsert($arr[0], $negeri, $jenjang);
        $sekolah = new Sekolah();
        $sekolah->nama = $nama;
        $sekolah->jenis_sekolah_id = $js->id;
        $sekolah->save();

        DesaToSekolah::insertFromContent($desa, $sekolah);
        return $sekolah;
    }
}
